<?php

namespace Modules\Company\Http\Livewire\Users;

use App\Models\Company;
use App\Models\Department;
use App\Models\Position;
use App\Models\StaffInfomation;
use App\Models\TimekeepRule;
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
        "name" => ["status" => true, "label" => "Name"],
        "email" => ["status" => true, "label" => "Email"],
        "email_verified_at" => ["status" => true, "label" => "Email Verified At"],
        "password" => ["status" => true, "label" => "Password"],
        "two_factor_secret" => ["status" => true, "label" => "Two Factor Secret"],
        "two_factor_recovery_codes" => ["status" => true, "label" => "Two Factor Recovery Codes"],
        "two_factor_confirmed_at" => ["status" => true, "label" => "Two Factor Confirmed At"],
        "remember_token" => ["status" => true, "label" => "Remember Token"],
        "current_team_id" => ["status" => true, "label" => "Current Team Id"],
        "profile_photo_path" => ["status" => true, "label" => "Profile Photo Path"],
        "created_at" => ["status" => true, "label" => "Created At"],
        "updated_at" => ["status" => true, "label" => "Updated At"],
        "is_admin" => ["status" => true, "label" => "Is Admin"],
        "birthday" => ["status" => true, "label" => "Birthday"],
        "gender" => ["status" => true, "label" => "Gender"],
        "address" => ["status" => true, "label" => "Address"],
        "phone" => ["status" => true, "label" => "Phone"],
        "company_id" => ["status" => true, "label" => "Company Id"],
        "department_id" => ["status" => true, "label" => "Department Id"],
        "position_id" => ["status" => true, "label" => "Position Id"],
        "level" => ["status" => true, "label" => "Level"],
        "other_info" => ["status" => true, "label" => "Other Info"],

    ];

    public function mount()
    {
        $this->authorize("company.users.listing");
    }

    function delete()
    {
        $this->authorize("company.users.delete");
        if ($this->confirm > 0) {
            User::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Users successfully destroyed.');
    }

    public function changeIsAdmin($record_id)
    {
        $this->authorize("company.companies.edit");
        $data  = User::findOrFail($record_id);

        $data->update([
            "is_admin" => !$data->is_admin
        ]);

        $this->dispatchBrowserEvent('success', 'Companies successfully Updated.');
    }

    public function render()
    {
        $data = new User();

        if ($this->fId > 0) {
            $data = $data->whereId($this->fId);
        }
        if ($this->sId == 1) {
            $data = $data->orderBy("id");
        }
        if ($this->sId == 2) {
            $data = $data->orderByDesc("id");
        }
        $data = $data->paginate(10);

        lForm()->setTitle("Nhân viên");
        lForm()->pushBreadcrumb(route("company"), "Company");
        lForm()->pushBreadcrumb(route("company.users"), "Users");

        $timekeepRules = TimekeepRule::all();
        $companies = Company::all();
        $departments = Department::all();
        $positions = Position::all();
        $profiles = StaffInfomation::all();

        return view("company::livewire.users.listing", compact("data", 'companies', 'departments', 'positions', 'timekeepRules', 'profiles'))
            ->layout('company::layouts.master', ['title' => 'Users Create']);
    }
}
