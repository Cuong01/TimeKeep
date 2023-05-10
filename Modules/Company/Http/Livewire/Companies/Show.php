<?php

namespace Modules\Company\Http\Livewire\Companies;

use App\Models\Company;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("company.companies.show");
        Company::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  Company::findOrFail($this->record_id);
        lForm()->setTitle("Công ty");
        lForm()->pushBreadcrumb(route("company"), "Company");
        lForm()->pushBreadcrumb(route("company.companies"), "Companies");
        lForm()->pushBreadcrumb(route("company.companies.show", $this->record_id), "Show");

        $companies = Company::all();

        return view("company::livewire.companies.show", compact("data", 'companies'))
            ->layout('company::layouts.master', ['title' => 'Companies Show']);
    }
}
