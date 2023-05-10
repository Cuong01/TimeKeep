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


class Edit extends Component
{
	use WithLaravelFormTrait;
	use WithFileUploads;

	public $profile_id, $name, $some_contracts, $sign_day, $type, $effective_date, $expiration_date, $type_of_work, $rank, $total_salary, $salary_received, $basic_salary, $pay_forms, $salary_paid_for_insurance, $salary_percentage, $salary_allowance, $signed_representative, $position_id, $note, $file, $file_url, $active;

	protected $rules = [
		'profile_id' => 'required',
		'name' => '',
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

	public function  updatedFile()
	{
		$this->validate([
			'file' => 'image|max:1024',
		]);
		if ($this->file) {
			$this->file_url = $this->file->temporaryUrl();
		}
	}

	public function mount()
	{
		$this->authorize("company.contracts.edit");
		$data = Contract::findOrFail($this->record_id);
		$this->profile_id = $data->profile_id;
		$this->name = $data->name;
		$this->some_contracts = $data->some_contracts;
		$this->sign_day = $data->sign_day;
		$this->type = $data->type;
		$this->effective_date = $data->effective_date;
		$this->expiration_date = $data->expiration_date;
		$this->type_of_work = $data->type_of_work;
		$this->rank = $data->rank;
		$this->total_salary = number_format(floatval($data->total_salary), 0, ',', '.');
		$this->salary_received = number_format(floatval($data->salary_received), 0, ',', '.');
		$this->basic_salary = number_format(floatval($data->basic_salary), 0, ',', '.');
		$this->pay_forms = $data->pay_forms;
		$this->salary_paid_for_insurance = $data->salary_paid_for_insurance;
		$this->salary_percentage = $data->salary_percentage;
		$this->salary_allowance = number_format(floatval($data->salary_allowance), 0, ',', '.');
		$this->signed_representative = $data->signed_representative;
		$this->position_id = $data->position_id;
		$this->note = $data->note;
		if (!empty($data->file)) {
			$this->file = $data->file->name;
			$this->file_url = "/" . $data->file->name;
		}
	}

	public function updated($field)
	{
		$this->validateOnly($field);
	}

	public function store()
	{
		$this->authorize("company.contracts.edit");
		$this->validate();
		$data = Contract::findOrFail($this->record_id);
		if ($this->file) {
			if ($data->file->name != $this->file) {
				$filename = $this->file->getClientOriginalName();
				$arr = explode(".", $filename);
				$ext = end($arr);

				$data1 = $this->file->storeAs('photos', time() . ".$ext");
				$image1 = Storage::path($data1);
				list($width, $height) = getimagesize($image1);
				$image = [
					"name" => $data1, "width" => $width, "height" => $height
				];
				$data->fill([
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
				]);
			} else {
				$data->fill([
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
				]);
			}
		} else {
			$data->fill([
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
			]);
		}
		$a = Contract::where('profile_id', $this->profile_id)->where('active', 1)->first();

		$update = StaffInfomation::where('id', $this->profile_id)->first();
		if ($this->record_id == $a->id) {
			if (!empty($update)) {
				$update->fill([
					// 'contract_id' => $a->id,
					'total_salary' => str_replace('.', '', $this->total_salary),
					'salary_received' => str_replace('.', '', $this->salary_received),
					'type_contract' => $this->type,
					'sign_day' => $this->effective_date,
					'expiration_date' => $this->expiration_date,
				]);
				$update->update();
			}
		}
		if (!$data->clean) {
			$data->update();
			return Redirect()->route('company.staff-infomations.edit', $this->profile_id);
		}
	}

	public function render()
	{
		lForm()->setTitle("Hợp đồng");
		lForm()->pushBreadcrumb(route("company"), "Company");
		lForm()->pushBreadcrumb(route("company.contracts"), "Contracts");
		lForm()->pushBreadcrumb(route("company.contracts.edit", $this->record_id), "Edit");

		$users = StaffInfomation::all()->pluck('name', 'id');
		$departments = Department::all()->pluck('name', 'id');
		$positions = Position::all()->pluck('name', 'id');

		return view("company::livewire.contracts.edit", compact('users', 'departments', 'positions'))
			->layout('company::layouts.master', ['title' => 'Contracts Edit']);
	}
}
