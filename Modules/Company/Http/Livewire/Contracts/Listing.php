<?php

namespace Modules\Company\Http\Livewire\Contracts;

use App\Models\Contract;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;

class Listing extends Component
{
    use WithLaravelFormTrait;

    public $confirm = 0;
    // Filter
    public $fId;
    // Sort
    public $sId = 0;
    public $fields = [
        "id" => ["status" => true, "label" => "Id"],
        "user_id" => ["status" => true, "label" => "User Id"],
        "name" => ["status" => true, "label" => "Name"],
        "some_contracts" => ["status" => true, "label" => "Some Contracts"],
        "sign_day" => ["status" => true, "label" => "Sign Day"],
        "type" => ["status" => true, "label" => "Type"],
        "effective_date" => ["status" => true, "label" => "Effective Date"],
        "expiration_date" => ["status" => true, "label" => "Expiration Date"],
        "type_of_work" => ["status" => true, "label" => "Type Of Work"],
        "rank" => ["status" => true, "label" => "Rank"],
        "total_salary" => ["status" => true, "label" => "Total Salary"],
        "salary_received" => ["status" => true, "label" => "Salary Received"],
        "basic_salary" => ["status" => true, "label" => "Basic Salary"],
        "pay_forms" => ["status" => true, "label" => "Pay Forms"],
        "salary_paid_for_insurance" => ["status" => true, "label" => "Salary Paid For Insurance"],
        "salary_percentage" => ["status" => true, "label" => "Salary Percentage"],
        "salary_allowance" => ["status" => true, "label" => "Salary Allowance"],
        "signed_representative" => ["status" => true, "label" => "Signed Representative"],
        "position_id" => ["status" => true, "label" => "Position Id"],
        "note" => ["status" => true, "label" => "Note"],
        "file" => ["status" => true, "label" => "File"],
        "created_at" => ["status" => true, "label" => "Created At"],
        "updated_at" => ["status" => true, "label" => "Updated At"],

    ];

    public function mount()
    {
        $this->authorize("company.contracts.listing");
    }

    function delete()
    {
        $this->authorize("company.contracts.delete");
        if ($this->confirm > 0) {
            Contract::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Contracts successfully destroyed.');
    }

    public function render()
    {
        $data = new Contract();

        if ($this->fId > 0) {
            $data = $data->whereId($this->fId);
        }
        if ($this->sId == 1) {
            $data = $data->orderBy("id");
        }
        if ($this->sId == 2) {
            $data = $data->orderByDesc("id");
        }
        $data = $data->paginate(30);

        lForm()->setTitle("Hợp đồng");
        lForm()->pushBreadcrumb(route("company"), "Company");
        lForm()->pushBreadcrumb(route("company.contracts"), "Contracts");

        return view("company::livewire.contracts.listing", compact("data"))
            ->layout('company::layouts.master', ['title' => 'Contracts Listing']);
    }
}
