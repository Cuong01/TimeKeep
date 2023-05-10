<?php

namespace Modules\Company\Http\Livewire\StaffInfomations;

use App\Models\Company;
use App\Models\Contract;
use App\Models\Department;
use App\Models\Position;
use App\Models\StaffInfomation;
use App\Models\TimekeepRule;
use App\Models\User;
use Carbon\Carbon;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;

class   Create extends Component
{
	use WithLaravelFormTrait;

	public $name, $place_of_birth, $home_town, $ethnic, $religion, $permanent_address, $temporary_residence_address, $tax_code, $id_number, $place_of_issue_of_id_card, $date_of_issue_of_id_card, $relative_phone_number, $relative_name, $foreign_language, $computer_skill, $educational_level, $academic_level, $specialized, $insurance_number, $insurance_participation_date, $registration_address, $examination_and_treatment, $health, $weight, $height, $bank_name, $account_number, $note, $contract_id, $total_salary, $salary_received, $type_contract, $sign_day, $expiration_date, $birthday, $gender, $company_id, $department_id, $position_id, $timekeep_rule, $phone, $email, $facebook, $zalo;

	public $openA, $openB, $openC, $openD;
	protected $rules = [
		'name' => 'required',
		'gender' => '',
		'birthday' => '',
		'place_of_birth' => '',
		'home_town' => 'required',
		'ethnic' => '',
		'religion' => '',
		'permanent_address' => 'required',
		'temporary_residence_address' => 'required',
		'tax_code' => '',
		'id_number' => '',
		'place_of_issue_of_id_card' => '',
		'date_of_issue_of_id_card' => '',
		'relative_phone_number' => '',
		'relative_name' => '',
		'foreign_language' => '',
		'computer_skill' => '',
		'educational_level' => '',
		'academic_level' => '',
		'specialized' => '',
		'insurance_number' => '',
		'insurance_participation_date' => '',
		'registration_address' => '',
		'examination_and_treatment' => '',
		'health' => '',
		'weight' => '',
		'height' => '',
		'bank_name' => '',
		'account_number' => '',
		'note' => '',
		'contract_id' => '',
		'total_salary' => '',
		'salary_received' => '',
		'type_contract' => '',
		'sign_day' => '',
		'expiration_date' => '',

	];

	protected $messages = [
		'name.required' => 'Không được để trống tên',
		'home_town.required' => 'Không được để trống quê quán',
		'permanent_address.required' => 'Không được để trống đia chỉ thường chú',
		'temporary_residence_address.required' => 'Không được để trống địa chỉ tạm chú',
	];

	public function mount()
	{
		$this->authorize("company.staff-infomations.create");
		$this->done = 1;
	}

	public function updated($field)
	{
		$this->validateOnly($field);
	}

	public $buttonClick = 1, $boxProfile = 1;
	public function buttonClick($event)
	{
		$this->buttonClick = $event;
	}
	public function boxProfile($rep)
	{
		$this->boxProfile = $rep;
	}


	public function store()
	{
		$this->authorize("company.staff-infomations.create");
		$this->validate();

		$data = StaffInfomation::create([
			'name' => $this->name,
			'gender' => $this->gender,
			'company_id' => $this->company_id,
			'department_id' => $this->department_id,
			'position_id' => $this->position_id,
			'timekeep_rule' => $this->timekeep_rule,
			'place_of_birth' => $this->place_of_birth,
			'birthday' => $this->birthday,
			'home_town' => $this->home_town,
			'ethnic' => $this->ethnic,
			'religion' => $this->religion,
			'permanent_address' => $this->permanent_address,
			'temporary_residence_address' => $this->temporary_residence_address,
			'tax_code' => $this->tax_code,
			'id_number' => $this->id_number,
			'phone' => $this->phone,
			'email' => $this->email,
			'facebook' => $this->facebook,
			'zalo' => $this->zalo,
			'place_of_issue_of_id_card' => $this->place_of_issue_of_id_card,
			'date_of_issue_of_id_card' => $this->date_of_issue_of_id_card,
			'relative_phone_number' => $this->relative_phone_number,
			'relative_name' => $this->relative_name,
			'foreign_language' => $this->foreign_language,
			'computer_skill' => $this->computer_skill,
			'educational_level' => $this->educational_level,
			'academic_level' => $this->academic_level,
			'specialized' => $this->specialized,
			'insurance_number' => $this->insurance_number,
			'insurance_participation_date' => $this->insurance_participation_date,
			'registration_address' => $this->registration_address,
			'examination_and_treatment' => $this->examination_and_treatment,
			'health' => $this->health,
			'weight' => $this->weight,
			'height' => $this->height,
			'bank_name' => $this->bank_name,
			'account_number' => $this->account_number,
			'note' => $this->note,
			'contract_id' => $this->contract_id,
			'total_salary' => $this->total_salary,
			'salary_received' => $this->salary_received,
			'type_contract' => $this->type_contract,
			'sign_day' => $this->sign_day,
			'expiration_date' => $this->expiration_date,

		]);
		if ($data) {
			return Redirect()->route("company.staff-infomations");
		}
	}

	public function render()
	{
		lForm()->setTitle("Thông tin nhân viên");
		lForm()->pushBreadcrumb(route("company"), "Company");
		lForm()->pushBreadcrumb(route("company.staff-infomations"), "Staff Infomations");
		lForm()->pushBreadcrumb(route("company.staff-infomations.create"), "Create");

		$day = strtotime(date_format(Carbon::now(), 'd-m-Y'));
		$timekeepRules = TimekeepRule::all()->pluck('name', 'id');
		$companies = Company::all()->pluck('name', 'id');
		$departments = Department::all()->pluck('name', 'id');
		$positions = Position::all()->pluck('name', 'id');

		return view("company::livewire.staff-infomations.create", compact('day', 'companies', 'departments', 'positions', 'timekeepRules'))
			->layout('company::layouts.master', ['title' => 'Staff Infomations Create']);
	}
}
