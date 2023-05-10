<?php
namespace Modules\Admin\Http\Livewire\Menus;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;
use Nwidart\Modules\Facades\Module;

class Listing extends Component
{
    use WithLaravelFormTrait;

    public function mount(){

    }

    public function delete($moduleName,$record){
        $this->onlyLocalhost();
        $module = Module::findOrFail($moduleName);
        $data = config($module->getLowerName() . ".menu",[]);
        Arr::forget($data,$record);
        $this->saveNavbar($moduleName,$data);
        session()->flash('message','done');
        $this->redirect(route("admin.menus"));
    }

    public function render(){
        $modules = Module::all();
        $data = [];
        foreach($modules as $module){
            $data[$module->getName()] = config($module->getLowerName().".menu",[]);
        }
        lForm()->setTitle("Menu");
        lForm()->pushBreadCrumb(route("admin"),"Admin");
        lForm()->pushBreadCrumb(route("admin.menus"),"Menu");

        return view("admin::livewire.menus.listing",compact("data"))
            ->layout('admin::layouts.master', ['title' => 'Menu']);
    }
}
