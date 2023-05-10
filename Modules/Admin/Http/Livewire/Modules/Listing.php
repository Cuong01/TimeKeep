<?php

namespace Modules\Admin\Http\Livewire\Modules;

use App\Models\Emodule;
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
		"label" => ["status" => true, "label" => "Label"],
		"slug" => ["status" => true, "label" => "Slug"],
		"icon" => ["status" => true, "label" => "Icon"],
		"permission" => ["status" => true, "label" => "Permission"],
		"created_at" => ["status" => true, "label" => "Created At"],
		"updated_at" => ["status" => true, "label" => "Updated At"],
		
    ];

    public function mount()
    {
        $this->authorize("admin.modules.listing");
    }

    function delete()
    {
        $this->authorize("admin.modules.delete");
        if ($this->confirm > 0) {
            Emodule::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Modules successfully destroyed.');
    }

    public function render()
    {
        $data = new Emodule();

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

        lForm()->setTitle("Modules");
        lForm()->pushBreadcrumb(route("admin"),"Admin");
		lForm()->pushBreadcrumb(route("admin.modules"),"Modules");
		
        return view("admin::livewire.modules.listing", compact("data"))
            ->layout('admin::layouts.master', ['title' => 'Modules Create']);
    }
}
