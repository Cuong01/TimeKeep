<?php

namespace Modules\TimeKeep\Http\Livewire\TimekeepRules;

use App\Models\TimekeepRule;
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
        "value" => ["status" => true, "label" => "Value"],
        "status" => ["status" => true, "label" => "Status"],
        "created_at" => ["status" => true, "label" => "Created At"],
        "updated_at" => ["status" => true, "label" => "Updated At"],

    ];

    public function mount()
    {
        $this->authorize("time-keep.timekeep-rules.listing");
    }

    public function changeStatus($record_id)
    {
        $data  = TimekeepRule::findOrFail($record_id);

        $data->update([
            "status" => !$data->status
        ]);
    }

    public function changeActive($record_id)
    {
        $data  = TimekeepRule::findOrFail($record_id);

        TimekeepRule::where('active', 1)->update([
            "active" => $data->active
        ]);
        $data->update([
            "active" => !$data->active
        ]);
    }

    function delete()
    {
        $this->authorize("time-keep.timekeep-rules.delete");
        if ($this->confirm > 0) {
            TimekeepRule::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Timekeep Rules successfully destroyed.');
    }

    public function render()
    {
        $data = new TimekeepRule();

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

        lForm()->setTitle("Luật chấm công");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.timekeep-rules"), "Timekeep Rules");

        return view("time-keep::livewire.timekeep-rules.listing", compact("data"))
            ->layout('time-keep::layouts.master', ['title' => 'Timekeep Rules Listing']);
    }
}
