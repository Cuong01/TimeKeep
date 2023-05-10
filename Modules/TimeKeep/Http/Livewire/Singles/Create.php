<?php

namespace Modules\TimeKeep\Http\Livewire\Singles;

use App\Models\Application;
use App\Models\Company;
use App\Models\Holiday;
use App\Models\Single;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class   Create extends Component
{
    use WithLaravelFormTrait;

    public $user_id, $company_id, $name, $type, $value, $reason, $censor, $status = 0, $openLateSoon, $openCease, $openHoliday, $appli_id, $count, $day_max, $from, $to, $day_of, $day_apply, $late, $soon, $holiday_id, $salary_working, $from_day, $to_day;
    protected $rules = [
        'user_id' => '',
        'company_id' => '',
        'name' => '',
        'type' => '',
        'value' => '',
        'reason' => 'required',
        'censor' => 'required',
        'status' => '',
        'from' => 'required',
        'to' => 'required',
        'appli_id' => 'required',
        'day_apply' => 'required',
        'late' => 'required',
        'soon' => 'required',
        'holiday_id' => 'required'
    ];

    protected $messages = [
        'reason.required' => 'Hãy điền lý do',
        'censor.required' => 'Hãy chọn người duyệt đơn',
        'from.required' => 'Hãy điền ngày bắt đầu',
        'to.required' => 'Hãy điền ngày kết thúc',
        'appli_id.required' => 'Hãy chọn loại nghỉ',
        'day_apply.required' => 'Hãy điền ngày áp dụng',
        'late.required' => 'Hãy điền số phút đi muộn',
        'soon.required' => 'Hãy điền số phút về sớm',
        'holiday_id.required' => 'Hãy chọn ngày lễ',
    ];

    public function mount()
    {
        $companies = Company::where('id', Auth::user()->company_id)->first();
        $this->authorize("time-keep.singles.create");
        $this->done = 1;
        $this->user_id = Auth::user()->id;
        $this->name = Auth::user()->name;
        if (!empty($companies)) {
            $this->company_id = $companies['name'];
        }
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function updatedType()
    {
        if ($this->type == 1) {
            $this->openLateSoon = false;
            $this->openHoliday = false;
            $this->openCease = !$this->openCease;
        } elseif ($this->type == 2) {
            $this->openLateSoon = !$this->openLateSoon;
            $this->openHoliday = false;
            $this->openCease = false;
        } elseif ($this->type == 3) {
            $this->openCease = false;
            $this->openLateSoon = false;
            $this->openHoliday =  !$this->openHoliday;
        } else {
            $this->openCease = false;
            $this->openLateSoon = false;
            $this->openHoliday = false;
        }
    }

    public function store()
    {
        $type = $this->type;
        $this->authorize("time-keep.singles.create");
        if ($type == 1) {
            $this->validate([
                'reason' => 'required',
                'censor' => 'required',
                'from' => 'required',
                'to' => 'required',
                'appli_id' => 'required',
            ]);
        } elseif ($type == 2) {
            $this->validate([
                'reason' => 'required',
                'censor' => 'required',
                'day_apply' => 'required',
                'late' => 'required',
                'soon' => 'required',
            ]);
        } elseif ($type == 3) {
            $this->validate([
                'reason' => 'required',
                'censor' => 'required',
                'holiday_id' => 'required'
            ]);
        }
        switch ($type) {
            case 1: //đơn xin nghỉ
                $data = Single::create([
                    'user_id' =>  $this->user_id,
                    'company_id' => Auth::user()->company_id,
                    'name' => $this->name,
                    'type' => $type,
                    'value' => json_encode([
                        'from' => $this->from,
                        'to' => $this->to,
                        'appli_id' => $this->appli_id,
                        'count' => $this->count,
                        'day_max' => $this->day_max,
                        'day_of' => $this->day_of,
                    ]),
                    'reason' => $this->reason,
                    'censor' => $this->censor,
                    'status' => $this->status,

                ]);
                break;
            case 2: //đơn xin đi muộn, về sớm
                $data = Single::create([
                    'user_id' =>  $this->user_id,
                    'company_id' => Auth::user()->company_id,
                    'name' => $this->name,
                    'type' => $type,
                    'value' => json_encode([
                        'day_apply' => $this->day_apply,
                        'late' => $this->late,
                        'soon' => $this->soon,
                    ]),
                    'reason' => $this->reason,
                    'censor' => $this->censor,
                    'status' => $this->status,

                ]);
                break;
            case 3: //đơn đăng ký làm ngày lễ
                $data = Single::create([
                    'user_id' =>  $this->user_id,
                    'company_id' => Auth::user()->company_id,
                    'name' => $this->name,
                    'type' => $type,
                    'value' => json_encode([
                        'holiday_id' => $this->holiday_id,
                        'salary_working' => $this->salary_working,
                        'from_day' => $this->from_day,
                        'to_day' => $this->to_day
                    ]),
                    'reason' => $this->reason,
                    'censor' => $this->censor,
                    'status' => $this->status,

                ]);
                break;
            default:
                break;
        }

        if ($data) {
            return Redirect()->route("time-keep.singles");
        }
    }

    public function updatedAppliId()
    {
        $appli = Application::all();
        $ceases = Single::where('status', '1')->where('user_id', Auth::user()->id)->where('type', 1)->get();
        $day = [];
        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        if ($this->appli_id != 0) {
            foreach ($appli as $item) {
                if ($this->appli_id == $item->id) {
                    $this->count = $item->salary;
                    $this->day_max = $item->day;
                }
            }
            foreach ($ceases as $cease) {
                $value = json_decode($cease->value);
                if ($this->appli_id == $value->appli_id) {
                    $date1 = ltrim(date_format(date_create($value->from), 'd'), '0');
                    $date2 = ltrim(date_format(date_create($value->to), 'd'), '0');

                    for ($i = $date1; $i <= $date2; $i++) {
                        $day[] += $i;
                        $day = array_unique($day);
                    }
                }
            }
            $this->day_of = count($day);
        } else {
            $this->count = '';
            $this->day_max = '';
            $this->day_of = '';
        }
    }

    public function updatedHolidayId()
    {
        $holidays = Holiday::where('status', 1)->get();
        if ($this->holiday_id != 0) {
            foreach ($holidays as $key => $item) {
                if ($this->holiday_id == $item->id) {
                    $this->salary_working = $item->salary_working;
                    $this->from_day = $item->from_day;
                    $this->to_day = $item->to_day;
                }
            }
        } else {
            $this->salary_working = '';
            $this->from_day = '';
            $this->to_day = '';
        }
    }

    public function render()
    {
        lForm()->setTitle("Đơn");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.singles"), "Singles");
        lForm()->pushBreadcrumb(route("time-keep.singles.create"), "Create");

        $appli = Application::all()->pluck('name', 'id');
        $holiday = Holiday::where('status', 1)->pluck('name', 'id');
        $users = User::all()->pluck('name', 'id');

        return view("time-keep::livewire.singles.create", compact('appli', 'holiday', 'users'))
            ->layout('time-keep::layouts.master', ['title' => 'Singles Create']);
    }
}
