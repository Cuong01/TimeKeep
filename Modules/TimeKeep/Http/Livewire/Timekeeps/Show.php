<?php

namespace Modules\TimeKeep\Http\Livewire\Timekeeps;

use App\Models\Application;
use App\Models\Holiday;
use App\Models\Single;
use App\Models\Singlecease;
use App\Models\Singlelatesoon;
use App\Models\Timekeep;
use App\Models\TimekeepRule;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Hungnm28\LaravelForm\Facades\LaravelForm;
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Livewire\Component;


class Show extends Component
{
    use WithLaravelFormTrait;

    public $month_date;
    public $years_date;

    public function mount()
    {
        $this->authorize("time-keep.timekeeps.show");
        User::findOrFail($this->record_id);
        $this->month_date = Carbon::now()->month;
        $this->years_date = Carbon::now()->year;
    }

    public function render()
    {
        $data =  User::findOrFail($this->record_id);
        $month = $this->month_date;
        $timekeeps = Timekeep::whereMonth('created_at', $this->month_date)->whereYear('created_at', $this->years_date)->get();
        $holidays = Holiday::where('status', 1)->get();
        $timekeepRules = TimekeepRule::all();
        $singles = Single::where('status', 1)->get();
        $user = User::all();

        $staffs = timeKeeps($this->years_date, $this->month_date, $this->record_id, $holidays, $timekeeps, $singles, $timekeepRules, $user);
        $messages = $staffs['mes'];

        lForm()->setTitle("Chấm công");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.timekeeps"), "Timekeeps");
        lForm()->pushBreadcrumb(route("time-keep.timekeeps.show", $this->record_id), "Show");

        return view("time-keep::livewire.timekeeps.show", compact("data", 'staffs', 'month', 'messages'))
            ->layout('time-keep::layouts.master', ['title' => 'Timekeeps Show']);
    }
}
