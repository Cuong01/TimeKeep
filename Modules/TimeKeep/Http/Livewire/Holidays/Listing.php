<?php

namespace Modules\TimeKeep\Http\Livewire\Holidays;

use App\Models\Holiday;
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
        "from_day" => ["status" => true, "label" => "From Day"],
        "to_day" => ["status" => true, "label" => "To Day"],
        "salary_half" => ["status" => true, "label" => "Salary Half"],
        "salary_working" => ["status" => true, "label" => "Salary Working"],
        "status" => ["status" => true, "label" => "Status"],
        "created_at" => ["status" => true, "label" => "Created At"],
        "updated_at" => ["status" => true, "label" => "Updated At"],

    ];

    public function mount()
    {
        $this->authorize("time-keep.holidays.listing");
    }

    function delete()
    {
        $this->authorize("time-keep.holidays.delete");
        if ($this->confirm > 0) {
            Holiday::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Holidays successfully destroyed.');
    }

    public function changeStatus($record_id)
    {
        $data  = Holiday::findOrFail($record_id);

        $data->update([
            "status" => !$data->status
        ]);
    }


    public function render()
    {
        $data = new Holiday();

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

        lForm()->setTitle("Nghỉ lễ");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.holidays"), "Holidays");

        return view("time-keep::livewire.holidays.listing", compact("data"))
            ->layout('time-keep::layouts.master', ['title' => 'Holidays Listing']);
    }
}
