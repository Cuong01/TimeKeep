<?php

namespace Modules\Admin\Http\Livewire\Settings\Menus;

use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;
use Nwidart\Modules\Facades\Module;

class Edit extends Component
{
    use WithLaravelFormTrait;
    public $module,$item;
    public $label,$icon,$route,$permission,$sort;
    protected $queryString =["module","item"];

    public function mount(){
        if(!$this->module || $this->module ==""){
            return  redirect(route('admin.settings.menus'));
        }
        $module = Module::findOrFail($this->module);
        $navbars = config($module->getLowerName().".navbar",[]);
        $data = data_get($navbars,$this->item,[]);
        if(empty($data)){
           return redirect(route('admin.settings.menus'));
        }
        $this->label = data_get($data,"label");
        $this->route = data_get($data,"route");
        $this->icon = data_get($data,"icon");
        $this->permission = data_get($data,"permission");

    }

    public function store(){
        $module = Module::findOrFail($this->module);
        $navbars = config($module->getLowerName().".navbar",[]);
        $data = data_get($navbars,$this->item,[]);
        $data["route"] = $this->route;
        $data["icon"] = $this->icon;
        $data["permission"] = $this->permission;
        $data["label"] = $this->label;
        Arr::set($navbars,$this->item,$data);
        $this->saveNavbar($this->module,$navbars);
        Artisan::call("config:clear");
        Artisan::call("cache:clear");
        Artisan::call("route:clear");
        $this->redirectForm("admin.settings.menus",1);
    }

    public function render(){

        lForm()->setTitle("Menu Edit");
        lForm()->pushBreadCrumb(route("admin"),"Admin");
        lForm()->pushBreadCrumb(route("admin.settings"),"Setting");
        lForm()->pushBreadCrumb(route("admin.settings.menus"),"Menu");
        lForm()->pushBreadCrumb(route("admin.settings.menus.edit"),"Edit");
        return view("admin::livewire.settings.menus.edit")
            ->layout('admin::layouts.master', ['title' => 'Menu Edit']);
    }

}
