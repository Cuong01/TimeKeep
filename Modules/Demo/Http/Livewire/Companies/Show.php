<?php

namespace Modules\Demo\Http\Livewire\Companies;

use App\Models\Company;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("demo.companies.show");
        Company::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  Company::findOrFail($this->record_id);
        lForm()->setTitle("Công ty");
        lForm()->pushBreadcrumb(route("demo"), "Demo");
        lForm()->pushBreadcrumb(route("demo.companies"), "Companies");
        lForm()->pushBreadcrumb(route("demo.companies.show", $this->record_id), "Show");

        return view("demo::livewire.companies.show", compact("data"))
            ->layout('demo::layouts.master', ['title' => 'Companies Show']);
    }
}
