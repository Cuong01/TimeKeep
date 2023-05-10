<?php

namespace Modules\Company\Http\Livewire\Contracts;

use App\Models\Contract;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("company.contracts.show");
        Contract::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  Contract::findOrFail($this->record_id);
        lForm()->setTitle("Hợp đồng");
        lForm()->pushBreadcrumb(route("company"), "Company");
        lForm()->pushBreadcrumb(route("company.contracts"), "Contracts");
        lForm()->pushBreadcrumb(route("company.contracts.show", $this->record_id), "Show");

        return view("company::livewire.contracts.show", compact("data"))
            ->layout('company::layouts.master', ['title' => 'Contracts Show']);
    }
}
