<?php

namespace Modules\Company\Http\Livewire\Positions;

use App\Models\Company;
use App\Models\Position;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;

class   Create extends Component
{
    use WithLaravelFormTrait;

    public $name, $company_id, $level;
    protected $rules = [
        'name' => 'string',
        'company_id' => '',
        'level' => '',

    ];

    public function mount()
    {
        $this->authorize("company.positions.create");
        $this->done = 1;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $this->authorize("company.positions.create");
        $this->validate();
        $data = Position::create([
            'name' => $this->name,
            'company_id' => $this->company_id,
            'level' => $this->level,

        ]);
        if ($data) {
            $this->redirectForm("company.positions", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Chức vụ");
        lForm()->pushBreadcrumb(route("company"), "Company");
        lForm()->pushBreadcrumb(route("company.positions"), "Positions");
        lForm()->pushBreadcrumb(route("company.positions.create"), "Create");

        $companies = Company::all()->pluck('name', 'id');

        return view("company::livewire.positions.create", compact('companies'))
            ->layout('company::layouts.master', ['title' => 'Positions Create']);
    }
}
