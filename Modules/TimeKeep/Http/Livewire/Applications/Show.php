<?php

namespace Modules\TimeKeep\Http\Livewire\Applications;

use App\Models\Application;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("time-keep.applications.show");
        Application::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  Application::findOrFail($this->record_id);
        lForm()->setTitle("Applications");
        lForm()->pushBreadcrumb(route("time-keep"),"Time Keep");
		lForm()->pushBreadcrumb(route("time-keep.applications"),"Applications");
		lForm()->pushBreadcrumb(route("time-keep.applications.show",$this->record_id),"Show");

        return view("time-keep::livewire.applications.show", compact("data"))
            ->layout('time-keep::layouts.master', ['title' => 'Applications Show']);
    }
}
