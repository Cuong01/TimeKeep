<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("user_name")->nullable();
            $table->string("profile_id")->nullable();
            $table->date("birthday")->nullable();
            $table->tinyInteger("gender")->nullable()->default(0);
            $table->string("address")->nullable();
            $table->string("phone")->nullable();
            $table->integer("company_id")->nullable()->default(0);
            $table->integer("department_id")->nullable()->default(0);
            $table->integer("position_id")->nullable()->default(0);
            $table->integer("level")->nullable()->default(0);
            $table->integer("timkeep_rule")->nullable()->default(0);
            $table->json("other_info")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
