<?php

namespace Modules\Company\Http\Livewire\Positions;

use App\Models\Company;
use App\Models\Position;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("company.positions.show");
        Position::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  Position::findOrFail($this->record_id);
        lForm()->setTitle("Chức vụ");
        lForm()->pushBreadcrumb(route("company"), "Company");
        lForm()->pushBreadcrumb(route("company.positions"), "Positions");
        lForm()->pushBreadcrumb(route("company.positions.show", $this->record_id), "Show");

        $companies = Company::all();

        return view("company::livewire.positions.show", compact("data", 'companies'))
            ->layout('company::layouts.master', ['title' => 'Positions Show']);
    }
}
