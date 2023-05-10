<?php
Route::get('/', [\Modules\Demo\Http\Controllers\HomeController::class,"index"]);

Route::prefix("companies")->name(".companies")->group(function (){
    Route::get("/", \Modules\Demo\Http\Livewire\Companies\Listing::class)->can("demo.companies.listing");
    Route::get("/create", \Modules\Demo\Http\Livewire\Companies\Create::class)->name(".create")->can("demo.companies.create");
    Route::get("/edit/{record_id}", \Modules\Demo\Http\Livewire\Companies\Edit::class)->name(".edit")->can("demo.companies.edit");
    Route::get("/show/{record_id}", \Modules\Demo\Http\Livewire\Companies\Show::class)->name(".show")->can("demo.companies.edit");
    //---END-OF-COMPANIES---//
});

//---END-OF-ROUTES---//
