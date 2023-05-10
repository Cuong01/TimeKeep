<?php

namespace Modules\Company\Http\Livewire\StaffInfomations;

use App\Models\StaffInfomation;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public function mount()
    {
        $this->authorize("company.staff-infomations.show");
        StaffInfomation::findOrFail($this->record_id);
    }

    public function render()
    {
        $data =  StaffInfomation::findOrFail($this->record_id);
        lForm()->setTitle("Thông tin nhân viên");
        lForm()->pushBreadcrumb(route("company"), "Company");
        lForm()->pushBreadcrumb(route("company.staff-infomations"), "Staff Infomations");
        lForm()->pushBreadcrumb(route("company.staff-infomations.show", $this->record_id), "Show");

        return view("company::livewire.staff-infomations.show", compact("data"))
            ->layout('company::layouts.master', ['title' => 'Staff Infomations Show']);
    }
}
