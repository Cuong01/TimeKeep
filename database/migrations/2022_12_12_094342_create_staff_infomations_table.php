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
        Schema::create('staff_infomations', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->tinyInteger("gender")->nullable()->default(0);
            $table->integer("company_id")->nullable()->default(0);
            $table->integer("department_id")->nullable()->default(0);
            $table->integer("position_id")->nullable()->default(0);
            $table->integer("timekeep_rule")->nullable();
            $table->string('place_of_birth')->nullable();
            $table->date('birthday')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('zalo')->nullable();
            $table->string('home_town')->nullable();
            $table->string('ethnic')->nullable();
            $table->string('religion')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('temporary_residence_address')->nullable();
            $table->integer('tax_code')->nullable();
            $table->integer('id_number')->nullable();
            $table->string('place_of_issue_of_id_card')->nullable();
            $table->date('date_of_issue_of_id_card')->nullable();
            $table->string('relative_phone_number')->nullable();
            $table->string('relative_name')->nullable();
            $table->string('foreign_language')->nullable();
            $table->string('computer_skill')->nullable();
            $table->string('educational_level')->nullable();
            $table->string('academic_level')->nullable();
            $table->string('specialized')->nullable();
            $table->string('insurance_number')->nullable();
            $table->date('insurance_participation_date')->nullable();
            $table->string('registration_address')->nullable();
            $table->string('examination_and_treatment')->nullable();
            $table->string('health')->nullable();
            $table->integer('weight')->nullable();
            $table->integer('height')->nullable();
            $table->string('bank_name')->nullable();
            $table->integer('account_number')->nullable();
            $table->string('note')->nullable();
            $table->string('contract_id')->nullable();
            $table->integer('total_salary')->nullable();
            $table->integer('salary_received')->nullable();
            $table->integer('type_contract')->nullable();
            $table->date('sign_day')->nullable();
            $table->date('expiration_date')->nullable();
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
        Schema::dropIfExists('staff_infomations');
    }
};
