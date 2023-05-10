<?php

namespace Modules\Company\Http\Livewire\Departments;

use App\Models\Company;
use App\Models\Department;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Edit extends Component
{
    use WithLaravelFormTrait;

    public $name, $company_id, $parent_id, $root_id;

    protected $rules = [
        'name' => 'required',
        'company_id' => '',
        'parent_id' => '',
        'root_id' => '',
    ];

    protected $messages = [
        'name.required' => 'Không được để trống tên phòng ban',
    ];

    public function mount()
    {
        $this->authorize("company.departments.edit");
        $data = Department::findOrFail($this->record_id);
        $this->name = $data->name;
        $this->company_id = $data->company_id;
        $this->parent_id = $data->parent_id;
        $this->root_id = $data->root_id;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("company.departments.edit");
        $this->validate();
        $data = Department::findOrFail($this->record_id);
        $data->fill([
            'name' => $this->name,
            'company_id' => $this->company_id,
            'parent_id' => $this->parent_id,
            'root_id' => $this->root_id,

        ]);
        if (!$data->clean) {
            $data->update();
            $this->redirectForm("company.departments", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Phòng ban");
        lForm()->pushBreadcrumb(route("company"), "Company");
        lForm()->pushBreadcrumb(route("company.departments"), "Departments");
        lForm()->pushBreadcrumb(route("company.departments.edit", $this->record_id), "Edit");

        $companies = Company::all()->pluck('name', 'id');
        $departments = Department::all()->pluck('name', 'id');

        return view("company::livewire.departments.edit", compact('companies', 'departments'))
            ->layout('company::layouts.master', ['title' => 'Departments Edit']);
    }
}
