<?php

namespace Modules\TimeKeep\Http\Livewire\Applications;

use App\Models\Application;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;

class   Create extends Component
{
    use WithLaravelFormTrait;

    public $name, $salary, $day, $status = '1';
    protected $rules = [
        'name' => 'required',
        'salary' => 'required',
        'day' => '',
        'status' => '',
    ];
    protected $messages = [
        'name.required' => 'Hãy điền tên loại nghỉ',
        'salary.required' => 'Hãy điền phần trăm lương được nhận',
    ];

    public function mount()
    {
        $this->authorize("time-keep.applications.create");
        $this->done = 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("time-keep.applications.create");
        $this->validate();
        $data = Application::create([
            'name' => $this->name,
            'salary' => $this->salary,
            'day' => $this->day,
            'status' => $this->status,

        ]);
        if ($data) {
            $this->redirectForm("time-keep.applications", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Loại nghỉ");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.applications"), "Applications");
        lForm()->pushBreadcrumb(route("time-keep.applications.create"), "Create");

        return view("time-keep::livewire.applications.create")
            ->layout('time-keep::layouts.master', ['title' => 'Applications Create']);
    }
}
