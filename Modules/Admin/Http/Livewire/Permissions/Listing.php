<?php

namespace Modules\Admin\Http\Livewire\Permissions;

use App\Models\Permission;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;
use Nwidart\Modules\Facades\Module;

class Listing extends Component
{
    use WithLaravelFormTrait;

    public $confirm = 0;
    public function mount()
    {
        $this->authorize("admin.permissions.listing");
    }

    function delete()
    {
        $this->authorize("admin.permissions.delete");
        if ($this->confirm > 0) {
            Permission::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Permissions successfully destroyed.');
    }

    public function render()
    {
        $modules = Module::all();
        $data = [];
        foreach($modules as $module){
            $data[$module->getLowerName()] = [
                "info"=>[
                    "name"=>$module->getName()
                    ,"name_headline" => lfHeadLine($module->getName())
                    ,'permission'=>Permission::whereType("module")->whereModule($module->getLowerName())->first()
                ],
                "permissions" =>Permission::with("children")->whereParentId(0)->whereType("page")->whereModule($module->getLowerName())->get()
            ];
        }

        lForm()->setTitle("Permissions");
        lForm()->pushBreadcrumb(route("admin"),"Admin");
		lForm()->pushBreadcrumb(route("admin.permissions"),"Permissions");

        return view("admin::livewire.permissions.listing", compact("data"))
            ->layout('admin::layouts.master', ['title' => 'Permissions Create']);
    }
}
