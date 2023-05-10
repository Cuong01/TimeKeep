<?php

namespace Modules\Company\Http\Livewire\Users;

use App\Models\Company;
use App\Models\Department;
use App\Models\Position;
use App\Models\User;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("company.users.show");
        User::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  User::findOrFail($this->record_id);
        lForm()->setTitle("Nhân viên");
        lForm()->pushBreadcrumb(route("company"), "Company");
        lForm()->pushBreadcrumb(route("company.users"), "Users");
        lForm()->pushBreadcrumb(route("company.users.show", $this->record_id), "Show");

        $companies = Company::all();
        $departments = Department::all();
        $positions = Position::all();

        return view("company::livewire.users.show", compact("data", 'companies', 'departments', 'positions'))
            ->layout('company::layouts.master', ['title' => 'Users Show']);
    }
}
