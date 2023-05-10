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
        Schema::create('emodules', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("label")->nullable();
            $table->string("slug")->nullable();
            $table->string("route")->nullable();
            $table->string("icon")->nullable();
            $table->integer("parent_id")->nullable()->default(0)->index();
            $table->string("permission")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emodules');
    }
};
