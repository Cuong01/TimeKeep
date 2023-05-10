<?php

namespace Modules\Admin\Http\Livewire\Modules;

use App\Models\Emodule;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("admin.modules.show");
        Emodule::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  Emodule::findOrFail($this->record_id);
        lForm()->setTitle("Modules");
        lForm()->pushBreadcrumb(route("admin"),"Admin");
		lForm()->pushBreadcrumb(route("admin.modules"),"Modules");
		lForm()->pushBreadcrumb(route("admin.modules.show",$this->record_id),"Show");

        return view("admin::livewire.modules.show", compact("data"))
            ->layout('admin::layouts.master', ['title' => 'Modules Show']);
    }
}
