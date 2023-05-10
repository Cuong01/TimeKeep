<?php

namespace Modules\TimeKeep\Http\Livewire\Holidays;

use App\Models\Holiday;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Edit extends Component
{
    use WithLaravelFormTrait;

    public $name, $from_day, $to_day, $salary_half, $salary_working, $status;

    protected $rules = [
        'name' => 'required',
        'from_day' => 'required',
        'to_day' => 'required',
        'salary_half' => 'required',
        'salary_working' => 'required',
        'status' => '',

    ];

    protected $messages = [
        'name.required' => 'Hãy điền tên ngày lễ',
        'from_day.required' => 'Hãy điền ngày bắt đầu nghỉ',
        'to_day.required' => 'Hãy điền ngày kết thúc',
        'salary_half.required' => 'Hãy điền lương được hưởng khi nghỉ lễ',
        'salary_working.required' => 'Hãy điền lương được hưởng khi đi làm ngày lễ',
    ];

    public function mount()
    {
        $this->authorize("time-keep.holidays.edit");
        $data = Holiday::findOrFail($this->record_id);
        $this->name = $data->name;
        $this->from_day = $data->from_day;
        $this->to_day = $data->to_day;
        $this->salary_half = $data->salary_half;
        $this->salary_working = $data->salary_working;
        $this->status = $data->status;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("time-keep.holidays.edit");
        $this->validate();
        $data = Holiday::findOrFail($this->record_id);
        $data->fill([
            'name' => $this->name,
            'from_day' => $this->from_day,
            'to_day' => $this->to_day,
            'salary_half' => $this->salary_half,
            'salary_working' => $this->salary_working,
            'status' => $this->status,

        ]);
        if (!$data->clean) {
            $data->update();
            $this->redirectForm("time-keep.holidays", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Nghỉ lễ");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.holidays"), "Holidays");
        lForm()->pushBreadcrumb(route("time-keep.holidays.edit", $this->record_id), "Edit");

        return view("time-keep::livewire.holidays.edit")
            ->layout('time-keep::layouts.master', ['title' => 'Holidays Edit']);
    }
}
