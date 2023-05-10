<?php

namespace Modules\TimeKeep\Http\Livewire\Timekeeps;

use App\Models\Timekeep;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class   Create extends Component
{
    use WithLaravelFormTrait;

    public $user_id, $time, $company_id, $status, $note;
    protected $rules = [
        'user_id' => '',
        'time' => '',
        'company_id' => '',
        'status' => '',
        'note' => '',

    ];

    public function mount()
    {
        $this->authorize("time-keep.timekeeps.create");
        $this->done = 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store(Request $request)
    {
        $this->authorize("time-keep.timekeeps.create");
        $this->validate();
        $data = Timekeep::create([
            'user_id' => Auth::user()->id,
            // 'time' => $this->time,
            // 'company_id' => $this->company_id,
            'status' => $this->status,
            'note' => $request->ip(),

        ]);
        if ($data) {
            $this->redirectForm("time-keep.timekeeps", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Timekeeps");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.timekeeps"), "Timekeeps");
        lForm()->pushBreadcrumb(route("time-keep.timekeeps.create"), "Create");

        return view("time-keep::livewire.timekeeps.create")
            ->layout('time-keep::layouts.master', ['title' => 'Timekeeps Create']);
    }
}
