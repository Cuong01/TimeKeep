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
use Hungnm28\LaravelForm\Traits\WithLaravelFormTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Switch_;

class Listing extends Component
{
    use WithLaravelFormTrait;

    public $confirm = 0;
    public $month_date;
    public $years_date;

    // Filter
    public $fId;
    // Sort
    public $sId = 0;
    public $count = 0;
    public $fields = [
        "id" => ["status" => true, "label" => "Id"],
        "user_id" => ["status" => true, "label" => "User Id"],
        "time" => ["status" => true, "label" => "Time"],
        "company_id" => ["status" => true, "label" => "Company Id"],
        "status" => ["status" => true, "label" => "Status"],
        "note" => ["status" => true, "label" => "Note"],
        "created_at" => ["status" => true, "label" => "Created At"],
        "updated_at" => ["status" => true, "label" => "Updated At"],

    ];

    public function mount()
    {
        $this->authorize("time-keep.timekeeps.listing");
        $this->month_date = Carbon::now()->month;
        $this->years_date = Carbon::now()->year;
    }

    function delete()
    {
        $this->authorize("time-keep.timekeeps.delete");
        if ($this->confirm > 0) {
            Timekeep::destroy($this->confirm);
        }
        $this->confirm = 0;
        $this->dispatchBrowserEvent('warning', 'Timekeeps successfully destroyed.');
    }

    public function store(Request $request)
    {
        $dem = 0;
        $time1 =  date('Y-m-d', time());
        $data = Timekeep::where('user_id', Auth::user()->id)->whereDate('created_at', $time1)->first();
        if ($data) {
            $data->updated_at = time();
            $data->status = 1;
            $data->update();
        } else {

            $data = Timekeep::create([
                'user_id' => Auth::user()->id,
                'status' => $dem,
                'note' => $request->ip(),
            ]);
        }

        if ($data) {
            $this->redirectForm("time-keep.timekeeps", $data->id);
        }

        return Redirect()->route("time-keep.timekeeps");
    }

    public function store0(Request $request, $time)
    {
        $a = json_decode(base64_decode($time));
        $b = strtotime($a->time);
        $c = strtotime(date('Y-m-d H:i:s', time()));
        $d =  $c - $b;
        $dem = 0;
        $time1 =  date('Y-m-d', time());
        $data = Timekeep::where('user_id', Auth::user()->id)->whereDate('created_at', $time1)->first();

        if ($d < 60) {
            if ($data) {
                $data->updated_at = time();
                $data->status = 1;
                $data->update();
            } else {
                $data = Timekeep::create([
                    'user_id' => Auth::user()->id,
                    'status' => $dem,
                    'note' => $request->ip(),

                ]);
            }

            if ($data) {
                $this->redirectForm("time-keep.timekeeps", $data->id);
            }

            return Redirect()->route("time-keep.timekeeps");
        } else {
            return Redirect()->route("time-keep.timekeeps")->with('error', 'Mã QR Code đã hết hạn');
        }
    }

    public function store1(Request $request, $time)
    {
        $a = json_decode(base64_decode($time));
        $b = strtotime($a->time);
        $c = strtotime(date('Y-m-d H:i:s', time()));
        $d =  $c - $b;
        if (Auth::user() == true) {
            $dem = 0;
            $time1 =  date('Y-m-d', time());
            $data = Timekeep::where('user_id', Auth::user()->id)->whereDate('created_at', $time1)->first();

            if ($d < 60) {

                if ($data) {
                    $data->updated_at = time();
                    $data->status = 1;
                    $data->update();
                } else {

                    $data = Timekeep::create([
                        'user_id' => Auth::user()->id,
                        'status' => $dem,
                        'note' => $request->ip(),
                    ]);
                }

                if ($data) {
                    $this->redirectForm("dashboard", $data->id);
                }
                return Redirect()->route("dashboard");
            } else {

                return Redirect()->route("dashboard")->with('error', 'Mã QR Code đã hết hạn');
            }
        } else {
            return Redirect()->route("login");
        }
    }

    public function store2(Request $request)
    {
        $dem = 0;
        $time1 =  date('Y-m-d', time());
        $data = Timekeep::where('user_id', Auth::user()->id)->whereDate('created_at', $time1)->first();

        if ($data) {
            $data->updated_at = time();
            $data->status = 1;
            $data->update();
        } else {

            $data = Timekeep::create([
                'user_id' => Auth::user()->id,
                'status' => $dem,
                'note' => $request->ip(),
            ]);
        }

        if ($data) {
            $this->redirectForm("dashboard", $data->id);
        }
        return Redirect()->route("dashboard");
    }

    public function render(Request $request)
    {
        // dd($this->years_date);
        $data = new Timekeep();
        if ($this->fId > 0) {
            $data = $data->whereId($this->fId);
        }
        if ($this->sId == 1) {
            $data = $data->orderBy("id");
        }
        if ($this->sId == 2) {
            $data = $data->orderByDesc("id");
        }
        $data = $data->orderBy('id', 'desc')->paginate(10);

        $messages = '';

        $user = User::all();
        $timekeeps = Timekeep::whereMonth('created_at', $this->month_date)->whereYear('created_at', $this->years_date)->get();
        $holidays = Holiday::where('status', 1)->get();
        $singles = Single::where('status', 1)->get();
        $timekeepRules = TimekeepRule::all();

        $days = dayMonth($this->years_date, $this->month_date, $holidays); //lấy ngày trong tháng


        foreach ($user as $key => $us) {
            $staffs[$us->id] = timeKeeps($this->years_date, $this->month_date, $us->id, $holidays, $timekeeps, $singles, $timekeepRules, $user); //chấm công 
            if (!empty($staffs[$us->id]['mes'])) {
                $messages = $staffs[$us->id]['mes'];
            }
        }

        $qr = json_encode([
            'ip' => request()->ip(),
            'user' => Auth::user()->id,
            'time' => date('Y-m-d H:i:s', time())
        ]);
        $time = base64_encode($qr);


        lForm()->setTitle("Chấm công");
        lForm()->pushBreadcrumb(route("time-keep"), "Time Keep");
        lForm()->pushBreadcrumb(route("time-keep.timekeeps"), "Timekeeps");
        return view("time-keep::livewire.timekeeps.listing", compact("data", 'user', 'time', 'staffs', 'days', 'messages'))
            ->layout('time-keep::layouts.master', ['title' => 'Timekeeps Create']);
    }
}
