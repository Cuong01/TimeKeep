<?php
Route::get('/', [\Modules\Admin\Http\Controllers\HomeController::class, "index"])->can('admin');
Route::get("/icons", \Modules\Admin\Http\Livewire\Icons\Listing::class)->name('.icons')->can("admin.icons");
Route::prefix("menus")->name(".menus")->group(function (){
    Route::get("/", \Modules\Admin\Http\Livewire\Menus\Listing::class)->can("admin.menus.listing");
    Route::get("/create", \Modules\Admin\Http\Livewire\Menus\Create::class)->name(".create")->can("admin.menus.create");
    Route::get("/edit", \Modules\Admin\Http\Livewire\Menus\Edit::class)->name(".edit")->can("admin.menus.edit");
});
Route::prefix("permissions")->name(".permissions")->group(function (){
    Route::get("/", \Modules\Admin\Http\Livewire\Permissions\Listing::class)->can("admin.permissions.listing");
    Route::get("/create", \Modules\Admin\Http\Livewire\Permissions\Create::class)->name(".create")->can("admin.permissions.create");
    Route::get("/edit/{record_id}", \Modules\Admin\Http\Livewire\Permissions\Edit::class)->name(".edit")->can("admin.permissions.edit");
    Route::get("/show/{record_id}", \Modules\Admin\Http\Livewire\Permissions\Show::class)->name(".show")->can("admin.permissions.show");
    //---END-OF-PERMISSIONS---//
});

//---END-OF-ROUTES---//
