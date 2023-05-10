<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\IntegerCast;
use App\Casts\StringCast;
use App\Casts\BooleanCast;
use App\Casts\LogoCast;

class Contract extends Model
{
	use HasFactory;

	protected $table = 'contracts';

	protected $fillable = ["profile_id", "name", "some_contracts", "sign_day", "type", "effective_date", "expiration_date", "type_of_work", "rank", "total_salary", "salary_received", "basic_salary", "pay_forms", "salary_paid_for_insurance", "salary_percentage", "salary_allowance", "signed_representative", "position_id", "note", "file", "active"];

	public static $listFields = ["id", "profile_id", "name", "some_contracts", "sign_day", "type", "effective_date", "expiration_date", "type_of_work", "rank", "total_salary", "salary_received", "basic_salary", "pay_forms", "salary_paid_for_insurance", "salary_percentage", "salary_allowance", "signed_representative", "position_id", "note", "file", "active", "created_at", "updated_at"];

	protected $casts = [
		"profile_id" => IntegerCast::class,
		"name" => StringCast::class,
		"some_contracts" => IntegerCast::class,
		"type" => BooleanCast::class,
		"type_of_work" => BooleanCast::class,
		"rank" => BooleanCast::class,
		"pay_forms" => BooleanCast::class,
		"position_id" => IntegerCast::class,
		"note" => StringCast::class,
		"file" => LogoCast::class,
		"active" => IntegerCast::class,

	];
}
