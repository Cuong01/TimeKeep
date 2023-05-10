<?php

namespace Modules\Admin\Http\Livewire\Companies;

use App\Models\Company;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("admin.companies.show");
        Company::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  Company::findOrFail($this->record_id);
        lForm()->setTitle("Công ty");
        lForm()->pushBreadcrumb(route("admin"), "Admin");
        lForm()->pushBreadcrumb(route("admin.companies"), "Companies");
        lForm()->pushBreadcrumb(route("admin.companies.show", $this->record_id), "Show");

        return view("admin::livewire.companies.show", compact("data"))
            ->layout('admin::layouts.master', ['title' => 'Companies Show']);
    }
}
