<?php

Route::get('/', [\Modules\Company\Http\Controllers\HomeController::class, "index"])->can('company');

Route::prefix("companies")->name(".companies")->group(function () {
    Route::get("/", \Modules\Company\Http\Livewire\Companies\Listing::class)->can("company.companies");
    Route::get("/create", \Modules\Company\Http\Livewire\Companies\Create::class)->name(".create")->can("company.companies.create");
    Route::get("/edit/{record_id}", \Modules\Company\Http\Livewire\Companies\Edit::class)->name(".edit")->can("company.companies.edit");
    Route::get("/show/{record_id}", \Modules\Company\Http\Livewire\Companies\Show::class)->name(".show")->can("company.companies.edit");
    //---END-OF-COMPANIES---//
});

Route::prefix("departments")->name(".departments")->group(function () {
    Route::get("/", \Modules\Company\Http\Livewire\Departments\Listing::class)->can("company.departments");
    Route::get("/create", \Modules\Company\Http\Livewire\Departments\Create::class)->name(".create")->can("company.departments.create");
    Route::get("/edit/{record_id}", \Modules\Company\Http\Livewire\Departments\Edit::class)->name(".edit")->can("company.departments.edit");
    Route::get("/show/{record_id}", \Modules\Company\Http\Livewire\Departments\Show::class)->name(".show")->can("company.departments.edit");
    //---END-OF-DEPARTMENTS---//
});

Route::prefix("users")->name(".users")->group(function () {
    Route::get("/", \Modules\Company\Http\Livewire\Users\Listing::class)->can("company.users");
    Route::get("/create/{record_id}", \Modules\Company\Http\Livewire\Users\Create::class)->name(".create")->can("company.users.create");
    Route::get("/edit/{record_id}", \Modules\Company\Http\Livewire\Users\Edit::class)->name(".edit")->can("company.users.edit");
    Route::get("/show/{record_id}", \Modules\Company\Http\Livewire\Users\Show::class)->name(".show")->can("company.users.edit");
    //---END-OF-USERS---//
});

Route::prefix("positions")->name(".positions")->group(function () {
    Route::get("/", \Modules\Company\Http\Livewire\Positions\Listing::class)->can("company.positions");
    Route::get("/create", \Modules\Company\Http\Livewire\Positions\Create::class)->name(".create")->can("company.positions.create");
    Route::get("/edit/{record_id}", \Modules\Company\Http\Livewire\Positions\Edit::class)->name(".edit")->can("company.positions.edit");
    Route::get("/show/{record_id}", \Modules\Company\Http\Livewire\Positions\Show::class)->name(".show")->can("company.positions.edit");
    //---END-OF-POSITIONS---//
});

Route::prefix("contracts")->name(".contracts")->group(function () {
    Route::get("/", \Modules\Company\Http\Livewire\Contracts\Listing::class)->can("company.contracts");
    Route::get("/create/{record_id}", \Modules\Company\Http\Livewire\Contracts\Create::class)->name(".create")->can("company.contracts.create");
    Route::get("/edit/{record_id}", \Modules\Company\Http\Livewire\Contracts\Edit::class)->name(".edit")->can("company.contracts.edit");
    Route::get("/show/{record_id}", \Modules\Company\Http\Livewire\Contracts\Show::class)->name(".show")->can("company.contracts.show");
    //---END-OF-CONTRACTS---//
});

Route::prefix("staff-infomations")->name(".staff-infomations")->group(function () {
    Route::get("/", \Modules\Company\Http\Livewire\StaffInfomations\Listing::class)->can("company.staff-infomations");
    Route::get("/create", \Modules\Company\Http\Livewire\StaffInfomations\Create::class)->name(".create")->can("company.staff-infomations.create");
    Route::get("/edit/{record_id}", \Modules\Company\Http\Livewire\StaffInfomations\Edit::class)->name(".edit")->can("company.staff-infomations.edit");
    Route::get("/show/{record_id}", \Modules\Company\Http\Livewire\StaffInfomations\Show::class)->name(".show")->can("company.staff-infomations.show");
    //---END-OF-STAFFINFOMATIONS---//
});

//---END-OF-ROUTES---//
