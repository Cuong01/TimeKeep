<?php

namespace App\Http\Controllers;

use App\Models\Timekeep;
use GuzzleHttp\Psr7\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function store(Request $request)
    {
        $dem = 0;
        $time =  date('Y-m-d', time());
        $data = Timekeep::where('user_id', Auth::user()->id)->whereDate('created_at', $time)->first();

        $text = '28-09-2022 17:45:00';
        $time =  strtotime($text);

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
}
