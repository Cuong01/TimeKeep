<?php

namespace Modules\Admin\Http\Livewire\Menus;

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

    protected $rules = [
        "permission"=>"string|required"
        ,"label"=>"string|required"
        ,"module"=> "string|required"
    ];

    public function mount(){
        $this->onlyLocalhost();
        if(!$this->module || $this->module ==""){
            return  redirect(route('admin.menus'));
        }
        $module = Module::findOrFail($this->module);
        $navbars = config($module->getLowerName().".menu",[]);
        $data = data_get($navbars,$this->item,[]);
        if(empty($data)){
           return redirect(route('admin.menus'));
        }
        $this->label = data_get($data,"label");
        $this->route = data_get($data,"route");
        $this->icon = data_get($data,"icon");
        $this->permission = data_get($data,"permission");

    }

    public function store(){
        $this->onlyLocalhost();
        $this->validate();
        $module = Module::findOrFail($this->module);
        $navbars = config($module->getLowerName().".menu",[]);
        $data = data_get($navbars,$this->item,[]);
        $data["route"] = $this->route;
        $data["icon"] = $this->icon;
        $data["permission"] = $this->permission;
        $data["label"] = $this->label;
        Arr::set($navbars,$this->item,$data);
        $this->saveNavbar($this->module,$navbars);
        session()->flash('message','done');
        $this->redirectForm("admin.menus",1);
    }

    public function render(){

        lForm()->setTitle("Menu Edit");
        lForm()->pushBreadCrumb(route("admin"),"Admin");
        lForm()->pushBreadCrumb(route("admin.menus"),"Menu");
        lForm()->pushBreadCrumb(route("admin.menus.edit"),"Edit");
        return view("admin::livewire.menus.edit")
            ->layout('admin::layouts.master', ['title' => 'Menu Edit']);
    }

}
