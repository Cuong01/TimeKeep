<?php

namespace Modules\TimeKeep\Http\Livewire\TimekeepRules;

use App\Models\TimekeepRule;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Edit extends Component
{
    use WithLaravelFormTrait;

    public $selected = false;


    public $name, $value, $status = '1', $day_apply = [], $type;
    public $input_time_mor, $output_time_mor, $count_mor, $input_time_aft, $output_time_aft, $count_aft, $input_time_shift, $output_time_shift, $count_shift, $option_before_mors = [], $option_after_mors = [], $option_before_afts = [], $option_after_afts = [], $option_penance_lates = [], $option_penance_soons = [], $option_after_shifts = [], $option_before_shifts = [], $sum_time_shift, $sum_time_aft, $sum_time_mor;


    protected function rules()
    {
        return [
            'name' => 'required|min:5',
            'value' => '',
            'status' => '',
            'count_mor' => 'required|numeric|min:0|max:2',
            'count_aft' => 'required|numeric|min:0|max:2',
            'count_shift' => 'required|numeric|min:0|max:2',

            'input_time_mor' => 'required|date_format:"H:i"|after:"00:00"|before:"output_time_mor"|before:"12:01"',
            'output_time_mor' => 'required|date_format:"H:i"|after:"input_time_mor"|after:"00:00"|before:"12:01"',
            'input_time_aft' => 'required|date_format:"H:i"|after:"12:00"|before:"23:59"|before:"output_time_aft"',
            'output_time_aft' => 'required|date_format:"H:i"|after:"12:00"|before:"23:59"|after:"input_time_aft"',
            'option_after_mors.*.count_after' => 'numeric|min:0|max:"2"',
            'option_before_mors.*.count_before' => 'numeric|min:0|max:"2"',
            'option_after_afts.*.count_after' => 'numeric|min:0|max:"2"',
            'option_before_afts.*.count_before' => 'numeric|min:0|max:"2"',

            'input_time_shift' => 'required|date_format:"H:i"|before:"output_time_shift"',
            'output_time_shift' => 'required|date_format:"H:i"|after:"input_time_shift"',
            'option_after_shifts.*.count_after' => 'numeric|min:0|max:"2"',
            'option_before_shifts.*.count_before' => 'numeric|min:0|max:"2"',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'Không được bỏ trống tên.',
            'name.min' => 'Tên phải từ 5 ký tự trở lên.',

            'count_mor.required' => 'Không được bỏ trống số công',
            'count_mor.numeric' => 'Công là dạng số',
            'count_mor.min' => 'Số công phải >= 0',
            'count_mor.max' => 'Số công phải <= 2',

            'count_aft.required' => 'Không được bỏ trống số công',
            'count_aft.numeric' => 'Công là dạng số',
            'count_aft.min' => 'Số công phải >= 0',
            'count_aft.max' => 'Số công phải <= 2',

            'count_shift.required' => 'Không được bỏ trống số công',
            'count_shift.numeric' => 'Công là dạng số',
            'count_shift.min' => 'Số công phải >= 0',
            'count_shift.max' => 'Số công phải <= 2',

            'input_time_mor.required' => 'Không được để trống giờ vào buổi sáng',
            'input_time_mor.after' => 'Giờ vào buổi sáng phải từ 00:00 trở lên',
            'input_time_mor.before' => 'Giờ vào buổi sáng phải trước 12:01 và nhỏ hơn giờ ra',

            'output_time_mor.required' => 'Không được để trống giờ ra buổi sáng',
            'output_time_mor.after' => 'Giờ ra buổi sáng phải từ 00:00 trở lên',
            'output_time_mor.before' => 'Giờ ra buổi sáng phải trước 12:01 và lớn hơn giờ vào',

            'input_time_aft.required' => 'Không được để trống giờ vào buổi chiều',
            'input_time_aft.after' => 'Giờ vào buổi chiều phải từ 12:00 trở lên',
            'input_time_aft.before' => 'Giờ vào buổi sáng phải trước 23:59 và nhỏ hơn giờ ra',

            'output_time_aft.required' => 'Không được để trống giờ ra buổi chiều',
            'output_time_aft.after' => 'Giờ ra buổi chiều phải từ 12:00 trở lên',
            'output_time_aft.before' => 'Giờ ra buổi chiều phải trước 23:59 và lớn hơn giờ vào',

            'input_time_shift.required' => 'Không được để trống giờ vào của ca',
            'input_time_shift.before' => 'Giờ vào của ca nhỏ hơn giờ ra',
            'output_time_shift.required' => 'Không được để trống giờ ra của ca',
            'output_time_shift.after' => 'Giờ ra của ca phải lớn hơn giờ vào',

            'option_after_mors.*.time_after.after' => 'Thời gian phải lớn hơn giờ vào ca sáng ',
            'option_after_mors.*.time_after.before' => 'Thời gian phải nhỏ hơn giờ ra ca sáng ',

            'option_before_mors.*.time_before.after' => 'Thời gian phải lớn hơn giờ vào ca sáng ',
            'option_before_mors.*.time_before.before' => 'Thời gian phải nhỏ hơn giờ ra ca sáng ',

            'option_after_afts.*.time_after.after' => 'Thời gian phải lớn hơn giờ vào ca chiều ',
            'option_after_afts.*.time_after.before' => 'Thời gian phải nhỏ hơn giờ ra ca chiều ',

            'option_before_afts.*.time_before.after' => 'Thời gian phải lớn hơn giờ vào ca chiều ',
            'option_before_afts.*.time_before.before' => 'Thời gian phải nhỏ hơn giờ ra ca chiều ',

            'option_after_shifts.*.time_after.after' => 'Thời gian phải lớn hơn giờ bắt đầu ca ',
            'option_after_shifts.*.time_after.before' => 'Thời gian phải nhỏ hơn giờ kết thúc ca ',

            'option_before_shifts.*.time_before.after' => 'Thời gian phải lớn hơn giờ bắt đầu ca',
            'option_before_shifts.*.time_before.before' => 'Thời gian phải nhỏ hơn giờ kết thúc ca',
        ];
    }

    public function updatedOptionAfterMors()
    {
        foreach ($this->option_after_mors as $key => $option) {
            if ($this->input_time_mor == null && $this->output_time_mor == null && $option['time_after'] != null) {
                $this->validate([
                    'input_time_mor' => 'required',
                    'output_time_mor' => 'required',
                ]);
            }
            if ($this->input_time_mor != null && $this->output_time_mor != null && $option['time_after'] != null) {
                $this->validate([
                    'option_after_mors.*.time_after' => 'date_format:"H:i"|after:input_time_mor|before:output_time_mor',
                ]);
            }
        }
    }

    public function updatedOptionBeforeMors()
    {
        foreach ($this->option_before_mors as $key => $option) {
            if ($this->input_time_mor == null && $this->output_time_mor == null && $option['time_before'] != null) {
                $this->validate([
                    'input_time_mor' => 'required',
                    'output_time_mor' => 'required',
                ]);
            }
            if ($this->input_time_mor != null && $this->output_time_mor != null && $option['time_before'] != null) {
                $this->validate([
                    'option_before_mors.*.time_before' => 'date_format:"H:i"|after:input_time_mor|before:output_time_mor',
                ]);
            }
        }
    }

    public function updatedOptionAfterAfts()
    {
        foreach ($this->option_after_afts as $key => $option) {
            if ($this->input_time_aft == null && $this->output_time_aft == null && $option['time_after'] != null) {
                $this->validate([
                    'input_time_aft' => 'required',
                    'output_time_aft' => 'required',
                ]);
            }
            if ($this->input_time_aft != null && $this->output_time_aft != null && $option['time_after'] != null) {
                $this->validate([
                    'option_after_afts.*.time_after' => 'date_format:"H:i"|after:input_time_aftbefore:output_time_aft',
                ]);
            }
        }
    }

    public function updatedOptionBeforeAfts()
    {
        foreach ($this->option_before_afts as $key => $option) {
            if ($this->input_time_aft == null && $this->output_time_aft == null && $option['time_before'] != null) {
                $this->validate([
                    'input_time_aft' => 'required',
                    'output_time_aft' => 'required',
                ]);
            }
            if ($this->input_time_aft != null && $this->output_time_aft != null && $option['time_before'] != null) {
                $this->validate([
                    'option_before_afts.*.time_before' => 'date_format:"H:i"|after:input_time_aft|before:output_time_aft',
                ]);
            }
        }
    }

    public function updatedOptionAfterShifts()
    {
        foreach ($this->option_after_shifts as $key => $option) {
            if ($this->input_time_shift == null && $this->output_time_shift == null && $option['time_after'] != null) {
                $this->validate([
                    'input_time_shift' => 'required',
                    'output_time_shift' => 'required',
                ]);
            }
            if ($this->input_time_shift != null && $this->output_time_shift != null && $option['time_after'] != null) {
                $this->validate([
                    'option_after_shifts.*.time_after' => 'date_format:"H:i"|after:input_time_shift|before:output_time_shift',
                ]);
            }
        }
    }

    public function updatedOptionBeforeShifts()
    {
        foreach ($this->option_before_shifts as $key => $option) {
            if ($this->input_time_shift == null && $this->output_time_shift == null && $option['time_before'] != null) {
                $this->validate([
                    'input_time_shift' => 'required',
                    'output_time_shift' => 'required',
                ]);
            }
            if ($this->input_time_shift != null && $this->output_time_shift != null && $option['time_before'] != null) {
                $this->validate([
                    'option_before_shifts.*.time_before' => 'date_format:"H:i"|after:input_time_shift|before:output_time_shift',
                ]);
            }
        }
    }


    public function updatedOutputTimeMor()
    {

        $c =   strtotime($this->output_time_mor) - strtotime($this->input_time_mor);
        if ($c > 0) {
            $h = floor(($c / 60) / 60);
            $m = floor(($c - ($h * 60 * 60)) / 60);
            if ($h == 0 && $m != 0) {
                $this->sum_time_mor =  $m . " phút";
            } elseif ($m == 0 && $h != 0) {
                $this->sum_time_mor = $h . " giờ";
            } else {
                $this->sum_time_mor = $h . " giờ " . $m . " phút";
            }
        } else {
            $this->sum_time_mor = "0 giờ";
        }
    }
    public function updatedInputTimeMor()
    {

        $c =   strtotime($this->output_time_mor) - strtotime($this->input_time_mor);
        if ($c > 0) {
            $h = floor(($c / 60) / 60);
            $m = floor(($c - ($h * 60 * 60)) / 60);
            if ($h == 0 && $m != 0) {
                $this->sum_time_mor =  $m . " phút";
            } elseif ($m == 0 && $h != 0) {
                $this->sum_time_mor = $h . " giờ";
            } else {
                $this->sum_time_mor = $h . " giờ " . $m . " phút";
            }
        } else {
            $this->sum_time_mor = "0 giờ";
        }
    }

    public function updatedOutputTimeAft()
    {

        $c =   strtotime($this->output_time_aft) - strtotime($this->input_time_aft);
        if ($c > 0) {
            $h = floor(($c / 60) / 60);
            $m = floor(($c - ($h * 60 * 60)) / 60);
            if ($h == 0 && $m != 0) {
                $this->sum_time_aft =  $m . " phút";
            } elseif ($m == 0 && $h != 0) {
                $this->sum_time_aft = $h . " giờ";
            } else {
                $this->sum_time_aft = $h . " giờ " . $m . " phút";
            }
        } else {
            $this->sum_time_aft = "0 giờ";
        }
    }
    public function updatedInputTimeAft()
    {

        $c =   strtotime($this->output_time_aft) - strtotime($this->input_time_aft);
        if ($c > 0) {
            $h = floor(($c / 60) / 60);
            $m = floor(($c - ($h * 60 * 60)) / 60);
            if ($h == 0 && $m != 0) {
                $this->sum_time_mor =  $m . " phút";
            } elseif ($m == 0 && $h != 0) {
                $this->sum_time_aft = $h . " giờ";
            } else {
                $this->sum_time_aft = $h . " giờ " . $m . " phút";
            }
        } else {
            $this->sum_time_aft = "0 giờ";
        }
    }

    public function updatedOutputTimeShift()
    {
        $c =   strtotime($this->output_time_shift) - strtotime($this->input_time_shift);
        if ($c > 0) {
            $h = floor(($c / 60) / 60);
            $m = floor(($c - ($h * 60 * 60)) / 60);
            if ($h == 0 && $m != 0) {
                $this->sum_time_shift =  $m . " phút";
            } elseif ($m == 0 && $h != 0) {
                $this->sum_time_shift = $h . " giờ";
            } else {
                $this->sum_time_shift = $h . " giờ " . $m . " phút";
            }
        } else {
            $this->sum_time_shift = "0 giờ";
        }
    }
    public function updatedInputTimeShift()
    {

        $c =   strtotime($this->output_time_shift) - strtotime($this->input_time_shift);
        if ($c > 0) {
            $h = floor(($c / 60) / 60);
            $m = floor(($c - ($h * 60 * 60)) / 60);
            if ($h == 0 && $m != 0) {
                $this->sum_time_shift =  $m . " phút";
            } elseif ($m == 0 && $h != 0) {
                $this->sum_time_shift = $h . " giờ";
            } else {
                $this->sum_time_shift = $h . " giờ " . $m . " phút";
            }
        } else {
            $this->sum_time_shift = "0 giờ";
        }
    }

    public function mount()
    {
        $this->authorize("time-keep.timekeep-rules.edit");
        $data = TimekeepRule::findOrFail($this->record_id);
        $this->name = $data->name;
        $this->type = $data->type;


        $this->status = $data->status;

        $value = json_decode($data->value);

        if ($this->type == 0) {
            $this->input_time_mor = $value->day_rules->time_morning->input_time_mor;
            $this->output_time_mor = $value->day_rules->time_morning->output_time_mor;
            $this->count_mor = $value->day_rules->time_morning->count_mor;
            $this->option_before_mors = $value->day_rules->time_morning->option->before;
            $this->option_after_mors = $value->day_rules->time_morning->option->after;
            $this->input_time_aft = $value->day_rules->time_afternoon->input_time_aft;
            $this->output_time_aft = $value->day_rules->time_afternoon->output_time_aft;
            $this->count_aft = $value->day_rules->time_afternoon->count_aft;
            $this->option_before_afts = $value->day_rules->time_afternoon->option->before;
            $this->option_after_afts = $value->day_rules->time_afternoon->option->after;

            $option_penance_lates = $value->day_rules->penance->come_late;
            $option_penance_soons = $value->day_rules->penance->back_soon;

            foreach ($option_penance_lates as $k => $values) {
                $option_penance_lates[$k] = [
                    'time_penance_late' => $values->time_penance_late,
                    'monney_penance_late' => number_format(floatval($values->monney_penance_late), 0, ',', '.'),
                ];
            }

            $this->option_penance_lates = $option_penance_lates;

            foreach ($option_penance_soons as $k => $value) {
                $option_penance_soons[$k] = [
                    'time_penance_soon' => $value->time_penance_soon,
                    'monney_penance_soon' => number_format(floatval($value->monney_penance_soon), 0, ',', '.'),
                ];
            }

            $this->option_penance_soons =  $option_penance_soons;

            $a = strtotime($this->output_time_mor) - strtotime($this->input_time_mor);
            if ($a > 0) {
                $h = floor(($a / 60) / 60);
                $m = floor(($a - ($h * 60 * 60)) / 60);
                if ($h == 0 && $m != 0) {
                    $this->sum_time_mor =  $m . " phút";
                } elseif ($m == 0 && $h != 0) {
                    $this->sum_time_mor = $h . " giờ";
                } else {
                    $this->sum_time_mor = $h . " giờ " . $m . " phút";
                }
            } else {
                $this->sum_time_mor = "0 giờ";
            }

            $b = strtotime($this->output_time_aft) - strtotime($this->input_time_aft);
            if ($b > 0) {
                $h = floor(($b / 60) / 60);
                $m = floor(($b - ($h * 60 * 60)) / 60);
                if ($h == 0 && $m != 0) {
                    $this->sum_time_aft =  $m . " phút";
                } elseif ($m == 0 && $h != 0) {
                    $this->sum_time_aft = $h . " giờ";
                } else {
                    $this->sum_time_aft = $h . " giờ " . $m . " phút";
                }
            } else {
                $this->sum_time_aft = "0 giờ";
            }
        } elseif ($this->type == 1) {
            $this->input_time_shift = $value->shift_rules->input_time_shift;
            $this->output_time_shift = $value->shift_rules->output_time_shift;
            $this->count_shift = $value->shift_rules->count_shift;
            $this->option_before_shifts = $value->shift_rules->option->before;
            $this->option_after_shifts = $value->shift_rules->option->after;
            $this->day_apply = $value->shift_rules->day_apply;
            $this->option_penance_lates = $value->shift_rules->penance->come_late;
            $this->option_penance_soons = $value->shift_rules->penance->back_soon;

            $option_penance_lates = $value->shift_rules->penance->come_late;
            $option_penance_soons = $value->shift_rules->penance->back_soon;

            foreach ($option_penance_lates as $k => $values) {
                $option_penance_lates[$k] = [
                    'time_penance_late' => $values->time_penance_late,
                    'monney_penance_late' => number_format(floatval($values->monney_penance_late), 0, ',', '.'),
                ];
            }

            $this->option_penance_lates = $option_penance_lates;

            foreach ($option_penance_soons as $k => $value) {
                $option_penance_soons[$k] = [
                    'time_penance_soon' => $value->time_penance_soon,
                    'monney_penance_soon' => number_format(floatval($value->monney_penance_soon), 0, ',', '.'),
                ];
            }

            $this->option_penance_soons =  $option_penance_soons;

            $c = strtotime($this->output_time_shift) - strtotime($this->input_time_shift);
            if ($c > 0) {
                $h = floor(($c / 60) / 60);
                $m = floor(($c - ($h * 60 * 60)) / 60);
                if ($h == 0 && $m != 0) {
                    $this->sum_time_shift =  $m . " phút";
                } elseif ($m == 0 && $h != 0) {
                    $this->sum_time_shift = $h . " giờ";
                } else {
                    $this->sum_time_shift = $h . " giờ " . $m . " phút";
                }
            } else {
                $this->sum_time_shift = "0 giờ";
            }
        }
    }

    public function updatedOptionPenanceLates()
    {
        foreach ($this->option_penance_lates as $key => $value) {
            $value1 = str_replace('.', '', $value['monney_penance_late']);
            $data12 = number_format(floatval($value1), 0, ',', '.');
            $this->option_penance_lates[$key]["monney_penance_late"] = $data12;
        }
    }

    public function updatedOptionPenanceSoons()
    {
        foreach ($this->option_penance_soons as $key => $value) {
            $value1 = str_replace('.', '', $value['monney_penance_soon']);
            $data12 = number_format(floatval($value1), 0, ',', '.');
            $this->option_penance_soons[$key]["monney_penance_soon"] = $data12;
        }
    }

    //Ca sáng
    public function addOptionDayBeforeMor()
    {
        array_push($this->option_before_mors, ["time_before" => "", "count_before" => ""]);
    }

    public function removeOptionDayBeforeMor($key)
    {
        unset($this->option_before_mors[$key]);
        array_values($this->option_before_mors);
    }

    public function addOptionDayAfterMor()
    {
        array_push($this->option_after_mors, ["time_after" => "", "count_after" => ""]);
    }

    public function removeOptionAfterMor($key)
    {
        unset($this->option_after_mors[$key]);
        array_values($this->option_after_mors);
    }

    //Ca chiều
    public function addOptionDayBeforeAft()
    {
        array_push($this->option_before_afts, ["time_before" => "", "count_before" => ""]);
    }

    public function removeOptionDayBeforeAft($key)
    {
        unset($this->option_before_afts[$key]);
        array_values($this->option_before_afts);
    }

    public function addOptionDayAfterAft()
    {
        array_push($this->option_after_afts, ["time_after" => "", "count_after" => ""]);
    }

    public function removeOptionAfterAft($key)
    {
        unset($this->option_after_afts[$key]);
        array_values($this->option_after_afts);
    }

    //Tiền phạt đi muộn
    public function addOptionPenanceLate()
    {
        array_push($this->option_penance_lates, ["time_penance_late" => "", "monney_penance_late" => ""]);
    }

    public function removeOptionPenanceLate($key)
    {
        unset($this->option_penance_lates[$key]);
        array_values($this->option_penance_lates);
    }

    //Tiền phạt về sớm
    public function addOptionPenanceSoon()
    {
        array_push($this->option_penance_soons, ["time_penance_soon" => "", "monney_penance_soon" => ""]);
    }

    public function removeOptionPenanceSoon($key)
    {
        unset($this->option_penance_soons[$key]);
        array_values($this->option_penance_soons);
    }


    //Chấm công theo ca
    public function addOptionBeforeShift()
    {
        array_push($this->option_before_shifts, ["time_before" => "", "count_before" => ""]);
    }

    public function removeOptionBeforeShift($key)
    {
        unset($this->option_before_shifts[$key]);
        array_values($this->option_before_shifts);
    }

    public function addOptionAfterShift()
    {
        array_push($this->option_after_shifts, ["time_after" => "", "count_after" => ""]);
    }

    public function removeOptionAfterShift($key)
    {
        unset($this->option_after_shifts[$key]);
        array_values($this->option_after_shifts);
    }

    public function updated($field)
    {
        $this->validateOnly($field);
    }

    public function updatedSelected()
    {
        if ($this->selected) {
            $this->day_apply = ["0", "1", "2", "3", "4", "5", "6"];
        } else {
            $this->day_apply = [];
        }
    }

    public function store()
    {
        $this->authorize("time-keep.timekeep-rules.edit");
        $data = TimekeepRule::findOrFail($this->record_id);
        $type = $this->type;
        if ($type == 0) {
            $this->validate([
                'name' => 'required|min:5',
                'input_time_mor' => 'required|date_format:"H:i"|after:"00:00"|before:"output_time_mor"|before:"12:01"',
                'output_time_mor' => 'required|date_format:"H:i"|after:"input_time_mor"|after:"00:00"|before:"12:01"',
                'input_time_aft' => 'required|date_format:"H:i"|after:"12:00"|before:"23:59"|before:"output_time_aft"',
                'output_time_aft' => 'required|date_format:"H:i"|after:"12:00"|before:"23:59"|after:"input_time_aft"',
                'count_mor' => 'required|numeric|min:0|max:2',
                'count_aft' => 'required|numeric|min:0|max:2',
            ]);
        } elseif ($type == 1) {
            $this->validate([
                'name' => 'required|min:5',
                'input_time_shift' => 'required|date_format:"H:i"|before:"output_time_shift"',
                'output_time_shift' => 'required|date_format:"H:i"|after:"input_time_shift"',
                'count_shift' => 'required|numeric|min:0|max:2',

            ]);
        }

        foreach ($this->option_penance_lates as $k => $values) {
            $option_penance_lates[$k] = [
                'time_penance_late' => $values["time_penance_late"],
                'monney_penance_late' => str_replace('.', '', $values['monney_penance_late']),
            ];
        }
        foreach ($this->option_penance_soons as $k => $values) {
            $option_penance_soons[$k] = [
                'time_penance_soon' => $values["time_penance_soon"],
                'monney_penance_soon' => str_replace('.', '', $values['monney_penance_soon']),
            ];
        }



        sort($this->option_after_mors);
        rsort($this->option_before_mors);
        sort($this->option_after_afts);
        rsort($this->option_before_afts);
        sort($this->option_penance_lates);
        sort($this->option_penance_soons);
        sort($this->option_after_shifts);
        rsort($this->option_before_shifts);

        switch ($type) {
            case 0:
                $data->fill([
                    'name' => $this->name,
                    'value' => json_encode([
                        'day_rules' => [
                            'time_morning' => [
                                'input_time_mor' => $this->input_time_mor,
                                'output_time_mor' => $this->output_time_mor,
                                'count_mor' => $this->count_mor,
                                'option' => [
                                    'after' => $this->option_after_mors,
                                    'before' => $this->option_before_mors
                                ],
                            ],
                            'time_afternoon' => [
                                'input_time_aft' => $this->input_time_aft,
                                'output_time_aft' => $this->output_time_aft,
                                'count_aft' => $this->count_aft,
                                'option' => [
                                    'after' => $this->option_after_afts,
                                    'before' => $this->option_before_afts
                                ],
                            ],

                            'penance' => [
                                'come_late' => $option_penance_lates,
                                'back_soon' => $option_penance_soons
                            ]
                        ],
                    ])

                ]);
                break;
            case 1:
                $data->fill([
                    'name' => $this->name,
                    'value' => json_encode([
                        'shift_rules' => [
                            'input_time_shift' => $this->input_time_shift,
                            'output_time_shift' => $this->output_time_shift,
                            'count_shift' => $this->count_shift,
                            'option' => [
                                'after' => $this->option_after_shifts,
                                'before' => $this->option_before_shifts
                            ],
                            'day_apply' => $this->day_apply,
                            'penance' => [
                                'come_late' => $option_penance_lates,
                                'back_soon' => $option_penance_soons
                            ]
                        ],
                    ])

                ]);
                break;
            default:
                break;
        }
        if (!$data->clean) {
            $data->update();
            $this->redirectForm("time-keep.timekeep-rules", $data->id);
        }
    }

    public function render()
    {
        lForm()->setTitle("Luật chấm công");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.timekeep-rules"), "Timekeep Rules");
        lForm()->pushBreadcrumb(route("time-keep.timekeep-rules.edit", $this->record_id), "Edit");

        $day = [
            '0' => 'Chủ Nhật',
            '1' => 'Thứ 2',
            '2' => 'Thứ 3',
            '3' => 'Thứ 4',
            '4' => 'Thứ 5',
            '5' => 'Thứ 6',
            '6' => 'Thứ 7'
        ];

        return view("time-keep::livewire.timekeep-rules.edit", compact('day'))
            ->layout('time-keep::layouts.master', ['title' => 'Timekeep Rules Edit']);
    }
}
