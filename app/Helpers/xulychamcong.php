<?php

use Carbon\Carbon;

//Hàm lấy số ngày, các thứ trong tuần, ngày lễ trong tháng 
function dayMonth($years_date, $month_date, $holidays)
{
    $days = [];
    $newTime = $years_date . '-' . $month_date . '-1';
    $newYear =  new Carbon(date_create($newTime));
    $day1 = $newYear->daysInMonth;
    $month = $newYear->month;
    $year = $newYear->year;

    $week = array("CN", "T2", "T3", "T4", "T5", "T6", "T7");

    $day_half = holidays($holidays, $year, $month, $day1);

    for ($i = 1; $i <= $day1; $i++) {
        $time = $i . "-" . $month . "-" . $year . '00:00:00';
        $datetime = new DateTime($time);
        $w = (int)$datetime->format('w');

        $days[$i]['day_text'] = $week[$w];

        $days[$i]['day'] = $i;

        if (!empty($day_half[$i]['day'])) {
            $days[$i]['holiday']  = $i;
        }
    }
    return $days;
}

//Hàm tính số công cho một id NV
function timeKeeps($years_date, $month_date, $user_id, $holidays, $timekeeps, $singles, $timekeepRules, $users)
{
    $newTime = $years_date . '-' . $month_date . '-1';
    $newYear =  new Carbon(date_create($newTime));
    $day1 = $newYear->daysInMonth;
    $month = $newYear->month;
    $year = $newYear->year;

    $week = array("CN", "T2", "T3", "T4", "T5", "T6", "T7");

    foreach ($users as $b) {
        if ($b->id == $user_id) {
            $user = $b;
        }
    }
    $staffs = [];
    $timekeep = [];
    $tong = 0;
    $tongphat = 0;
    $sum_late = 0;
    $sum_soon = 0;
    $timekeepRule = [];
    $staffs['user_id'] = $user->id;
    $staffs['name'] = $user->name;

    //Lấy ra ngày nghỉ lễ trong tháng
    $day_half = holidays($holidays, $year, $month, $day1);

    //check luật chấm công cho từng id NV
    if (empty($user->timekeep_rule)) {
        foreach ($timekeepRules as $rule) {
            if ($rule->active == 1) {
                $timekeepRule[] = $rule;
            }
        }
    } else {
        foreach ($timekeepRules as $rule) {
            if ($user->timekeep_rule == $rule->id) {
                $timekeepRule[] = $rule;
            }
        }
    }

    if (count($timekeepRule) < 1) { //check luật có rỗng hay không
        $messages = 'Chưa có luật chấm công mặc định.';
        for ($i = 1; $i <= $day1; $i++) {
            $time = $i . "-" . $month . "-" . $year . '00:00:00';
            $datetime = new DateTime($time);
            $w = (int)$datetime->format('w');

            $timekeep[$i]['day_text']  = $week[$w];
            $timekeep[$i]['day']  =  $i . "-" . $month . "-" . $year;

            if (!empty($day_half[$i]['day'])) {
                $timekeep[$i]['holiday']  = $i;
            }

            foreach ($timekeeps as $key => $time) {
                if ($user_id == $time->user_id) {
                    if ($i == date_format($time->created_at, 'd')) {
                        $timekeep[$i]['cong'] = 0;
                        $tong += 0;
                        $timekeep[$i]['sum_money_late'] =  0;
                        $timekeep[$i]['sum_money_soon'] =  0;
                        $sum_late += 0;
                        $sum_soon += 0;
                        $tongphat += 0;
                        $timekeep[$i]['single'] = '';
                        $timekeep[$i]['created_at'] = date_format($time->created_at, 'H:i:s');
                        $timekeep[$i]['updated_at'] = date_format($time->updated_at, 'H:i:s');
                    }
                }
            }
        }
        for ($i = 1; $i <= $day1; $i++) {
            if (!isset($timekeep[$i]['cong'])) {
                $timekeep[$i]['cong'] = 0;
                $timekeep[$i]['sum_money_late'] = 0;
                $timekeep[$i]['sum_money_soon'] = 0;
                $timekeep[$i]['single'] = '';
                $timekeep[$i]['created_at'] = '';
                $timekeep[$i]['updated_at'] = '';
            }
        }

        $timekeep = collect($timekeep)->sortKeys();
        $staffs['timekeep'] = $timekeep;
        $staffs['tong'] = $tong;
        $staffs['tongphat'] = number_format(floatval($tongphat), 0, ',', '.');
        $staffs['sum_late'] = number_format(floatval($sum_late), 0, ',', '.');
        $staffs['sum_soon'] = number_format(floatval($sum_soon), 0, ',', '.');
        $staffs['mes'] = $messages;
        $timekeep = [];
        $tong = 0;
    } else {
        $messages = '';
        $type = $timekeepRule[0]->type;
        $day123 = [];
        $array123 = [];
        $day_working = [];
        $ceases = [];
        $latesoons = [];
        $single_holidays = [];

        foreach ($singles as $a1) {
            if ($a1->user_id == $user_id) {
                if ($a1->type == 1) {
                    $ceases[] = $a1;
                } elseif ($a1->type == 2) {
                    $latesoons[] = $a1;
                } else {
                    $single_holidays[] = $a1;
                }
            }
        }

        //check đơn xin nghỉ trong tháng
        $day123 = ceases($ceases, $year, $month, $day1);

        //check đơn xin đi muộn về sớm
        $array123 = latesoons($latesoons, $year, $month);

        //check đơn đăng ký làm ngày lễ
        $day_working = single_holidays($single_holidays, $year, $month, $day1);

        switch ($type) {
            case 0: //chấm công theo ngày
                $value = json_decode($timekeepRule[0]->value);
                $count_mor = $value->day_rules->time_morning->count_mor;
                $count_aft = $value->day_rules->time_afternoon->count_aft;
                for ($i = 1; $i <= $day1; $i++) {
                    $time = $i . "-" . $month . "-" . $year . '00:00:00';
                    $datetime = new DateTime($time);
                    $w = (int)$datetime->format('w');

                    $timekeep[$i]['day_text']  = $week[$w];
                    $timekeep[$i]['day']  =  $i . "-" . $month . "-" . $year;

                    //lấy ngày lễ trong tháng
                    if (!empty($day_half[$i]['day'])) {
                        $timekeep[$i]['holiday']  = $i;
                    }

                    foreach ($timekeeps as $key => $time) {
                        if ($user_id == $time->user_id) {
                            if ($i == date_format($time->created_at, 'd')) { //check công trong ngày của một NV 
                                if (!empty($day_half[$i]['day'])) { //kiểm tra có phải ngày lễ không(khi NV có chấm công)
                                    if (!empty($array123[$i])) { //kiểm tra đơn đi muộn, về sớm
                                        $input = strtotime(date_format($time->created_at, 'H:i:s'));
                                        $output = strtotime(date_format($time->updated_at, 'H:i:s'));
                                        foreach ($singles as $a1) {
                                            if ($a1->id == $array123[$i]['apply']) {
                                                $single[] = $a1;
                                            }
                                        }
                                        $handle = hendleTimekeepSingle($input, $output, $timekeepRule, $single);
                                        if (!empty($day_working[$i]['day'])) { //kiểm tra đơn đk làm ngày lễ nếu không có đơn thì công sẽ tính theo công nghỉ ngày lễ
                                            $timekeep[$i]['cong'] = $handle['count'] * $day_working[$i]['salary_working'] / 100;
                                            $tong += $handle['count'] * $day_working[$i]['salary_working'] / 100;
                                            $timekeep[$i]['single'] = 'Đăng ký đi làm ngày lễ';
                                            $timekeep[$i]['single_id'] = $day_working[$i]['single_id'];
                                            $timekeep[$i]['sum_money_late'] =  number_format(floatval($handle['sum_money_late']), 0, ',', '.');
                                            $timekeep[$i]['sum_money_soon'] =  number_format(floatval($handle['sum_money_soon']), 0, ',', '.');
                                            $sum_late += $handle['sum_money_late'];
                                            $sum_soon += $handle['sum_money_soon'];
                                            $tongphat += ($handle['sum_money_late'] + $handle['sum_money_soon']);
                                            $timekeep[$i]['created_at'] = date_format($time->created_at, 'H:i:s');
                                            $timekeep[$i]['updated_at'] = date_format($time->updated_at, 'H:i:s');
                                        } else {
                                            $timekeep[$i]['cong'] = (($count_mor + $count_aft) * $day_half[$i]['salary_half']) / 100;
                                            $tong += (($count_mor + $count_aft) * $day_half[$i]['salary_half']) / 100;
                                            $timekeep[$i]['single'] = '';
                                            $timekeep[$i]['single_id'] = '';
                                            $timekeep[$i]['sum_money_late'] =  0;
                                            $timekeep[$i]['sum_money_soon'] =  0;
                                            $timekeep[$i]['created_at'] = date_format($time->created_at, 'H:i:s');
                                            $timekeep[$i]['updated_at'] = date_format($time->updated_at, 'H:i:s');
                                        }
                                        break;
                                    } else {
                                        $input = strtotime(date_format($time->created_at, 'H:i:s'));
                                        $output = strtotime(date_format($time->updated_at, 'H:i:s'));
                                        $handle = hendleTimekeep($input, $output, $timekeepRule);
                                        if (!empty($day_working[$i]['day'])) { //kiểm tra đơn đk làm ngày lễ nếu không có đơn thì công sẽ tính theo công nghỉ ngày lễ
                                            $timekeep[$i]['cong'] = $handle['count'] * $day_working[$i]['salary_working'] / 100;
                                            $tong += $handle['count'] * $day_working[$i]['salary_working'] / 100;
                                            $timekeep[$i]['single'] = 'Đăng ký đi làm ngày lễ';
                                            $timekeep[$i]['single_id'] = $day_working[$i]['single_id'];
                                            $timekeep[$i]['sum_money_late'] =  number_format(floatval($handle['sum_money_late']), 0, ',', '.');
                                            $timekeep[$i]['sum_money_soon'] =  number_format(floatval($handle['sum_money_soon']), 0, ',', '.');
                                            $sum_late += $handle['sum_money_late'];
                                            $sum_soon += $handle['sum_money_soon'];
                                            $tongphat += ($handle['sum_money_late'] + $handle['sum_money_soon']);
                                            $timekeep[$i]['created_at'] = date_format($time->created_at, 'H:i:s');
                                            $timekeep[$i]['updated_at'] = date_format($time->updated_at, 'H:i:s');
                                        } else {
                                            $timekeep[$i]['cong'] = (($count_mor + $count_aft) * $day_half[$i]['salary_half']) / 100;
                                            $tong += (($count_mor + $count_aft) * $day_half[$i]['salary_half']) / 100;
                                            $timekeep[$i]['single'] = '';
                                            $timekeep[$i]['single_id'] = '';
                                            $timekeep[$i]['sum_money_late'] =  0;
                                            $timekeep[$i]['sum_money_soon'] =  0;
                                            $timekeep[$i]['created_at'] = date_format($time->created_at, 'H:i:s');
                                            $timekeep[$i]['updated_at'] = date_format($time->updated_at, 'H:i:s');
                                        }
                                        break;
                                    }
                                }

                                if (!empty($day123[$i])) { //kiểm tra có đơn xin nghỉ mà NV vẫn chấm công thì sẽ tính theo đơn

                                    $timekeep[$i]['cong'] = (($count_mor + $count_aft) * $day123[$i]['count']) / 100;
                                    $tong += (($count_mor + $count_aft) * $day123[$i]['count']) / 100;
                                    $timekeep[$i]['sum_money_late'] = 0;
                                    $timekeep[$i]['sum_money_soon'] = 0;
                                    $timekeep[$i]['created_at'] = date_format($time->created_at, 'H:i:s');
                                    $timekeep[$i]['updated_at'] = date_format($time->updated_at, 'H:i:s');
                                    $timekeep[$i]['single'] = 'Đơn xin nghỉ';
                                    $timekeep[$i]['single_id'] = $day123[$i]['single_id'];
                                    break;
                                } else {
                                    if (!empty($array123[$i])) { //kiểm tra đơn xin đi muộn, về sớm
                                        $input = strtotime(date_format($time->created_at, 'H:i:s'));
                                        $output = strtotime(date_format($time->updated_at, 'H:i:s'));
                                        foreach ($singles as $a1) {
                                            if ($a1->id == $array123[$i]['apply']) {
                                                $single[] = $a1;
                                            }
                                        }
                                        $handle = hendleTimekeepSingle($input, $output, $timekeepRule, $single);
                                        $timekeep[$i]['cong'] = $handle['count'];
                                        $tong += $handle['count'];
                                        $timekeep[$i]['sum_money_late'] =  number_format(floatval($handle['sum_money_late']), 0, ',', '.');
                                        $timekeep[$i]['sum_money_soon'] =  number_format(floatval($handle['sum_money_soon']), 0, ',', '.');
                                        $sum_late += $handle['sum_money_late'];
                                        $sum_soon += $handle['sum_money_soon'];
                                        $tongphat += ($handle['sum_money_late'] + $handle['sum_money_soon']);
                                        $timekeep[$i]['created_at'] = date_format($time->created_at, 'H:i:s');
                                        $timekeep[$i]['updated_at'] = date_format($time->updated_at, 'H:i:s');
                                        $timekeep[$i]['single'] = 'Đơn xin đi muộn, về sớm';
                                        $timekeep[$i]['single_id'] = $array123[$i]['apply'];
                                        break;
                                    } else {

                                        $input = strtotime(date_format($time->created_at, 'H:i:s'));
                                        $output = strtotime(date_format($time->updated_at, 'H:i:s'));
                                        $handle = hendleTimekeep($input, $output, $timekeepRule);
                                        $timekeep[$i]['cong'] = $handle['count'];
                                        $tong += $handle['count'];
                                        $timekeep[$i]['sum_money_late'] =  number_format(floatval($handle['sum_money_late']), 0, ',', '.');
                                        $timekeep[$i]['sum_money_soon'] =  number_format(floatval($handle['sum_money_soon']), 0, ',', '.');
                                        $sum_late += $handle['sum_money_late'];
                                        $sum_soon += $handle['sum_money_soon'];
                                        $tongphat += ($handle['sum_money_late'] + $handle['sum_money_soon']);
                                        $timekeep[$i]['created_at'] = date_format($time->created_at, 'H:i:s');
                                        $timekeep[$i]['updated_at'] = date_format($time->updated_at, 'H:i:s');
                                        $timekeep[$i]['single'] = '';
                                        $timekeep[$i]['single_id'] = '';
                                        break;
                                    }
                                }
                            }
                        }
                    }
                }
                for ($i = 1; $i <= $day1; $i++) { //kiểm tra có phải ngày lễ không(khi NV không chấm công)
                    if (!isset($timekeep[$i]['cong'])) {
                        foreach ($day_half as $k => $half) {
                            if ($half['day'] == $i) {
                                $timekeep[$i]['cong'] = (($count_mor + $count_aft) * $half['salary_half']) / 100;
                                $tong += (($count_mor + $count_aft) * $half['salary_half']) / 100;
                                $timekeep[$i]['sum_money_late'] = 0;
                                $timekeep[$i]['sum_money_soon'] = 0;
                                $timekeep[$i]['created_at'] = '';
                                $timekeep[$i]['updated_at'] = '';
                                $timekeep[$i]['single'] = '';
                                $timekeep[$i]['single_id'] = '';
                            }
                        }
                    }
                }
                for ($i = 1; $i <= $day1; $i++) { //kiểm tra có đơn xin nghỉ không
                    if (!isset($timekeep[$i]['cong'])) {
                        foreach ($day123 as $k => $item) {
                            if ($item['day'] == $i) {
                                $timekeep[$i]['cong'] = (($count_mor + $count_aft) * $item['count']) / 100;
                                $tong += (($count_mor + $count_aft) * $item['count']) / 100;
                                $timekeep[$i]['sum_money_late'] = 0;
                                $timekeep[$i]['sum_money_soon'] = 0;
                                $timekeep[$i]['created_at'] = '';
                                $timekeep[$i]['updated_at'] = '';
                                $timekeep[$i]['single'] = 'Đơn xin nghỉ';
                                $timekeep[$i]['single_id'] = $item['single_id'];
                            }
                        }
                    }
                }
                for ($i = 1; $i <= $day1; $i++) {
                    if (!isset($timekeep[$i]['cong'])) {
                        $timekeep[$i]['cong'] = 0;
                        $timekeep[$i]['sum_money_late'] = 0;
                        $timekeep[$i]['sum_money_soon'] = 0;
                        $timekeep[$i]['created_at'] = '';
                        $timekeep[$i]['updated_at'] = '';
                        $timekeep[$i]['single'] = '';
                        $timekeep[$i]['single_id'] = '';
                    }
                }

                $timekeep = collect($timekeep)->sortKeys();
                $staffs['timekeep'] = $timekeep;
                $staffs['tong'] = $tong;
                $staffs['tongphat'] = number_format(floatval($tongphat), 0, ',', '.');
                $staffs['sum_late'] = number_format(floatval($sum_late), 0, ',', '.');
                $staffs['sum_soon'] = number_format(floatval($sum_soon), 0, ',', '.');
                $staffs['mes'] = $messages;
                $timekeep = [];
                $tong = 0;

                break;
            case 1: //chấm công theo ca
                $value = json_decode($timekeepRule[0]->value);
                $count_shift = $value->shift_rules->count_shift;
                $day_apply = $value->shift_rules->day_apply;

                for ($i = 1; $i <= $day1; $i++) {
                    $time = $i . "-" . $month . "-" . $year . '00:00:00';
                    $datetime = new DateTime($time);

                    $w = (int)$datetime->format('w');
                    $timekeep[$i]['day_text']  = $week[$w];
                    $timekeep[$i]['day']  =  $i . "-" . $month . "-" . $year;

                    if (!empty($day_half[$i]['day'])) {
                        $timekeep[$i]['holiday']  = $i;
                    }

                    foreach ($timekeeps as $key => $time) {
                        if ($user_id == $time->user_id) {
                            if ($i == date_format($time->created_at, 'd')) {
                                for ($x = 0; $x < count($day_apply); $x++) {
                                    if ($day_apply[$x] == $w) { //kiểm tra ngày áp dụng
                                        if (!empty($day_half[$i]['day'])) {
                                            if (!empty($array123[$i])) {
                                                $input = strtotime(date_format($time->created_at, 'H:i:s'));
                                                $output = strtotime(date_format($time->updated_at, 'H:i:s'));
                                                foreach ($singles as $a1) {
                                                    if ($a1->id == $array123[$i]['apply']) {
                                                        $single[] = $a1;
                                                    }
                                                }
                                                $handle = hendleTimekeepSingle($input, $output, $timekeepRule, $single);

                                                if (!empty($day_working[$i]['day'])) {
                                                    $timekeep[$i]['cong'] = $handle['count'] * $day_working[$i]['salary_working'] / 100;
                                                    $tong += $handle['count'] * $day_working[$i]['salary_working'] / 100;
                                                    $timekeep[$i]['single'] = 'Đăng ký đi làm ngày lễ';
                                                    $timekeep[$i]['single_id'] = $day_working[$i]['single_id'];
                                                    $timekeep[$i]['sum_money_late'] =  number_format(floatval($handle['sum_money_late']), 0, ',', '.');
                                                    $timekeep[$i]['sum_money_soon'] =  number_format(floatval($handle['sum_money_soon']), 0, ',', '.');
                                                    $sum_late += $handle['sum_money_late'];
                                                    $sum_soon += $handle['sum_money_soon'];
                                                    $tongphat += ($handle['sum_money_late'] + $handle['sum_money_soon']);
                                                    $timekeep[$i]['created_at'] = date_format($time->created_at, 'H:i:s');
                                                    $timekeep[$i]['updated_at'] = date_format($time->updated_at, 'H:i:s');
                                                } else {
                                                    $timekeep[$i]['cong'] = ($count_shift * $day_half[$i]['salary_half']) / 100;
                                                    $tong += ($count_shift * $day_half[$i]['salary_half']) / 100;
                                                    $timekeep[$i]['single'] = '';
                                                    $timekeep[$i]['single_id'] = '';
                                                    $timekeep[$i]['sum_money_late'] =  0;
                                                    $timekeep[$i]['sum_money_soon'] =  0;
                                                    $timekeep[$i]['created_at'] = date_format($time->created_at, 'H:i:s');
                                                    $timekeep[$i]['updated_at'] = date_format($time->updated_at, 'H:i:s');
                                                }
                                                break;
                                            } else {
                                                $input = strtotime(date_format($time->created_at, 'H:i:s'));
                                                $output = strtotime(date_format($time->updated_at, 'H:i:s'));
                                                $handle = hendleTimekeep($input, $output, $timekeepRule);
                                                if (!empty($day_working[$i]['day'])) {
                                                    $timekeep[$i]['cong'] = $handle['count'] * $day_working[$i]['salary_working'] / 100;
                                                    $tong += $handle['count'] * $day_working[$i]['salary_working'] / 100;
                                                    $timekeep[$i]['single'] = 'Đăng ký đi làm ngày lễ';
                                                    $timekeep[$i]['single_id'] = $day_working[$i]['single_id'];
                                                    $timekeep[$i]['sum_money_late'] =  number_format(floatval($handle['sum_money_late']), 0, ',', '.');
                                                    $timekeep[$i]['sum_money_soon'] =  number_format(floatval($handle['sum_money_soon']), 0, ',', '.');
                                                    $sum_late += $handle['sum_money_late'];
                                                    $sum_soon += $handle['sum_money_soon'];
                                                    $tongphat += ($handle['sum_money_late'] + $handle['sum_money_soon']);
                                                    $timekeep[$i]['created_at'] = date_format($time->created_at, 'H:i:s');
                                                    $timekeep[$i]['updated_at'] = date_format($time->updated_at, 'H:i:s');
                                                } else {
                                                    $timekeep[$i]['cong'] = ($count_shift * $day_half[$i]['salary_half']) / 100;
                                                    $tong += ($count_shift * $day_half[$i]['salary_half']) / 100;
                                                    $timekeep[$i]['single'] = '';
                                                    $timekeep[$i]['single_id'] = '';
                                                    $timekeep[$i]['sum_money_late'] =  0;
                                                    $timekeep[$i]['sum_money_soon'] =  0;
                                                    $timekeep[$i]['created_at'] = date_format($time->created_at, 'H:i:s');
                                                    $timekeep[$i]['updated_at'] = date_format($time->updated_at, 'H:i:s');
                                                }
                                                break;
                                            }
                                        }
                                        if (!empty($day123[$i])) {
                                            $timekeep[$i]['cong'] = ($count_shift *  $day123[$i]['count']) / 100;
                                            $tong += ($count_shift *  $day123[$i]['count']) / 100;
                                            $timekeep[$i]['sum_money_late'] = 0;
                                            $timekeep[$i]['sum_money_soon'] = 0;
                                            $timekeep[$i]['created_at'] = date_format($time->created_at, 'H:i:s');
                                            $timekeep[$i]['updated_at'] = date_format($time->updated_at, 'H:i:s');
                                            $timekeep[$i]['single'] = 'Đơn xin nghỉ';
                                            $timekeep[$i]['single_id'] = $day123[$i]['single_id'];
                                            break;
                                        } else {

                                            if (!empty($array123[$i])) {
                                                $input = strtotime(date_format($time->created_at, 'H:i:s'));
                                                $output = strtotime(date_format($time->updated_at, 'H:i:s'));
                                                foreach ($singles as $a1) {
                                                    if ($a1->id == $array123[$i]['apply']) {
                                                        $single[] = $a1;
                                                    }
                                                }
                                                $handle = hendleTimekeepSingle($input, $output, $timekeepRule, $single);

                                                $timekeep[$i]['cong'] = $handle['count'];
                                                $tong += $handle['count'];
                                                $timekeep[$i]['sum_money_late'] =  number_format(floatval($handle['sum_money_late']), 0, ',', '.');
                                                $timekeep[$i]['sum_money_soon'] =  number_format(floatval($handle['sum_money_soon']), 0, ',', '.');
                                                $sum_late += $handle['sum_money_late'];
                                                $sum_soon += $handle['sum_money_soon'];
                                                $tongphat += ($handle['sum_money_late'] + $handle['sum_money_soon']);
                                                $timekeep[$i]['created_at'] = date_format($time->created_at, 'H:i:s');
                                                $timekeep[$i]['updated_at'] = date_format($time->updated_at, 'H:i:s');
                                                $timekeep[$i]['single'] = 'Đơn xin đi muộn, về sớm';
                                                $timekeep[$i]['single_id'] = $array123[$i]['apply'];
                                                break;
                                            } else {
                                                $input = strtotime(date_format($time->created_at, 'H:i:s'));
                                                $output = strtotime(date_format($time->updated_at, 'H:i:s'));
                                                $handle = hendleTimekeep($input, $output, $timekeepRule);
                                                $timekeep[$i]['cong'] = $handle['count'];
                                                $tong += $handle['count'];
                                                $timekeep[$i]['sum_money_late'] =  number_format(floatval($handle['sum_money_late']), 0, ',', '.');
                                                $timekeep[$i]['sum_money_soon'] =  number_format(floatval($handle['sum_money_soon']), 0, ',', '.');
                                                $sum_late += $handle['sum_money_late'];
                                                $sum_soon += $handle['sum_money_soon'];
                                                $tongphat += ($handle['sum_money_late'] + $handle['sum_money_soon']);
                                                $timekeep[$i]['created_at'] = date_format($time->created_at, 'H:i:s');
                                                $timekeep[$i]['updated_at'] = date_format($time->updated_at, 'H:i:s');
                                                $timekeep[$i]['single'] = '';
                                                $timekeep[$i]['single_id'] = '';
                                                break;
                                            }
                                        }
                                    } else {
                                        $timekeep[$i]['cong'] = 0;
                                        $timekeep[$i]['sum_money_late'] = 0;
                                        $timekeep[$i]['sum_money_soon'] = 0;
                                        $timekeep[$i]['created_at'] = date_format($time->created_at, 'H:i:s');
                                        $timekeep[$i]['updated_at'] = date_format($time->updated_at, 'H:i:s');
                                        $timekeep[$i]['single'] = '';
                                        $timekeep[$i]['single_id'] = '';
                                    }
                                }
                            }
                        }
                    }
                }
                for ($i = 1; $i <= $day1; $i++) {
                    if (!isset($timekeep[$i]['cong'])) {
                        foreach ($day_half as $k => $half) {
                            if ($half['day'] == $i) {
                                $timekeep[$i]['cong'] = ($count_shift * $half['salary_half']) / 100;
                                $tong += ($count_shift * $half['salary_half']) / 100;
                                $timekeep[$i]['sum_money_late'] = 0;
                                $timekeep[$i]['sum_money_soon'] = 0;
                                $timekeep[$i]['created_at'] = '';
                                $timekeep[$i]['updated_at'] = '';
                                $timekeep[$i]['single'] = '';
                                $timekeep[$i]['single_id'] = '';
                            }
                        }
                    }
                }
                for ($i = 1; $i <= $day1; $i++) {
                    $time = $i . "-" . $month . "-" . $year . '00:00:00';
                    $datetime = new DateTime($time);
                    $w = (int)$datetime->format('w');
                    if (!isset($timekeep[$i]['cong'])) {
                        for ($x = 0; $x < count($day_apply); $x++) {
                            if ($day_apply[$x] == $w) {
                                foreach ($day123 as $k => $item) {
                                    if ($item['day'] == $i) {
                                        $timekeep[$i]['cong'] = ($count_shift *  $item['count']) / 100;
                                        $tong += ($count_shift *  $item['count']) / 100;
                                        $timekeep[$i]['sum_money_late'] = 0;
                                        $timekeep[$i]['sum_money_soon'] = 0;
                                        $timekeep[$i]['created_at'] = '';
                                        $timekeep[$i]['updated_at'] = '';
                                        $timekeep[$i]['single'] = 'Đơn xin nghỉ';
                                        $timekeep[$i]['single_id'] = $item['single_id'];
                                    }
                                }
                            }
                        }
                    }
                }

                for ($i = 1; $i <= $day1; $i++) {
                    if (!isset($timekeep[$i]['cong'])) {
                        $timekeep[$i]['cong'] = 0;
                        $timekeep[$i]['sum_money_late'] = 0;
                        $timekeep[$i]['sum_money_soon'] = 0;
                        $timekeep[$i]['created_at'] = '';
                        $timekeep[$i]['updated_at'] = '';
                        $timekeep[$i]['single'] = '';
                        $timekeep[$i]['single_id'] = '';
                    }
                }

                $timekeep = collect($timekeep)->sortKeys();
                $staffs['timekeep'] = $timekeep;
                $staffs['tong'] = $tong;
                $staffs['tongphat'] = number_format(floatval($tongphat), 0, ',', '.');
                $staffs['sum_late'] = number_format(floatval($sum_late), 0, ',', '.');
                $staffs['sum_soon'] = number_format(floatval($sum_soon), 0, ',', '.');
                $staffs['mes'] = $messages;
                $timekeep = [];
                $tong = 0;
                break;
            default:
                break;
        }
    }
    return $staffs;
}

//hàm check đơn xin đi muộn về sớm
function latesoons($latesoons, $year, $month)
{
    $array123 = [];
    foreach ($latesoons as $latesoon) {
        $value2 = json_decode($latesoon->value);
        $month_late_soon = intval(date_format(date_create($value2->day_apply), 'm'));
        $date3 = intval(date_format(date_create($value2->day_apply), 'd'));
        $year_late_soon = intval(date_format(date_create($value2->day_apply), 'Y'));

        if (count($array123) < 2) {
            if ($year_late_soon == $year) {
                if ($month_late_soon == $month) {
                    if (empty($array123[$date3]['day'])) {
                        $array123[$date3]['day'] = $date3;
                        $array123[$date3]['apply'] = $latesoon->id;
                    }
                }
            }
        }
    }
    return $array123;
}

//hàm check đơn đăng ký đi làm ngày lễ
function single_holidays($single_holidays, $year, $month, $day1)
{
    $day_working = [];
    foreach ($single_holidays as $item1) {
        $value2 = json_decode($item1->value);
        $from_day1 = intval(date_format(date_create($value2->from_day), 'd'));
        $to_day1 = intval(date_format(date_create($value2->to_day), 'd'));
        $month3 =  intval(date_format(date_create($value2->from_day), 'm'));
        $month4 =  intval(date_format(date_create($value2->to_day), 'm'));
        $year_holiday1 = intval(date_format(date_create($value2->from_day), 'Y'));
        $year_holiday2 = intval(date_format(date_create($value2->to_day), 'Y'));

        if ($year_holiday1 == $year && $year_holiday2 == $year) {
            switch ($month) {
                case $month3 < $month && $month4 == $month:
                    for ($i = 1; $i <= $to_day1; $i++) {
                        if (empty($day_working[$i]['day'])) {
                            $day_working[$i]['day'] = $i;
                            $day_working[$i]['salary_working'] = $value2->salary_working;
                            $day_working[$i]['single_id'] = $item1->id;
                        }
                    }
                    break;
                case $month3 == $month && $month4 > $month:
                    for ($i = $from_day1; $i <= $day1; $i++) {
                        if (empty($day_half[$i]['day'])) {
                            $day_working[$i]['day'] = $i;
                            $day_working[$i]['salary_working'] = $value2->salary_working;
                            $day_working[$i]['single_id'] = $item1->id;
                        }
                    }
                    break;
                case $month3 == $month && $month4 == $month:
                    for ($i = $from_day1; $i <= $to_day1; $i++) {
                        if (empty($day_working[$i]['day'])) {
                            $day_working[$i]['day'] = $i;
                            $day_working[$i]['salary_working'] = $value2->salary_working;
                            $day_working[$i]['single_id'] = $item1->id;
                        }
                    }
                    break;
                case $month3 < $month && $month4 > $month:
                    for ($i = 1; $i <= $day1; $i++) {
                        if (empty($day_working[$i]['day'])) {
                            $day_working[$i]['day'] = $i;
                            $day_working[$i]['salary_working'] = $value2->salary_working;
                            $day_working[$i]['single_id'] = $item1->id;
                        }
                    }
                    break;
                default:
                    break;
            }
        }
    }
    return $day_working;
}

//hàm check đơn xin nghỉ
function ceases($ceases, $year, $month, $day1)
{
    $day123 = [];
    foreach ($ceases as $cease) {
        $value1 = json_decode($cease->value);
        $month_cease1 =  intval(date_format(date_create($value1->from), 'm'));
        $month_cease2 =  intval(date_format(date_create($value1->to), 'm'));
        $date1 = intval(date_format(date_create($value1->from), 'd'));
        $date2 = intval(date_format(date_create($value1->to), 'd'));
        $year1 = intval(date_format(date_create($value1->from), 'Y'));
        $year2 = intval(date_format(date_create($value1->to), 'Y'));

        if ($year1 == $year && $year2 == $year) {
            switch ($month) {
                case $month_cease1 < $month && $month_cease2 == $month:
                    for ($i = 1; $i <= $date2; $i++) {
                        if (empty($day123[$i]['day'])) {
                            $day123[$i]['day'] = $i;
                            $day123[$i]['count'] = $value1->count;
                            $day123[$i]['single_id'] = $cease->id;
                        }
                    }
                    break;
                case $month_cease1 == $month && $month_cease2 > $month:
                    for ($i = $date1; $i <= $day1; $i++) {
                        if (empty($day123[$i]['day'])) {
                            $day123[$i]['day'] = $i;
                            $day123[$i]['count'] = $value1->count;
                            $day123[$i]['single_id'] = $cease->id;
                        }
                    }
                    break;
                case $month_cease1 == $month && $month_cease2 == $month:
                    for ($i = $date1; $i <= $date2; $i++) {
                        if (empty($day123[$i]['day'])) {
                            $day123[$i]['day'] = $i;
                            $day123[$i]['count'] = $value1->count;
                            $day123[$i]['single_id'] = $cease->id;
                        }
                    }
                    break;
                case $month_cease1 < $month && $month_cease2 > $month:
                    for ($i = 1; $i <= $day1; $i++) {
                        if (empty($day123[$i]['day'])) {
                            $day123[$i]['day'] = $i;
                            $day123[$i]['count'] = $value1->count;
                            $day123[$i]['single_id'] = $cease->id;
                        }
                    }
                    break;
                default:
                    break;
            }
        } elseif ($year1 == $year && $year2 > $year) {
            if ($month_cease1 < $month) {
                for ($i = 1; $i <= $day1; $i++) {
                    if (empty($day123[$i]['day'])) {
                        $day123[$i]['day'] = $i;
                        $day123[$i]['count'] = $value1->count;
                        $day123[$i]['single_id'] = $cease->id;
                    }
                }
            } elseif ($month_cease1 == $month) {
                for ($i = $date1; $i <= $day1; $i++) {
                    if (empty($day123[$i]['day'])) {
                        $day123[$i]['day'] = $i;
                        $day123[$i]['count'] = $value1->count;
                        $day123[$i]['single_id'] = $cease->id;
                    }
                }
            }
        } elseif ($year1 < $year && $year2 == $year) {
            if ($month_cease2 > $month) {
                for ($i = 1; $i <= $day1; $i++) {
                    if (empty($day123[$i]['day'])) {
                        $day123[$i]['day'] = $i;
                        $day123[$i]['count'] = $value1->count;
                        $day123[$i]['single_id'] = $cease->id;
                    }
                }
            } elseif ($month_cease2 == $month) {
                for ($i = 1; $i <= $date2; $i++) {
                    if (empty($day123[$i]['day'])) {
                        $day123[$i]['day'] = $i;
                        $day123[$i]['count'] = $value1->count;
                        $day123[$i]['single_id'] = $cease->id;
                    }
                }
            }
        }
    }
    return $day123;
}

//hàm lấy ngày lễ trong tháng
function holidays($holidays, $year, $month, $day1)
{
    $day_half = [];
    foreach ($holidays as $holiday) {
        $month1 =  intval(date_format(date_create($holiday->from_day), 'm'));
        $month2 =  intval(date_format(date_create($holiday->to_day), 'm'));
        $from_day =  intval(date_format(date_create($holiday->from_day), 'd'));
        $to_day =  intval(date_format(date_create($holiday->to_day), 'd'));
        $year3 = intval(date_format(date_create($holiday->from_day), 'Y'));
        $year4 = intval(date_format(date_create($holiday->to_day), 'Y'));

        if ($year3 == $year && $year4 == $year) {
            switch ($month) {
                case $month1 < $month && $month2 == $month:
                    for ($i = 1; $i <= $to_day; $i++) {
                        if (empty($day_half[$i]['day'])) {
                            $day_half[$i]['day'] = $i;
                            $day_half[$i]['salary_half'] = $holiday->salary_half;
                            $day_half[$i]['salary_working'] = $holiday->salary_working;
                        }
                    }
                    break;
                case $month1 == $month && $month2 > $month:
                    for ($i = $from_day; $i <= $day1; $i++) {
                        if (empty($day_half[$i]['day'])) {
                            $day_half[$i]['day'] = $i;
                            $day_half[$i]['salary_half'] = $holiday->salary_half;
                            $day_half[$i]['salary_working'] = $holiday->salary_working;
                        }
                    }
                    break;
                case $month1 == $month && $month2 == $month:
                    for ($i = $from_day; $i <= $to_day; $i++) {
                        if (empty($day_half[$i]['day'])) {
                            $day_half[$i]['day'] = $i;
                            $day_half[$i]['salary_half'] = $holiday->salary_half;
                            $day_half[$i]['salary_working'] = $holiday->salary_working;
                        }
                    }
                    break;
                case $month1 < $month && $month2 > $month:
                    for ($i = 1; $i <= $day1; $i++) {
                        if (empty($day_half[$i]['day'])) {
                            $day_half[$i]['day'] = $i;
                            $day_half[$i]['salary_half'] = $holiday->salary_half;
                            $day_half[$i]['salary_working'] = $holiday->salary_working;
                        }
                    }
                    break;
                default:
                    break;
            }
        }
    }
    return $day_half;
}

//hàm chấm công trong một ngày
function hendleTimekeep($input, $output, $timekeepRule)
{
    foreach ($timekeepRule as $key => $item)
        $type = $item->type;
    switch ($type) {
        case 0:
            $count = 0;

            foreach ($timekeepRule as $key => $timeRule) {
                $value = json_decode($timeRule->value);
                $input_time_mor = strtotime($value->day_rules->time_morning->input_time_mor);
                $output_time_mor = strtotime($value->day_rules->time_morning->output_time_mor);
                $count_mor = $value->day_rules->time_morning->count_mor;
                $option_before_mors = $value->day_rules->time_morning->option->before;
                $option_after_mors = $value->day_rules->time_morning->option->after;
                $input_time_aft = strtotime($value->day_rules->time_afternoon->input_time_aft);
                $output_time_aft = strtotime($value->day_rules->time_afternoon->output_time_aft);
                $count_aft = $value->day_rules->time_afternoon->count_aft;
                $option_before_afts = $value->day_rules->time_afternoon->option->before;
                $option_after_afts = $value->day_rules->time_afternoon->option->after;
                $option_penance_lates = $value->day_rules->penance->come_late;
                $option_penance_soons = $value->day_rules->penance->back_soon;
            }

            //dữ liệu buổi sáng
            $array1 = [
                'input' => $input,
                'output' => $output,
                'input_time' => $input_time_mor,
                'output_time' => $output_time_mor,
                'count' => $count_mor,
                'option_before' => $option_before_mors,
                'option_after' => $option_after_mors,
                'option_penance_lates' => $option_penance_lates,
                'option_penance_soons' => $option_penance_soons
            ];

            //dữ liệu buổi chiều
            $array2 = [
                'input' => $input,
                'output' => $output,
                'input_time' => $input_time_aft,
                'output_time' => $output_time_aft,
                'count' => $count_aft,
                'option_before' => $option_before_afts,
                'option_after' => $option_after_afts,
                'option_penance_lates' => $option_penance_lates,
                'option_penance_soons' => $option_penance_soons
            ];

            $sum_count_mor = 0;
            $sum_count_aft = 0;
            $sum_money_late_mor = 0;
            $sum_money_soon_mor = 0;
            $sum_money_late_aft = 0;
            $sum_money_soon_aft = 0;


            //tính công và tiền phạt buổi sáng
            if ($input <= $input_time_mor && $output >= $output_time_mor) {
                $sum_count_mor = $count_mor;
            } else {
                $sum_count_mor = timeKeep($array1);
                $sum_money_late_mor = penanceMonneyLate($array1);
                $sum_money_soon_mor = penanceMonneySoon($array1);
            }
            //tính công và tiền phạt buổi chiều
            if ($input <= $input_time_aft && $output >= $output_time_aft) {
                $sum_count_aft = $count_aft;
            } else {
                $sum_count_aft = timeKeep($array2);
                $sum_money_late_aft = penanceMonneyLate($array2);
                $sum_money_soon_aft = penanceMonneySoon($array2);
            }
            //Khi thời gian ra nhỏ hơn thời gian vào buổi chiều thì số công buổi chiều bằng 0
            if ($output < $input_time_aft) {
                $sum_count_aft = 0;
            }

            //Khi thời gian vào lớn hơn thời gian ra buổi sáng thì số công buổi sáng bằng 0
            if ($input > $output_time_mor) {
                $sum_count_mor = 0;
            }

            //Trong một buổi nếu không làm đủ 1 tiếng thì công bằng 0
            if (($output - $input) < 60 * 60) {
                $sum_count_aft = 0;
                $sum_count_mor = 0;
            }

            //Khi tổng công bằng 0 thì không trừ tiền phạt
            if ($sum_count_mor + $sum_count_aft <= 0) {
                $count = 0;
                $handle = [
                    'count' => $count,
                    'sum_money_late' => 0,
                    'sum_money_soon' => 0
                ];
            } else {
                $sum_money_late = $sum_money_late_mor + $sum_money_late_aft;
                $sum_money_soon = $sum_money_soon_mor + $sum_money_soon_aft;
                $count = $sum_count_mor + $sum_count_aft;
                $handle = [
                    'count' => $count,
                    'sum_money_late' => $sum_money_late,
                    'sum_money_soon' => $sum_money_soon
                ];
            }

            return $handle;
            break;
        case 1:
            foreach ($timekeepRule as $key => $timeRule) {
                $value = json_decode($timeRule->value);
                $input_time_shift = strtotime($value->shift_rules->input_time_shift);
                $output_time_shift = strtotime($value->shift_rules->output_time_shift);
                $count_shift = $value->shift_rules->count_shift;
                $option_before_shifts = $value->shift_rules->option->before;
                $option_after_shifts = $value->shift_rules->option->after;
                $day_apply = $value->shift_rules->day_apply;
                $option_penance_lates = $value->shift_rules->penance->come_late;
                $option_penance_soons = $value->shift_rules->penance->back_soon;
            }

            $array = [
                'input' => $input,
                'output' => $output,
                'input_time' => $input_time_shift,
                'output_time' => $output_time_shift,
                'count' => $count_shift,
                'option_before' => $option_before_shifts,
                'option_after' => $option_after_shifts,
                'option_penance_lates' => $option_penance_lates,
                'option_penance_soons' => $option_penance_soons
            ];


            $sum_count = 0;
            $sum_money_late = 0;
            $sum_money_soon = 0;

            if ($input <= $input_time_shift && $output >= $output_time_shift) {
                $sum_count = $count_shift;
            } else {
                $sum_count = timeKeep($array);
                $sum_money_late = penanceMonneyLate($array);
                $sum_money_soon = penanceMonneySoon($array);
            }
            if ($sum_count <= 0) {
                $handle = [
                    'count' => 0,
                    'sum_money_late' => 0,
                    'sum_money_soon' => 0
                ];
            } else {

                $handle = [
                    'count' => $sum_count,
                    'sum_money_late' => $sum_money_late,
                    'sum_money_soon' => $sum_money_soon
                ];
            }

            return $handle;

            break;
        default:

            break;
    }
}

//hàm chấm công trong ngày khi có đơn xin đi muộn, về sớm
function hendleTimekeepSingle($input, $output, $timekeepRule, $single)
{
    foreach ($timekeepRule as $key => $item)
        $type = $item->type;
    switch ($type) {
        case 0:
            $count = 0;

            foreach ($timekeepRule as $key => $timeRule) {
                $value = json_decode($timeRule->value);
                $input_time_mor = strtotime($value->day_rules->time_morning->input_time_mor);
                $output_time_mor = strtotime($value->day_rules->time_morning->output_time_mor);
                $count_mor = $value->day_rules->time_morning->count_mor;
                $option_before_mors = $value->day_rules->time_morning->option->before;
                $option_after_mors = $value->day_rules->time_morning->option->after;
                $input_time_aft = strtotime($value->day_rules->time_afternoon->input_time_aft);
                $output_time_aft = strtotime($value->day_rules->time_afternoon->output_time_aft);
                $count_aft = $value->day_rules->time_afternoon->count_aft;
                $option_before_afts = $value->day_rules->time_afternoon->option->before;
                $option_after_afts = $value->day_rules->time_afternoon->option->after;
                $option_penance_lates = $value->day_rules->penance->come_late;
                $option_penance_soons = $value->day_rules->penance->back_soon;
            }

            foreach ($single as $sin) {
                $value1 = json_decode($sin->value);
            }
            $single_late = $value1->late;
            $single_soon = $value1->soon;

            //dữ liệu buổi sáng
            $array1 = [
                'input' => $input,
                'output' => $output,
                'input_time' => $input_time_mor,
                'output_time' => $output_time_mor,
                'count' => $count_mor,
                'option_before' => $option_before_mors,
                'option_after' => $option_after_mors,
                'option_penance_lates' => $option_penance_lates,
                'option_penance_soons' => $option_penance_soons
            ];

            //dữ liệu buổi chiều
            $array2 = [
                'input' => $input,
                'output' => $output,
                'input_time' => $input_time_aft,
                'output_time' => $output_time_aft,
                'count' => $count_aft,
                'option_before' => $option_before_afts,
                'option_after' => $option_after_afts,
                'option_penance_lates' => $option_penance_lates,
                'option_penance_soons' => $option_penance_soons
            ];

            $sum_count_mor = 0; //số công buổi sáng
            $sum_count_aft = 0; //số công buổi chiều
            $sum_money_late_mor = 0; //tiền phạt đi muộn buổi sáng
            $sum_money_soon_mor = 0; //tiền phạt về sớm buổi sáng
            $sum_money_late_aft = 0; //tiền phạt đi muộn buổi chiều
            $sum_money_soon_aft = 0; //tiền phạt về sớm buổi chiều

            //tính công và tiền phạt buổi sáng
            if ($input <= $input_time_mor && $output >= $output_time_mor) {
                $sum_count_mor = $count_mor;
            } else {
                $sum_count_mor = timeKeep($array1);
                if (($input - $input_time_mor) <= $single_late * 60) {
                    $sum_money_late_mor = 0;
                } else {
                    $sum_money_late_mor = penanceMonneyLate($array1);
                }
                if (($output_time_mor - $output) <= $single_soon * 60) {
                    $sum_money_soon_mor = 0;
                } else {
                    $sum_money_soon_mor = penanceMonneySoon($array1);
                }
            }

            //tính công và tiền phạt buổi chiều
            if ($input <= $input_time_aft && $output >= $output_time_aft) {
                $sum_count_aft = $count_aft;
            } else {
                $sum_count_aft = timeKeep($array2);
                if (($input - $input_time_aft) <= $single_late * 60) {
                    $sum_money_late_aft = 0;
                } else {
                    $sum_money_late_aft = penanceMonneyLate($array2);
                }
                if (($output_time_aft - $output) <= $single_soon * 60) {
                    $sum_money_soon_aft = 0;
                } else {
                    $sum_money_soon_aft = penanceMonneySoon($array2);
                }
            }

            //Khi thời gian ra nhỏ hơn thời gian vào buổi chiều thì số công buổi chiều bằng 0
            if ($output < $input_time_aft) {
                $sum_count_aft = 0;
            }

            //Khi thời gian vào lớn hơn thời gian ra buổi sáng thì số công buổi sáng bằng 0
            if ($input > $output_time_mor) {
                $sum_count_mor = 0;
            }

            //Trong một buổi nếu không làm đủ 1 tiếng thì công bằng 0
            if (($output - $input) < 60 * 60) {
                $sum_count_aft = 0;
                $sum_count_mor = 0;
            }

            //Khi tổng công bằng 0 thì không trừ tiền phạt
            if ($sum_count_mor + $sum_count_aft <= 0) {
                $count = 0;
                $handle = [
                    'count' => $count,
                    'sum_money_late' => 0,
                    'sum_money_soon' => 0
                ];
            } else {
                $sum_money_late = $sum_money_late_mor + $sum_money_late_aft;
                $sum_money_soon = $sum_money_soon_mor + $sum_money_soon_aft;
                $count = $sum_count_mor + $sum_count_aft;
                $handle = [
                    'count' => $count,
                    'sum_money_late' => $sum_money_late,
                    'sum_money_soon' => $sum_money_soon
                ];
            }

            return $handle;
            break;
        case 1:
            foreach ($timekeepRule as $key => $timeRule) {
                $value = json_decode($timeRule->value);
                $input_time_shift = strtotime($value->shift_rules->input_time_shift);
                $output_time_shift = strtotime($value->shift_rules->output_time_shift);
                $count_shift = $value->shift_rules->count_shift;
                $option_before_shifts = $value->shift_rules->option->before;
                $option_after_shifts = $value->shift_rules->option->after;
                $day_apply = $value->shift_rules->day_apply;
                $option_penance_lates = $value->shift_rules->penance->come_late;
                $option_penance_soons = $value->shift_rules->penance->back_soon;
            }

            $array = [
                'input' => $input,
                'output' => $output,
                'input_time' => $input_time_shift,
                'output_time' => $output_time_shift,
                'count' => $count_shift,
                'option_before' => $option_before_shifts,
                'option_after' => $option_after_shifts,
                'option_penance_lates' => $option_penance_lates,
                'option_penance_soons' => $option_penance_soons
            ];

            foreach ($single as $sin) {
                $value2 = json_decode($sin->value);
            }

            $sum_count = 0; //số công
            $sum_money_late = 0; //tiền phạt đi muộn
            $sum_money_soon = 0; //tiền phạt về sớm
            $single_late = $value2->late;
            $single_soon = $value2->soon;

            if ($input <= $input_time_shift && $output >= $output_time_shift) {
                $sum_count = $count_shift;
            } else {
                $sum_count = timeKeep($array);
                if (($input - $input_time_shift) <= $single_late * 60) {
                    $sum_money_late = 0;
                } else {
                    $sum_money_late = penanceMonneyLate($array);
                }
                if (($output_time_shift - $output) <= $single_soon * 60) {
                    $sum_money_soon = 0;
                } else {
                    $sum_money_soon = penanceMonneySoon($array);
                }
            }

            if ($sum_count <= 0) {
                $handle = [
                    'count' => 0,
                    'sum_money_late' => 0,
                    'sum_money_soon' => 0
                ];
            } else {

                $handle = [
                    'count' => $sum_count,
                    'sum_money_late' => $sum_money_late,
                    'sum_money_soon' => $sum_money_soon
                ];
            }

            return $handle;

            break;
        default:

            break;
    }
}

//Hàm tính công
function timeKeep($array = [])
{
    foreach ($array['option_after'] as $key => $item1) {
        $time_after[$key] = strtotime($item1->time_after);
        $count_after[$key] = $item1->count_after;
    }
    foreach ($array['option_before'] as $key => $item2) {
        $time_before[$key] = strtotime($item2->time_before);
        $count_before[$key] = $item2->count_before;
    }

    $n1 = count($time_after);
    $n2 = count($time_before);

    $sum_count = 0;

    if (!empty($time_after[0]) && !empty($time_before[0])) {
        for ($i = 0; $i < $n1; $i++) {
            if ($time_after[$i] < $array['input']) {
                $sum_count = $count_after[$i];
            } elseif ($time_after[0] >= $array['input']) {
                $sum_count = $array['count'];
            }
        }
        for ($i = 0; $i < $n1; $i++) {
            for ($j = 0; $j < $n2; $j++) {
                if ($time_after[0] >= $array['input'] && $array['output'] < $time_before[$j]) {
                    $sum_count = $count_before[$j];
                } elseif ($time_after[0] >= $array['input'] && $array['output'] >= $time_before[0]) {
                    $sum_count = $array['count'];
                } elseif ($time_after[$i] < $array['input'] && $array['output'] < $time_before[$j]) {
                    $sum_count = round((($array['output'] - $array['input']) / ($array['output_time'] - $array['input_time'])) * $array['count'], 2);
                }
            }
        }
    } elseif (!empty($time_after[0]) && empty($time_before[0])) {
        for ($i = 0; $i < $n1; $i++) {
            if ($time_after[$i] < $array['input']) {
                $sum_count = $count_after[$i];
            } elseif ($time_after[0] >= $array['input']) {
                $sum_count = $array['count'];
            }
        }
    } elseif (empty($time_after[0]) && !empty($time_before[0])) {
        for ($j = 0; $j < $n2; $j++) {
            if ($array['output'] < $time_before[$j]) {
                $sum_count = $count_before[$j];
            } elseif ($array['output'] >= $time_before[0]) {
                $sum_count = $array['count'];
            }
        }
    } else {
        $sum_count = $array['count'];
    }
    return $sum_count;
}

//Hàm tính tiền phạt khi đi muộn
function penanceMonneyLate($array = [])
{
    foreach ($array['option_penance_lates'] as $key => $item3) {
        $time_penance_late[$key] = $item3->time_penance_late;
        $monney_penance_late[$key] = $item3->monney_penance_late;
    }

    $n3 = count($time_penance_late);
    $sum_money_late = 0;

    //Kiểm tra xem luật có tồn tại không nếu có sẽ tính tiền phạt còn không thì tiền phạt bằng 0
    if (!empty($time_penance_late[0])) {
        if ($array['input'] < $array['output_time']) {
            for ($x = 0; $x < $n3; $x++) {
                if (($array['input'] - $array['input_time']) >= $time_penance_late[$x] * 60) {
                    $sum_money_late = $monney_penance_late[$x];
                }
            }
        }
    } else {
        $sum_money_late = 0;
    }

    return $sum_money_late;
}

//Hàm tính tiền phạt khi về sớm
function penanceMonneySoon($array = [])
{
    foreach ($array['option_penance_soons'] as $key => $item3) {
        $time_penance_soon[$key] = $item3->time_penance_soon;
        $monney_penance_soon[$key] = $item3->monney_penance_soon;
    }

    $n3 = count($time_penance_soon);
    $sum_money_soon = 0;

    //Kiểm tra xem luật có tồn tại không nếu có sẽ tính tiền phạt còn không thì tiền phạt bằng 0
    if (!empty($time_penance_soon[0])) {
        if ($array['output'] > $array['input_time']) {
            for ($x = 0; $x < $n3; $x++) {
                if (($array['output_time'] - $array['output']) >= $time_penance_soon[$x] * 60) {
                    $sum_money_soon = $monney_penance_soon[$x];
                }
            }
        }
    } else {
        $sum_money_soon = 0;
    }

    return $sum_money_soon;
}
