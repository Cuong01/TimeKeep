<?php

namespace Modules\Admin\Http\Livewire\Permissions;

use App\Models\Permission;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("admin.permissions.show");
        Permission::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  Permission::findOrFail($this->record_id);
        lForm()->setTitle("Permissions");
        lForm()->pushBreadcrumb(route("admin"),"Admin");
		lForm()->pushBreadcrumb(route("admin.permissions"),"Permissions");
		lForm()->pushBreadcrumb(route("admin.permissions.show",$this->record_id),"Show");

        return view("admin::livewire.permissions.show", compact("data"))
            ->layout('admin::layouts.master', ['title' => 'Permissions Show']);
    }
}
