<?php

namespace Modules\Company\Http\Livewire\Departments;

use App\Models\Company;
use App\Models\Department;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("company.departments.show");
        Department::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  Department::findOrFail($this->record_id);
        lForm()->setTitle("Phòng ban");
        lForm()->pushBreadcrumb(route("company"), "Company");
        lForm()->pushBreadcrumb(route("company.departments"), "Departments");
        lForm()->pushBreadcrumb(route("company.departments.show", $this->record_id), "Show");

        $companies = Company::all();
        $departments = Department::all();

        return view("company::livewire.departments.show", compact("data", 'companies', 'departments'))
            ->layout('company::layouts.master', ['title' => 'Departments Show']);
    }
}
