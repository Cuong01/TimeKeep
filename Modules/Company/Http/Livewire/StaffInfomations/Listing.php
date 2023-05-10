<?php

namespace Modules\Company\Http\Livewire\StaffInfomations;

use App\Models\Company;
use App\Models\Department;
use App\Models\Position;
use App\Models\StaffInfomation;
use App\Models\TimekeepRule;
use Carbon\Carbon;
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
        "place_of_birth" => ["status" => true, "label" => "Place Of Birth"],
        "home_town" => ["status" => true, "label" => "Home Town"],
        "ethnic" => ["status" => true, "label" => "Ethnic"],
        "religion" => ["status" => true, "label" => "Religion"],
        "permanent_address" => ["status" => true, "label" => "Permanent Address"],
        "temporary_residence_address" => ["status" => true, "label" => "Temporary Residence Address"],
        "tax_code" => ["status" => true, "label" => "Tax Code"],
        "id_number" => ["status" => true, "label" => "Id Number"],
        "place_of_issue_of_id_card" => ["status" => true, "label" => "Place Of Issue Of Id Card"],
        "date_of_issue_of_id_card" => ["status" => true, "label" => "Date Of Issue Of Id Card"],
        "relative_phone_number" => ["status" => true, "label" => "Relative Phone Number"],
        "relative_name" => ["status" => true, "label" => "Relative Name"],
        "foreign_language" => ["status" => true, "label" => "Foreign Language"],
        "computer_skill" => ["status" => true, "label" => "Computer Skill"],
        "educational_level" => ["status" => true, "label" => "Educational Level"],
        "academic_level" => ["status" => true, "label" => "Academic Level"],
        "specialized" => ["status" => true, "label" => "Specialized"],
        "insurance_number" => ["status" => true, "label" => "Insurance Number"],
        "insurance_participation_date" => ["status" => true, "label" => "Insurance Participation Date"],
        "registration_address" => ["status" => true, "label" => "Registration Address"],
        "examination_and_treatment" => ["status" => true, "label" => "Examination And Treatment"],
        "health" => ["status" => true, "label" => "Health"],
        "weight" => ["status" => true, "label" => "Weight"],
        "height" => ["status" => true, "label" => "Height"],
        "bank_name" => ["status" => true, "label" => "Bank Name"],
        "account_number" => ["status" => true, "label" => "Account Number"],
        "note" => ["status" => true, "label" => "Note"],
        "contract_id" => ["status" => true, "label" => "Contract Id"],
        "total_salary" => ["status" => true, "label" => "Total Salary"],
        "salary_received" => ["status" => true, "label" => "Salary Received"],
        "type_contract" => ["status" => true, "label" => "Type Contract"],
        "sign_day" => ["status" => true, "label" => "Sign Day"],
        "expiration_date" => ["status" => true, "label" => "Expiration Date"],
        "created_at" => ["status" => true, "label" => "Created At"],
        "updated_at" => ["status" => true, "label" => "Updated At"],

    ];

    public function mount()
    {
        $this->authorize("company.staff-infomations.listing");
    }

    function delete()
    {
        $this->authorize("company.staff-infomations.delete");
        if ($this->confirm > 0) {
            StaffInfomation::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Staff Infomations successfully destroyed.');
    }

    public function render()
    {
        $data = new StaffInfomation();

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

        lForm()->setTitle("Thông tin nhân viên");
        lForm()->pushBreadcrumb(route("company"), "Company");
        lForm()->pushBreadcrumb(route("company.staff-infomations"), "Staff Infomations");

        $timekeepRules = TimekeepRule::all();
        $companies = Company::all();
        $departments = Department::all();
        $positions = Position::all();
        $day = strtotime(date_format(Carbon::now(), 'd-m-Y'));

        return view("company::livewire.staff-infomations.listing", compact("data", 'companies', 'departments', 'positions', 'timekeepRules', 'day'))
            ->layout('company::layouts.master', ['title' => 'Staff Infomations Listing']);
    }
}
