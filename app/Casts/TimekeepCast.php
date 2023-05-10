<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class TimekeepCast implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes)
    {
        return json_decode($value);
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function set($model, string $key, $value, array $attributes)
    {
        $type = data_get($value, "type", "");
        switch ($type) {
            case "Chấm công theo ngày":
                dd('a');
                // $data = [
                //     'day_rules' => [
                //         'time_morning' => [
                //             'input_time_mor' => $this->input_time_mor,
                //             'output_time_mor' => $this->output_time_mor,
                //             'count_mor' => $this->count_mor,
                //             'option' => [
                //                 'after' => [
                //                     'after_mor' => $this->after_mor,
                //                     'cout_punish_after_mor' => $this->cout_punish_after_mor
                //                 ],
                //                 'before' => [
                //                     'before_mor' => $this->before_mor,
                //                     'cout_punish_before_mor' => $this->cout_punish_before_mor
                //                 ]
                //             ],
                //         ],
                //         'time_afternoon' => [
                //             'input_time_aft' => $this->input_time_aft,
                //             'output_time_aft' => $this->output_time_aft,
                //             'count_aft' => $this->count_aft,
                //             'option' => [
                //                 'after' => [
                //                     'after_aft' => $this->after_aft,
                //                     'cout_punish_after_aft' => $this->cout_punish_after_aft
                //                 ],
                //                 'before' => [
                //                     'before_aft' => $this->before_aft,
                //                     'cout_punish_before_aft' => $this->cout_punish_before_aft
                //                 ]
                //             ],
                //         ],

                //         'penance' => [

                //             'p5' => $this->monny_late_5,
                //             'p10' => $this->monny_late_10,
                //             'p20' => $this->monny_late_20,
                //             'p30' => $this->monny_late_30

                //         ],
                //     ],

                // ];
                break;
            case "Chấm công theo ca":
                dd('b');
                // $data = [
                //     'shift_rules' => [
                //         'input_time_shift' => $this->input_time_shift,
                //         'output_time_shift' => $this->output_time_shift,
                //         'count_shift' => $this->count_shift,
                //         'option' => [
                //             'after' => [
                //                 'after_shift' => $this->after_shift,
                //                 'cout_punish_after_shift' => $this->cout_punish_after_shift
                //             ],
                //             'before' => [
                //                 'before_shift' => $this->before_shift,
                //                 'cout_punish_before_shift' => $this->cout_punish_before_shift
                //             ],
                //         ],
                //         'day_apply' => $this->day_apply,
                //         Ư
                //     ],
                // ];
                break;
            default:
                $data = '';
                break;
        }
        return json_encode($data);
    }
}
