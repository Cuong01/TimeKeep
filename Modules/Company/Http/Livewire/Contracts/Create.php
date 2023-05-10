<?php

namespace Modules\Company\Http\Livewire\Contracts;

use App\Models\Contract;
use App\Models\Department;
use App\Models\Position;
use App\Models\StaffInfomation;
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

	public $profile_id, $name, $some_contracts, $sign_day, $type, $effective_date, $expiration_date, $type_of_work, $rank, $total_salary, $salary_received, $basic_salary, $pay_forms, $salary_paid_for_insurance, $salary_percentage, $salary_allowance = 0, $signed_representative, $position_id, $note, $file, $file_url, $active = 0;
	protected $rules = [
		'profile_id' => 'required',
		'name' => 'required',
		'some_contracts' => 'required',
		'sign_day' => '',
		'type' => '',
		'effective_date' => 'required',
		'expiration_date' => 'required',
		'type_of_work' => '',
		'rank' => '',
		'total_salary' => 'required',
		'salary_received' => 'required',
		'basic_salary' => 'required',
		'pay_forms' => '',
		'salary_paid_for_insurance' => '',
		'salary_percentage' => '',
		'salary_allowance' => '',
		'signed_representative' => '',
		'position_id' => '',
		'note' => '',
		'file' => '',

	];

	protected $messages = [
		'profile_id.required' => 'Không được để trống',
		'some_contracts.required' => 'Không được để trống số hợp đồng',
		'name.required' => 'Không được để trống tên hợp đồng',
		'effective_date.required' => 'Không được để trống ngày bắt đầu hợp đồng',
		'expiration_date.required' => 'Không được để trống ngày kết thúc hợp đồng',
		'total_salary.required' => 'Không được để trống tổng tiền lương',
		'salary_received.required' => 'Không được để trống lương thực lãnh',
		'basic_salary.required' => 'Không được để trống lương cơ bản',
	];

	public function updatedTotalSalary()
	{
		$value1 = str_replace('.', '', $this->total_salary);
		$data12 = number_format(floatval($value1), 0, ',', '.');
		$this->total_salary = $data12;
	}

	public function updatedSalaryReceived()
	{
		$value1 = str_replace('.', '', $this->salary_received);
		$data12 = number_format(floatval($value1), 0, ',', '.');
		$this->salary_received = $data12;
	}

	public function updatedBasicSalary()
	{
		$value1 = str_replace('.', '', $this->basic_salary);
		$data12 = number_format(floatval($value1), 0, ',', '.');
		$this->basic_salary = $data12;
	}

	public function updatedSalaryAllowance()
	{
		$value1 = str_replace('.', '', $this->salary_allowance);
		$data12 = number_format(floatval($value1), 0, ',', '.');
		$this->salary_allowance = $data12;
	}

	public function mount()
	{
		$this->authorize("company.contracts.create");
		$this->done = 1;
		$this->profile_id = $this->record_id;
	}

	public function updated($field)
	{
		$this->validateOnly($field);
	}

	public function  updatedFile()
	{
		$this->validate([
			'file' => 'image|max:1024',
		]);
		if ($this->file) {
			$this->file_url = $this->file->temporaryUrl();
		}
	}

	public function store()
	{

		$this->authorize("company.contracts.create");
		$this->validate();

		if ($this->file) {
			$filename = $this->file->getClientOriginalName();
			$arr = explode(".", $filename);
			$ext = end($arr);

			$data1 = $this->file->storeAs('photos', time() . ".$ext");
			$image1 = Storage::path($data1);
			list($width, $height) = getimagesize($image1);
			$image = [
				"name" => $data1, "width" => $width, "height" => $height
			];
			$data = Contract::create([
				'profile_id' => $this->profile_id,
				'name' => $this->name,
				'some_contracts' => $this->some_contracts,
				'sign_day' => $this->sign_day,
				'type' => $this->type,
				'effective_date' => $this->effective_date,
				'expiration_date' => $this->expiration_date,
				'type_of_work' => $this->type_of_work,
				'rank' => $this->rank,
				'total_salary' => str_replace('.', '', $this->total_salary),
				'salary_received' => str_replace('.', '', $this->salary_received),
				'basic_salary' => str_replace('.', '', $this->basic_salary),
				'pay_forms' => $this->pay_forms,
				'salary_paid_for_insurance' => $this->salary_paid_for_insurance,
				'salary_percentage' => $this->salary_percentage,
				'salary_allowance' => str_replace('.', '', $this->salary_allowance),
				'signed_representative' => $this->signed_representative,
				'position_id' => $this->position_id,
				'note' => $this->note,
				'file' => $image,
				'active' => $this->active,
			]);
		} else {
			$data = Contract::create([
				'profile_id' => $this->profile_id,
				'name' => $this->name,
				'some_contracts' => $this->some_contracts,
				'sign_day' => $this->sign_day,
				'type' => $this->type,
				'effective_date' => $this->effective_date,
				'expiration_date' => $this->expiration_date,
				'type_of_work' => $this->type_of_work,
				'rank' => $this->rank,
				'total_salary' => str_replace('.', '', $this->total_salary),
				'salary_received' => str_replace('.', '', $this->salary_received),
				'basic_salary' => str_replace('.', '', $this->basic_salary),
				'pay_forms' => $this->pay_forms,
				'salary_paid_for_insurance' => $this->salary_paid_for_insurance,
				'salary_percentage' => $this->salary_percentage,
				'salary_allowance' => str_replace('.', '', $this->salary_allowance),
				'signed_representative' => $this->signed_representative,
				'position_id' => $this->position_id,
				'note' => $this->note,
				'active' => $this->active,
			]);
		}

		if ($data) {
			return Redirect()->route('company.staff-infomations.edit', $this->record_id);
		}
	}

	public function render()
	{
		lForm()->setTitle("Hợp đồng");
		lForm()->pushBreadcrumb(route("company"), "Company");
		lForm()->pushBreadcrumb(route("company.contracts"), "Contracts");
		lForm()->pushBreadcrumb(route("company.contracts.create", $this->record_id), "Create");

		$users = StaffInfomation::all()->pluck('name', 'id');
		$departments = Department::all()->pluck('name', 'id');
		$positions = Position::all()->pluck('name', 'id');

		return view("company::livewire.contracts.create", compact('users', 'departments', 'positions'))
			->layout('company::layouts.master', ['title' => 'Contracts Create']);
	}
}
