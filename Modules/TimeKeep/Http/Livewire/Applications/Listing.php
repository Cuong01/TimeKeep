<?php

namespace Modules\TimeKeep\Http\Livewire\Applications;

use App\Models\Application;
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
        "salary" => ["status" => true, "label" => "Salary"],
        "day" => ["status" => true, "label" => "Day"],
        "status" => ["status" => true, "label" => "Status"],
        "created_at" => ["status" => true, "label" => "Created At"],
        "updated_at" => ["status" => true, "label" => "Updated At"],

    ];

    public function mount()
    {
        $this->authorize("time-keep.applications.listing");
    }

    public function changeStatus($record_id)
    {
        $data  = Application::findOrFail($record_id);

        $data->update([
            "status" => !$data->status
        ]);
    }


    function delete()
    {
        $this->authorize("time-keep.applications.delete");
        if ($this->confirm > 0) {
            Application::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Applications successfully destroyed.');
    }

    public function render()
    {
        $data = new Application();

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

        lForm()->setTitle("Loại nghỉ");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.applications"), "Applications");

        return view("time-keep::livewire.applications.listing", compact("data"))
            ->layout('time-keep::layouts.master', ['title' => 'Applications Listing']);
    }
}
