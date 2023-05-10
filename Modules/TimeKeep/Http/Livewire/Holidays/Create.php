<?php

namespace Modules\TimeKeep\Http\Livewire\Holidays;

use App\Models\Holiday;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;

class   Create extends Component
{
    use WithLaravelFormTrait;

    public $name, $from_day, $to_day, $salary_half, $salary_working, $status = 1;
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
        $this->authorize("time-keep.holidays.create");
        $this->done = 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("time-keep.holidays.create");
        $this->validate();
        $data = Holiday::create([
            'name' => $this->name,
            'from_day' => $this->from_day,
            'to_day' => $this->to_day,
            'salary_half' => $this->salary_half,
            'salary_working' => $this->salary_working,
            'status' => $this->status,

        ]);
        if ($data) {
            $this->redirectForm("time-keep.holidays", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Nghỉ lễ");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.holidays"), "Holidays");
        lForm()->pushBreadcrumb(route("time-keep.holidays.create"), "Create");

        return view("time-keep::livewire.holidays.create")
            ->layout('time-keep::layouts.master', ['title' => 'Holidays Create']);
    }
}
