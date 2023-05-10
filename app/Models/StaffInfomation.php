<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\StringCast;
use App\Casts\BooleanCast;
use App\Casts\IntegerCast;
use App\Casts\EmailCast;

class StaffInfomation extends Model
{
    use HasFactory;

    protected $table = 'staff_infomations';

    protected $fillable = ["name", "gender", "company_id", "department_id", "timekeep_rule", "position_id", "place_of_birth", "birthday", "phone", "email", "facebook", "zalo", "home_town", "ethnic", "religion", "permanent_address", "temporary_residence_address", "tax_code", "id_number", "place_of_issue_of_id_card", "date_of_issue_of_id_card", "relative_phone_number", "relative_name", "foreign_language", "computer_skill", "educational_level", "academic_level", "specialized", "insurance_number", "insurance_participation_date", "registration_address", "examination_and_treatment", "health", "weight", "height", "bank_name", "account_number", "note", "contract_id", "total_salary", "salary_received", "type_contract", "sign_day", "expiration_date"];

    public static $listFields = ["id", "name", "gender", "company_id", "department_id", "timekeep_rule", "position_id", "place_of_birth", "birthday", "phone", "email", "facebook", "zalo", "home_town", "ethnic", "religion", "permanent_address", "temporary_residence_address", "tax_code", "id_number", "place_of_issue_of_id_card", "date_of_issue_of_id_card", "relative_phone_number", "relative_name", "foreign_language", "computer_skill", "educational_level", "academic_level", "specialized", "insurance_number", "insurance_participation_date", "registration_address", "examination_and_treatment", "health", "weight", "height", "bank_name", "account_number", "note", "contract_id", "total_salary", "salary_received", "type_contract", "sign_day", "expiration_date", "created_at", "updated_at"];

    protected $casts = [
        "name" => StringCast::class,
		"gender" => BooleanCast::class,
		"company_id" => IntegerCast::class,
		"department_id" => IntegerCast::class,
		"timekeep_rule" => IntegerCast::class,
		"position_id" => IntegerCast::class,
		"place_of_birth" => StringCast::class,
		"phone" => StringCast::class,
		"email" => EmailCast::class,
		"facebook" => StringCast::class,
		"zalo" => StringCast::class,
		"home_town" => StringCast::class,
		"ethnic" => StringCast::class,
		"religion" => StringCast::class,
		"permanent_address" => StringCast::class,
		"temporary_residence_address" => StringCast::class,
		"tax_code" => IntegerCast::class,
		"id_number" => IntegerCast::class,
		"place_of_issue_of_id_card" => StringCast::class,
		"relative_phone_number" => StringCast::class,
		"relative_name" => StringCast::class,
		"foreign_language" => StringCast::class,
		"computer_skill" => StringCast::class,
		"educational_level" => StringCast::class,
		"academic_level" => StringCast::class,
		"specialized" => StringCast::class,
		"insurance_number" => StringCast::class,
		"registration_address" => StringCast::class,
		"examination_and_treatment" => StringCast::class,
		"health" => StringCast::class,
		"weight" => IntegerCast::class,
		"height" => IntegerCast::class,
		"bank_name" => StringCast::class,
		"account_number" => IntegerCast::class,
		"note" => StringCast::class,
		"contract_id" => StringCast::class,
		"total_salary" => IntegerCast::class,
		"salary_received" => IntegerCast::class,
		"type_contract" => IntegerCast::class,
		
    ];
}
