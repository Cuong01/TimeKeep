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
use Illuminate\Http\Request;
use Livewire\Component;


class Edit extends Component
{
	use WithLaravelFormTrait;

	public $name, $place_of_birth, $home_town, $ethnic, $religion, $permanent_address, $temporary_residence_address, $tax_code, $id_number, $place_of_issue_of_id_card, $date_of_issue_of_id_card, $relative_phone_number, $relative_name, $foreign_language, $computer_skill, $educational_level, $academic_level, $specialized, $insurance_number, $insurance_participation_date, $registration_address, $examination_and_treatment, $health, $weight, $height, $bank_name, $account_number, $note, $contract_id, $total_salary, $salary_received, $type_contract, $sign_day, $expiration_date, $birthday, $gender, $company_id, $department_id, $position_id, $timekeep_rule, $profile_id, $phone, $email, $facebook, $zalo;

	public $email1, $password, $is_admin, $user_id1, $phone1, $user_name;

	protected function rules()
	{
		return [
			'place_of_birth' => '',
			'home_town' => '',
			'ethnic' => '',
			'religion' => '',
			'permanent_address' => '',
			'temporary_residence_address' => '',
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
	}

	protected function messages()
	{
		return [
			'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
		];
	}

	public function mount()
	{
		$this->authorize("company.staff-infomations.edit");
		$data = StaffInfomation::findOrFail($this->record_id);
		$this->profile_id = $data->id;
		$this->name = $data->name;
		$this->gender = $data->gender;
		$this->company_id = $data->company_id;
		$this->department_id = $data->department_id;
		$this->position_id = $data->position_id;
		$this->timekeep_rule = $data->timekeep_rule;
		$this->birthday = $data->birthday;
		$this->place_of_birth = $data->place_of_birth;
		$this->home_town = $data->home_town;
		$this->ethnic = $data->ethnic;
		$this->religion = $data->religion;
		$this->permanent_address = $data->permanent_address;
		$this->temporary_residence_address = $data->temporary_residence_address;
		$this->tax_code = $data->tax_code;
		$this->id_number = $data->id_number;
		$this->place_of_issue_of_id_card = $data->place_of_issue_of_id_card;
		$this->date_of_issue_of_id_card = $data->date_of_issue_of_id_card;
		$this->relative_phone_number = $data->relative_phone_number;
		$this->relative_name = $data->relative_name;
		$this->foreign_language = $data->foreign_language;
		$this->computer_skill = $data->computer_skill;
		$this->educational_level = $data->educational_level;
		$this->academic_level = $data->academic_level;
		$this->specialized = $data->specialized;
		$this->insurance_number = $data->insurance_number;
		$this->insurance_participation_date = $data->insurance_participation_date;
		$this->registration_address = $data->registration_address;
		$this->examination_and_treatment = $data->examination_and_treatment;
		$this->health = $data->health;
		$this->weight = $data->weight;
		$this->height = $data->height;
		$this->bank_name = $data->bank_name;
		$this->account_number = $data->account_number;
		$this->note = $data->note;
		$this->contract_id = $data->contract_id;
		$this->total_salary = number_format(floatval($data->total_salary), 0, ',', '.');
		$this->salary_received = number_format(floatval($data->salary_received), 0, ',', '.');
		$this->type_contract = $data->type_contract;
		$this->sign_day = $data->sign_day;
		$this->expiration_date = $data->expiration_date;
		$this->phone = $data->phone;
		$this->email = $data->email;
		$this->facebook = $data->facebook;
		$this->zalo = $data->zalo;
		$data_user = User::where('profile_id', $this->record_id)->first();
		if (!empty($data_user)) {
			$this->user_id1 = $data_user->id;
			$this->user_name = $data_user->user_name;
			$this->phone1 = $data_user->phone;
			$this->email1 = $data_user->email;
			$this->password = $data_user->password;
			$this->is_admin = $data_user->is_admin;
		} else {
			$this->user_name = strtolower(str_replace(' ', '', vn_str_filter($data->name))) . $data->id;
			$this->phone1 = $data->phone;
			$this->email1 = $data->email;
		}
	}



	public function updated($field)
	{
		$this->validateOnly($field);
	}

	public function changeIsAdmin($record_id)
	{
		$data  = User::findOrFail($record_id);

		$data->update([
			"is_admin" => !$data->is_admin
		]);

		$this->dispatchBrowserEvent('success', 'Companies successfully Updated.');
	}

	public function changeActive($record_id)
	{
		$data  = Contract::findOrFail($record_id);

		Contract::where('profile_id', $this->record_id)->where('active', 1)->update([
			"active" => $data->active
		]);
		$data->update([
			"active" => !$data->active
		]);

		$update = StaffInfomation::where('id', $this->profile_id)->first();
		$update->fill([
			'contract_id' => $data->id,
			'total_salary' => $data->total_salary,
			'salary_received' => $data->salary_received,
			'type_contract' => $data->type,
			'sign_day' => $data->effective_date,
			'expiration_date' => $data->expiration_date,
		]);
		$update->update();

		return Redirect()->route('company.staff-infomations.edit', $this->record_id);
	}

	public function store()
	{
		$this->authorize("company.staff-infomations.edit");
		$this->validate();
		$data = StaffInfomation::findOrFail($this->record_id);
		$data->fill([
			'name' => $this->name,
			'gender' => $this->gender,
			'company_id' => $this->company_id,
			'department_id' => $this->department_id,
			'position_id' => $this->position_id,
			'timekeep_rule' => $this->timekeep_rule,
			'place_of_birth' => $this->place_of_birth,
			'home_town' => $this->home_town,
			'ethnic' => $this->ethnic,
			'religion' => $this->religion,
			'permanent_address' => $this->permanent_address,
			'temporary_residence_address' => $this->temporary_residence_address,
			'phone' => $this->phone,
			'email' => $this->email,
			'facebook' => $this->facebook,
			'zalo' => $this->zalo,
			'tax_code' => $this->tax_code,
			'id_number' => $this->id_number,
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
			'total_salary' => str_replace('.', '', $this->total_salary),
			'salary_received' => str_replace('.', '', $this->salary_received),
			'type_contract' => $this->type_contract,
			'sign_day' => $this->sign_day,
			'expiration_date' => $this->expiration_date,

		]);

		$data1 = User::where('profile_id', $this->record_id)->first();
		if (!empty($data1)) {
			$data1->fill([
				'name' => $this->name,
				'timekeep_rule' =>  $this->timekeep_rule,
				'company_id' => $this->company_id,
			]);
			$data1->update();
		}

		if (!$data->clean) {
			$data->update();
			return Redirect()->route("company.staff-infomations");
		}
	}

	public function createUser()
	{
		$this->validate([
			'password' => 'min:8',
		]);
		$data = User::create([
			'name' => $this->name,
			'user_name' => $this->user_name,
			'phone' => $this->phone1,
			'email' => $this->email1,
			'password' => bcrypt($this->password),
			'is_admin' => $this->is_admin,
			'timekeep_rule' => $this->timekeep_rule,
			'profile_id' => $this->record_id,
			'company_id' => $this->company_id,
			'current_team_id' => 1
		]);

		return Redirect()->route('company.staff-infomations.edit', $this->record_id);
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

	public function render()
	{
		lForm()->setTitle("Thông tin nhân viên");
		lForm()->pushBreadcrumb(route("company"), "Company");
		lForm()->pushBreadcrumb(route("company.staff-infomations"), "Staff Infomations");
		lForm()->pushBreadcrumb(route("company.staff-infomations.edit", $this->record_id), "Edit");

		$users = StaffInfomation::all()->pluck('name', 'id');
		$contracts = Contract::where('profile_id', $this->profile_id)->get();
		$day = strtotime(date_format(Carbon::now(), 'd-m-Y'));
		$timekeepRules = TimekeepRule::all()->pluck('name', 'id');
		$companies = Company::all()->pluck('name', 'id');
		$departments = Department::all()->pluck('name', 'id');
		$positions = Position::all()->pluck('name', 'id');

		return view("company::livewire.staff-infomations.edit", compact('users', 'contracts', 'day', 'companies', 'departments', 'positions', 'timekeepRules'))
			->layout('company::layouts.master', ['title' => 'Staff Infomations Edit']);
	}
}
