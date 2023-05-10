<?php
Route::get('/', [\Modules\TimeKeep\Http\Controllers\HomeController::class, "index"])->can('time-keep');

Route::prefix("timekeeps")->name(".timekeeps")->group(function () {
    Route::get("/", \Modules\TimeKeep\Http\Livewire\Timekeeps\Listing::class)->can("time-keep.timekeeps");
    Route::get("/chamcong", [\Modules\TimeKeep\Http\Livewire\Timekeeps\Listing::class, 'store'])->name(".store");
    Route::get("/chamcong/{time}", [\Modules\TimeKeep\Http\Livewire\Timekeeps\Listing::class, 'store0'])->name(".store0");
    Route::get("/create", \Modules\TimeKeep\Http\Livewire\Timekeeps\Create::class)->name(".create")->can("time-keep.timekeeps.create");
    Route::get("/edit/{record_id}", \Modules\TimeKeep\Http\Livewire\Timekeeps\Edit::class)->name(".edit")->can("time-keep.timekeeps.edit");
    Route::get("/show/{record_id}", \Modules\TimeKeep\Http\Livewire\Timekeeps\Show::class)->name(".show")->can("time-keep.timekeeps.edit");
    //---END-OF-TIMEKEEPS---//
});

Route::prefix("timekeep-rules")->name(".timekeep-rules")->group(function () {
    Route::get("/", \Modules\TimeKeep\Http\Livewire\TimekeepRules\Listing::class)->can("time-keep.timekeep-rules");
    Route::get("/create", \Modules\TimeKeep\Http\Livewire\TimekeepRules\Create::class)->name(".create")->can("time-keep.timekeep-rules.create");
    Route::get("/edit/{record_id}", \Modules\TimeKeep\Http\Livewire\TimekeepRules\Edit::class)->name(".edit")->can("time-keep.timekeep-rules.edit");
    Route::get("/show/{record_id}", \Modules\TimeKeep\Http\Livewire\TimekeepRules\Show::class)->name(".show")->can("time-keep.timekeep-rules.show");
    //---END-OF-TIMEKEEPRULES---//
});

Route::prefix("singles")->name(".singles")->group(function () {
    Route::get("/", \Modules\TimeKeep\Http\Livewire\Singles\Listing::class)->can("time-keep.singles");
    Route::get("/create", \Modules\TimeKeep\Http\Livewire\Singles\Create::class)->name(".create")->can("time-keep.singles.create");
    Route::get("/edit/{record_id}", \Modules\TimeKeep\Http\Livewire\Singles\Edit::class)->name(".edit")->can("time-keep.singles.edit");
    Route::get("/show/{record_id}", \Modules\TimeKeep\Http\Livewire\Singles\Show::class)->name(".show")->can("time-keep.singles.show");
    //---END-OF-SINGLES---//
});

Route::prefix("applications")->name(".applications")->group(function () {
    Route::get("/", \Modules\TimeKeep\Http\Livewire\Applications\Listing::class)->can("time-keep.applications");
    Route::get("/create", \Modules\TimeKeep\Http\Livewire\Applications\Create::class)->name(".create")->can("time-keep.applications.create");
    Route::get("/edit/{record_id}", \Modules\TimeKeep\Http\Livewire\Applications\Edit::class)->name(".edit")->can("time-keep.applications.edit");
    Route::get("/show/{record_id}", \Modules\TimeKeep\Http\Livewire\Applications\Show::class)->name(".show")->can("time-keep.applications.show");
    //---END-OF-APPLICATIONS---//
});


Route::prefix("holidays")->name(".holidays")->group(function () {
    Route::get("/", \Modules\TimeKeep\Http\Livewire\Holidays\Listing::class)->can("time-keep.holidays");
    Route::get("/create", \Modules\TimeKeep\Http\Livewire\Holidays\Create::class)->name(".create")->can("time-keep.holidays.create");
    Route::get("/edit/{record_id}", \Modules\TimeKeep\Http\Livewire\Holidays\Edit::class)->name(".edit")->can("time-keep.holidays.edit");
    Route::get("/show/{record_id}", \Modules\TimeKeep\Http\Livewire\Holidays\Show::class)->name(".show")->can("time-keep.holidays.show");
    //---END-OF-HOLIDAYS---//
});

//---END-OF-ROUTES---//
