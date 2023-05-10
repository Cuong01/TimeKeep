<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('permissions', 'type')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->string("type")->nullable()->default("page");
            });
        }
        if (!Schema::hasColumn('permissions', 'label')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->string("label")->nullable();
            });
        }
        if (!Schema::hasColumn('permissions', 'module')) {
            Schema::table('permissions', function (Blueprint $table) {
                $table->string("module")->nullable();
            });
        }
        if (!Schema::hasColumn('roles', 'type')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->string("type")->nullable()->default("page");
            });
        }
        if (!Schema::hasColumn('roles', 'label')) {
            Schema::table('roles', function (Blueprint $table) {
                $table->string("label")->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
