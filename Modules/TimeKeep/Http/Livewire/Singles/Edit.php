<?php

namespace Modules\TimeKeep\Http\Livewire\Singles;

use App\Models\Application;
use App\Models\Company;
use App\Models\Holiday;
use App\Models\Single;
use App\Models\User;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class Edit extends Component
{
    use WithLaravelFormTrait;

    public $user_id, $company_id, $name, $type, $value, $reason, $censor, $status = 0, $openLateSoon, $openCease, $openHoliday, $appli_id, $count, $day_max, $from, $to, $day_of, $day_apply, $late, $soon, $holiday_id, $salary_working, $from_day, $to_day;

    protected function rules()
    {
        return [
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
    }

    protected function messages()
    {
        return [
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
    }

    public function mount()
    {
        $companies = Company::get();
        $this->authorize("time-keep.singles.edit");
        $data = Single::findOrFail($this->record_id);
        $type = $data->type;
        $this->user_id = $data->user_id;
        $this->name = $data->name;
        $this->type = $type;
        foreach ($companies as $com) {
            if ($data->company_id == $com->id) {
                $this->company_id = $com->name;
            }
        }
        $this->reason = $data->reason;
        $this->censor = $data->censor;

        $value = json_decode($data->value);
        switch ($type) {
            case 1:
                $this->from = $value->from;
                $this->to = $value->to;
                $this->appli_id = $value->appli_id;
                $this->count = $value->count;
                $this->day_max = $value->day_max;
                $this->day_of = $value->day_of;
                break;
            case 2:
                $this->day_apply = $value->day_apply;
                $this->late = $value->late;
                $this->soon = $value->soon;
                break;
            case 3:
                $this->holiday_id = $value->holiday_id;
                $this->salary_working = $value->salary_working;
                $this->from_day = $value->from_day;
                $this->to_day = $value->to_day;
                break;
        }
        $this->status = $data->status;
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function store()
    {
        $type = $this->type;
        $this->authorize("time-keep.singles.edit");
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
        $data = Single::findOrFail($this->record_id);
        switch ($type) {
            case 1: //đơn xin nghỉ
                $data->fill([
                    // 'user_id' =>  $this->user_id,
                    // 'company_id' => Auth::user()->company_id,
                    // 'name' => $this->name,
                    // 'type' => $type,
                    // 'value' => json_encode([
                    //     'from' => $this->from,
                    //     'to' => $this->to,
                    //     'appli_id' => $this->appli_id,
                    //     'count' => $this->count,
                    //     'day_max' => $this->day_max,
                    //     // 'day_of' => $this->day_of,
                    // ]),
                    // 'reason' => $this->reason,
                    // 'censor' => Auth::user()->id,
                    'status' => $this->status,

                ]);
                break;
            case 2: //đơn xin đi muộn, về sớm
                $data->fill([
                    // 'user_id' =>  $this->user_id,
                    // 'company_id' => Auth::user()->company_id,
                    // 'name' => $this->name,
                    // 'type' => $type,
                    // 'value' => json_encode([
                    //     'day_apply' => $this->day_apply,
                    //     'late' => $this->late,
                    //     'soon' => $this->soon,
                    // ]),
                    // 'reason' => $this->reason,
                    // 'censor' => Auth::user()->id,
                    'status' => $this->status,

                ]);
                break;
            case 3: //đơn đăng ký làm ngày lễ
                $data->fill([
                    // 'user_id' =>  $this->user_id,
                    // 'company_id' => Auth::user()->company_id,
                    // 'name' => $this->name,
                    // 'type' => $type,
                    // 'value' => json_encode([
                    //     'holiday_id' => $this->holiday_id,
                    //     'salary_working' => $this->salary_working,
                    // ]),
                    // 'reason' => $this->reason,
                    // 'censor' => Auth::user()->id,
                    'status' => $this->status,

                ]);
                break;
            default:
                break;
        }

        if (!$data->clean) {
            $data->update();
            return Redirect()->route("time-keep.singles");
        }
    }

    public function render()
    {
        lForm()->setTitle("Đơn");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.singles"), "Singles");
        lForm()->pushBreadcrumb(route("time-keep.singles.edit", $this->record_id), "Edit");

        $appli = Application::all()->pluck('name', 'id');
        $holiday = Holiday::all()->pluck('name', 'id');
        $users = User::all()->pluck('name', 'id');

        return view("time-keep::livewire.singles.edit", compact('appli', 'holiday', 'users'))
            ->layout('time-keep::layouts.master', ['title' => 'Singles Edit']);
    }
}
