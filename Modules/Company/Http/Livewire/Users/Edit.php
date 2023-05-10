<?php

namespace Modules\Company\Http\Livewire\Users;

use App\Models\Company;
use App\Models\Department;
use App\Models\Position;
use App\Models\TimekeepRule;
use App\Models\User;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;



class Edit extends Component
{
	use WithLaravelFormTrait;
	use WithFileUploads;

	public $name, $email, $email_verified_at, $password, $two_factor_confirmed_at, $current_team_id, $profile_photo_path_file, $profile_photo_path_url, $is_admin, $birthday, $gender, $address, $phone, $company_id, $department_id, $position_id, $level, $other_info, $timekeep_rule;

	protected function rules()
	{
		return [
			'name' => 'string',
			'email' => 'email',
			'email_verified_at' => '',
			'password' => 'required|min:8',
			'two_factor_confirmed_at' => '',
			'current_team_id' => '',
			'is_admin' => '',
			'birthday' => '',
			'gender' => '',
			'address' => '',
			'phone' => '',
			'company_id' => '',
			'department_id' => '',
			'position_id' => '',
			'level' => '',
			'other_info' => '',

		];
	}

	public function  updatedProfilePhotoPathFile()
	{
		$this->validate([
			'profile_photo_path_file' => 'image|max:1024',
		]);
		if ($this->profile_photo_path_file) {
			$this->profile_photo_path_url = $this->profile_photo_path_file->temporaryUrl();
			// list($width, $height) = getimagesize($this->profile_photo_path_url);
			// $this->width = $width;
			// $this->height = $height;
		}
	}

	public function mount()
	{
		$this->authorize("company.users.edit");
		$data = User::findOrFail($this->record_id);
		$this->name = $data->name;
		$this->email = $data->email;
		$this->email_verified_at = $data->email_verified_at;
		$this->password = $data->password;
		$this->two_factor_confirmed_at = $data->two_factor_confirmed_at;
		$this->current_team_id = $data->current_team_id;
		$this->is_admin = $data->is_admin;
		$this->birthday = $data->birthday;
		$this->gender = $data->gender;
		$this->address = $data->address;
		$this->phone = $data->phone;
		$this->company_id = $data->company_id;
		$this->department_id = $data->department_id;
		$this->position_id = $data->position_id;
		$this->timekeep_rule = $data->timekeep_rule;

		// $this->level = $data->level;
		// $this->other_info = $data->other_info;
		// if ($data->profile_photo_path) {
		// 	$this->profile_photo_path_file = $data->profile_photo_path;
		// 	$this->profile_photo_path_url = "/storage/" . $data->profile_photo_path;
		// }
	}

	public function updated($field)
	{
		$this->validateOnly($field);
	}

	public function store()
	{
		$this->authorize("company.users.edit");
		$this->validate();
		$data = User::findOrFail($this->record_id);

		// if ($data->profile_photo_path) {
		// 	if ($data->profile_photo_path != $this->profile_photo_path_file) {
		// 		if ($this->profile_photo_path_file) {
		// 			$filename = $this->profile_photo_path_file->getClientOriginalName();
		// 			$arr = explode(".", $filename);
		// 			$ext = end($arr);

		// 			$data1 = $this->profile_photo_path_file->storeAs('photos', time() . ".$ext");
		// 		}
		// 		$data->fill([
		// 			'name' => $this->name,
		// 			'email' => $this->email,
		// 			'email_verified_at' => $this->email_verified_at,
		// 			'password' => $this->password,
		// 			'two_factor_confirmed_at' => $this->two_factor_confirmed_at,
		// 			'current_team_id' => $this->current_team_id,
		// 			'profile_photo_path' => $data1,
		// 			'is_admin' => $this->is_admin,
		// 			'birthday' => $this->birthday,
		// 			'gender' => $this->gender,
		// 			'address' => $this->address,
		// 			'phone' => $this->phone,
		// 			'company_id' => $this->company_id,
		// 			'department_id' => $this->department_id,
		// 			'position_id' => $this->position_id,
		// 			'level' => $this->level,
		// 			'other_info' => $this->other_info,

		// 		]);
		// 	} else {
		// 		$data->fill([
		// 			'name' => $this->name,
		// 			'email' => $this->email,
		// 			'email_verified_at' => $this->email_verified_at,
		// 			'password' => $this->password,
		// 			'two_factor_confirmed_at' => $this->two_factor_confirmed_at,
		// 			'current_team_id' => $this->current_team_id,
		// 			'is_admin' => $this->is_admin,
		// 			'birthday' => $this->birthday,
		// 			'gender' => $this->gender,
		// 			'address' => $this->address,
		// 			'phone' => $this->phone,
		// 			'company_id' => $this->company_id,
		// 			'department_id' => $this->department_id,
		// 			'position_id' => $this->position_id,
		// 			'level' => $this->level,
		// 			'other_info' => $this->other_info,

		// 		]);
		// 	}
		// } else {
		// 	if ($this->profile_photo_path_file) {
		// 		$filename = $this->profile_photo_path_file->getClientOriginalName();
		// 		$arr = explode(".", $filename);
		// 		$ext = end($arr);

		// 		$data1 = $this->profile_photo_path_file->storeAs('photos', time() . ".$ext");

		// 		$data->fill([
		// 			'name' => $this->name,
		// 			'email' => $this->email,
		// 			'email_verified_at' => $this->email_verified_at,
		// 			'password' => $this->password,
		// 			'two_factor_confirmed_at' => $this->two_factor_confirmed_at,
		// 			'current_team_id' => $this->current_team_id,
		// 			'profile_photo_path' => $data1,
		// 			'is_admin' => $this->is_admin,
		// 			'birthday' => $this->birthday,
		// 			'gender' => $this->gender,
		// 			'address' => $this->address,
		// 			'phone' => $this->phone,
		// 			'company_id' => $this->company_id,
		// 			'department_id' => $this->department_id,
		// 			'position_id' => $this->position_id,
		// 			'level' => $this->level,
		// 			'other_info' => $this->other_info,

		// 		]);
		// 	}
		// 	$data->fill([
		// 		'name' => $this->name,
		// 		'email' => $this->email,
		// 		'email_verified_at' => $this->email_verified_at,
		// 		'password' => $this->password,
		// 		'two_factor_confirmed_at' => $this->two_factor_confirmed_at,
		// 		'current_team_id' => $this->current_team_id,
		// 		'is_admin' => $this->is_admin,
		// 		'birthday' => $this->birthday,
		// 		'gender' => $this->gender,
		// 		'address' => $this->address,
		// 		'phone' => $this->phone,
		// 		'company_id' => $this->company_id,
		// 		'department_id' => $this->department_id,
		// 		'position_id' => $this->position_id,
		// 		'level' => $this->level,
		// 		'other_info' => $this->other_info,

		// 	]);
		// }

		$data->fill([
			'name' => $this->name,
			'email' => $this->email,
			'email_verified_at' => $this->email_verified_at,
			'password' => $this->password,
			'two_factor_confirmed_at' => $this->two_factor_confirmed_at,
			'current_team_id' => $this->current_team_id,
			'is_admin' => $this->is_admin,
			'birthday' => $this->birthday,
			'gender' => $this->gender,
			'address' => $this->address,
			'phone' => $this->phone,
			'company_id' => $this->company_id,
			'department_id' => $this->department_id,
			'position_id' => $this->position_id,
			'level' => $this->level,
			'other_info' => $this->other_info,
			'timekeep_rule' => $this->timekeep_rule

		]);


		if (!$data->clean) {
			$data->update();
			$this->redirectForm("company.users", $data->id);
		}
	}

	public function render()
	{
		lForm()->setTitle("Nhân viên");
		lForm()->pushBreadcrumb(route("company"), "Company");
		lForm()->pushBreadcrumb(route("company.users"), "Users");
		lForm()->pushBreadcrumb(route("company.users.edit", $this->record_id), "Edit");

		$timekeepRules = TimekeepRule::all()->pluck('name', 'id');
		$companies = Company::all()->pluck('name', 'id');
		$departments = Department::all()->pluck('name', 'id');
		$positions = Position::all()->pluck('name', 'id');

		return view("company::livewire.users.edit", compact('companies', 'departments', 'positions', 'timekeepRules'))
			->layout('company::layouts.master', ['title' => 'Users Edit']);
	}
}
