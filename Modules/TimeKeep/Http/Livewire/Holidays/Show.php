<?php

namespace Modules\TimeKeep\Http\Livewire\Holidays;

use App\Models\Holiday;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("time-keep.holidays.show");
        Holiday::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  Holiday::findOrFail($this->record_id);
        lForm()->setTitle("Nghỉ lễ");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.holidays"), "Holidays");
        lForm()->pushBreadcrumb(route("time-keep.holidays.show", $this->record_id), "Show");

        return view("time-keep::livewire.holidays.show", compact("data"))
            ->layout('time-keep::layouts.master', ['title' => 'Holidays Show']);
    }
}
