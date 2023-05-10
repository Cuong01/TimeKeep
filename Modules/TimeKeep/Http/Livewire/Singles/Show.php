<?php

namespace Modules\TimeKeep\Http\Livewire\Singles;

use App\Models\Application;
use App\Models\Company;
use App\Models\Holiday;
use App\Models\Single;
use App\Models\User;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("time-keep.singles.show");
        Single::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  Single::findOrFail($this->record_id);
        lForm()->setTitle("Đơn");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.singles"), "Singles");
        lForm()->pushBreadcrumb(route("time-keep.singles.show", $this->record_id), "Show");

        $companies = Company::all();
        $appli = Application::all();
        $users = User::all();
        $holiday = Holiday::all();

        return view("time-keep::livewire.singles.show", compact("data", 'companies', 'appli', 'users', 'holiday'))
            ->layout('time-keep::layouts.master', ['title' => 'Singles Show']);
    }
}
