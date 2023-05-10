<?php

namespace Modules\TimeKeep\Http\Livewire\TimekeepRules;

use App\Models\TimekeepRule;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("time-keep.timekeep-rules.show");
        TimekeepRule::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  TimekeepRule::findOrFail($this->record_id);
        lForm()->setTitle("Timekeep Rules");
        lForm()->pushBreadcrumb(route("time-keep"),"Time Keep");
		lForm()->pushBreadcrumb(route("time-keep.timekeep-rules"),"Timekeep Rules");
		lForm()->pushBreadcrumb(route("time-keep.timekeep-rules.show",$this->record_id),"Show");

        return view("time-keep::livewire.timekeep-rules.show", compact("data"))
            ->layout('time-keep::layouts.master', ['title' => 'Timekeep Rules Show']);
    }
}
