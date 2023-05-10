<?php

namespace Modules\Demo\Http\Livewire\Companies;

use App\Models\Company;
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
        "name" => ["status" => true, "label" => "Name"],
        "slug" => ["status" => true, "label" => "Slug"],
        "teaser" => ["status" => true, "label" => "Teaser"],
        "logo" => ["status" => true, "label" => "Logo"],
        "address" => ["status" => true, "label" => "Address"],
        "phone" => ["status" => true, "label" => "Phone"],
        "parent_id" => ["status" => true, "label" => "Parent Id"],
        "active" => ["status" => true, "label" => "Active"],
        "created_at" => ["status" => true, "label" => "Created At"],
        "updated_at" => ["status" => true, "label" => "Updated At"],

    ];

    public function mount()
    {
        $this->authorize("demo.companies.listing");
    }

    function delete()
    {
        $this->authorize("demo.companies.delete");
        if ($this->confirm > 0) {
            Company::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Companies successfully destroyed.');
    }

    public function changeActive($record_id)
    {

        $this->authorize("demo.companies.edit");
        $data  = Company::findOrFail($record_id);

        $data->update([
            "active" => !$data->active
        ]);

        $this->dispatchBrowserEvent('warning', 'Companies successfully Updated.');
    }

    public function render()
    {
        $data = new Company();

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

        lForm()->setTitle("Công ty");
        lForm()->pushBreadcrumb(route("demo"), "Demo");
        lForm()->pushBreadcrumb(route("demo.companies"), "Companies");

        return view("demo::livewire.companies.listing", compact("data"))
            ->layout('demo::layouts.master', ['title' => 'Companies Create']);
    }
}
