<?php

namespace Modules\Company\Http\Livewire\Users;

use App\Models\Company;
use App\Models\Department;
use App\Models\Position;
use App\Models\StaffInfomation;
use App\Models\TimekeepRule;
use App\Models\User;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Livewire\Component;

class   Create extends Component
{
	use WithLaravelFormTrait;
	use WithFileUploads;

	public $name, $email, $email_verified_at, $password, $two_factor_confirmed_at, $current_team_id, $profile_photo_path_file, $profile_photo_path_url, $is_admin, $birthday, $gender, $address, $phone, $company_id, $department_id, $position_id, $level, $other_info, $timekeep_rule, $profile_id;
	protected $rules = [
		'name' => 'string',
		'email' => '',
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

	public function mount()
	{
		$this->authorize("company.users.create");
		$this->done = 1;
		$data_user = User::where('profile_id', $this->record_id)->first();
		// dd($data_user);

		if (!empty($data_user)) {
			$this->email = $data_user->email;
			$this->password = $data_user->password;
			$this->is_admin = $data_user->is_admin;
			$this->name = $data_user->name;
			$this->timekeep_rule = $data_user->timekeep_rule;
		} else {
			$data = StaffInfomation::where('id', $this->record_id)->first();
			if ($data) {
				$this->name = $data->name;
				$this->timekeep_rule = $data->timekeep_rule;
				$this->profile_id = $this->record_id;
			}
		}
	}

	public function updated($field)
	{
		$this->validateOnly($field);
	}

	public function  updatedProfilePhotoPathFile()
	{
		$this->validate([
			'profile_photo_path_file' => 'image|max:1024',
		]);
		if ($this->profile_photo_path_file) {
			$this->profile_photo_path_url = $this->profile_photo_path_file->temporaryUrl();
			list($width, $height) = getimagesize($this->profile_photo_path_url);
			$this->width = $width;
			$this->height = $height;
		}
	}

	public function store()
	{
		$this->authorize("company.users.create");
		$this->validate();

		$data_user = User::where('profile_id', $this->record_id)->first();
		if (!empty($data_user)) {
			$data_user->fill([
				'email' => $this->email,
				// 'password' => bcrypt($this->password),
				'is_admin' => $this->is_admin,
			]);
			$data_user->update();
			return Redirect()->route('company.staff-infomations.edit', $this->record_id);
		} else {
			$data = User::create([
				'name' => $this->name,
				'email' => $this->email,
				'password' => bcrypt($this->password),
				'is_admin' => $this->is_admin,
				'timekeep_rule' => $this->timekeep_rule,
				'profile_id' => $this->record_id,
				'current_team_id' => 1
			]);

			return Redirect()->route('company.staff-infomations.edit', $this->record_id);
		}
	}

	public function render()
	{
		lForm()->setTitle("Nhân viên");
		lForm()->pushBreadcrumb(route("company"), "Company");
		lForm()->pushBreadcrumb(route("company.users"), "Users");
		lForm()->pushBreadcrumb(route("company.users.create", $this->record_id), "Create");

		$timekeepRules = TimekeepRule::all()->pluck('name', 'id');
		$companies = Company::all()->pluck('name', 'id');
		$departments = Department::all()->pluck('name', 'id');
		$positions = Position::all()->pluck('name', 'id');

		return view("company::livewire.users.create", compact('companies', 'departments', 'positions', 'timekeepRules'))
			->layout('company::layouts.master', ['title' => 'Users Create']);
	}
}
