<?php

namespace Modules\TimeKeep\Http\Livewire\Singles;

use App\Models\Application;
use App\Models\Company;
use App\Models\Single;
use App\Models\User;
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
        "company_id" => ["status" => true, "label" => "Company Id"],
        "name" => ["status" => true, "label" => "Name"],
        "type" => ["status" => true, "label" => "Type"],
        "value" => ["status" => true, "label" => "Value"],
        "reason" => ["status" => true, "label" => "Reason"],
        "censor" => ["status" => true, "label" => "Censor"],
        "status" => ["status" => true, "label" => "Status"],
        "created_at" => ["status" => true, "label" => "Created At"],
        "updated_at" => ["status" => true, "label" => "Updated At"],

    ];

    public function mount()
    {
        $this->authorize("time-keep.singles.listing");
    }

    function delete()
    {
        $this->authorize("time-keep.singles.delete");
        if ($this->confirm > 0) {
            Single::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Singles successfully destroyed.');
    }

    public function render()
    {
        $data = new Single();

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

        lForm()->setTitle("Đơn");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.singles"), "Singles");

        $companies = Company::all();
        $appli = Application::all();
        $users = User::all();

        return view("time-keep::livewire.singles.listing",  compact("data", 'companies', 'appli', 'users'))
            ->layout('time-keep::layouts.master', ['title' => 'Singles Listing']);
    }
}
