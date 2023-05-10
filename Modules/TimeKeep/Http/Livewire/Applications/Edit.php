<?php

namespace Modules\TimeKeep\Http\Livewire\Applications;

use App\Models\Application;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Edit extends Component
{
    use WithLaravelFormTrait;

    public $name, $salary, $day, $status = '1';

    protected function rules()
    {
        return [
            'name' => 'required',
            'salary' => 'required',
            'day' => '',
            'status' => '',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Hãy điền tên loại nghỉ',
            'salary.required' => 'Hãy điền phần trăm lương được nhận',
        ];
    }

    public function mount()
    {
        $this->authorize("time-keep.applications.edit");
        $data = Application::findOrFail($this->record_id);
        $this->name = $data->name;
        $this->salary = $data->salary;
        $this->day = $data->day;
        $this->status = $data->status;
    }

    public function changeStatus($record_id)
    {
        $data  = Application::findOrFail($record_id);

        $data->update([
            "status" => !$data->status
        ]);
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("time-keep.applications.edit");
        $this->validate();
        $data = Application::findOrFail($this->record_id);
        $data->fill([
            'name' => $this->name,
            'salary' => $this->salary,
            'day' => $this->day,
            'status' => $this->status,

        ]);
        if (!$data->clean) {
            $data->update();
            $this->redirectForm("time-keep.applications", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Loại nghỉ");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.applications"), "Applications");
        lForm()->pushBreadcrumb(route("time-keep.applications.edit", $this->record_id), "Edit");

        return view("time-keep::livewire.applications.edit")
            ->layout('time-keep::layouts.master', ['title' => 'Applications Edit']);
    }
}
