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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->integer('profile_id')->nullable();
            $table->string('name')->nullable();
            $table->integer('some_contracts')->nullable();
            $table->date('sign_day')->nullable();
            $table->tinyInteger('type')->nullable()->default(0);
            $table->date('effective_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->tinyInteger('type_of_work')->nullable();
            $table->tinyInteger('rank')->nullable()->default(0);
            $table->integer('total_salary')->nullable()->default(0);
            $table->integer('salary_received')->nullable()->default(0);
            $table->integer('basic_salary')->nullable()->default(0);
            $table->tinyInteger('pay_forms')->nullable()->default(0);
            $table->integer('salary_paid_for_insurance')->nullable()->default(0);
            $table->integer('salary_percentage')->nullable()->default(0);
            $table->integer('salary_allowance')->nullable()->default(0);
            $table->integer('signed_representative')->nullable()->default(0);
            $table->integer('position_id')->nullable()->default(0);
            $table->string('note')->nullable();
            $table->string('file')->nullable();
            $table->integer('active')->nullable()->default(0);
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
        Schema::dropIfExists('contracts');
    }
};
