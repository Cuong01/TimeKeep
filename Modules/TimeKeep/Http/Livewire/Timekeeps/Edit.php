<?php

namespace Modules\TimeKeep\Http\Livewire\Timekeeps;

use App\Models\Timekeep;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Edit extends Component
{
    use WithLaravelFormTrait;

    public $user_id, $time, $company_id, $status, $note;

    protected function rules()
    {
        return [
            'user_id' => '',
			'time' => '',
			'company_id' => '',
			'status' => '',
			'note' => '',
			
        ];
    }

    public function mount()
    {
        $this->authorize("time-keep.timekeeps.edit");
        $data = Timekeep::findOrFail($this->record_id);
        $this->user_id = $data->user_id;
		$this->time = $data->time;
		$this->company_id = $data->company_id;
		$this->status = $data->status;
		$this->note = $data->note;
		
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("time-keep.timekeeps.edit");
        $this->validate();
        $data = Timekeep::findOrFail($this->record_id);
        $data->fill([
            'user_id' => $this->user_id,
			'time' => $this->time,
			'company_id' => $this->company_id,
			'status' => $this->status,
			'note' => $this->note,
			
        ]);
        if (!$data->clean) {
            $data->update();
            $this->redirectForm("time-keep.timekeeps", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Timekeeps");
        lForm()->pushBreadcrumb(route("time-keep"),"Time Keep");
		lForm()->pushBreadcrumb(route("time-keep.timekeeps"),"Timekeeps");
		lForm()->pushBreadcrumb(route("time-keep.timekeeps.edit",$this->record_id),"Edit");

        return view("time-keep::livewire.timekeeps.edit")
            ->layout('time-keep::layouts.master', ['title' => 'Timekeeps Edit']);
    }
}
