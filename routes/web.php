<?php

use App\Http\Controllers\Controller;
use App\Models\Timekeep;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function (Request $request) {
        $timekeep = Timekeep::all();
        $user = User::all();
        $qr = json_encode([
            'ip' => request()->ip(),
            'user' => Auth::user()->id,
            'time' => date('Y-m-d H:i:s', time())
        ]);
        $time = base64_encode($qr);
        return view('dashboard', compact('timekeep', 'user', 'time'));
    })->name('dashboard');
});

Route::get("/chamcong1/{time}", [\Modules\TimeKeep\Http\Livewire\Timekeeps\Listing::class, 'store1']);
Route::get("/chamcong1", [\Modules\TimeKeep\Http\Livewire\Timekeeps\Listing::class, 'store2'])->name(".store2");
