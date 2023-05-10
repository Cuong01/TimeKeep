<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\IntegerCast;
use App\Casts\StringCast;

class Single extends Model
{
    use HasFactory;

    protected $table = 'singles';

    protected $fillable = ["user_id", "company_id", "name", "type", "value", "reason", "censor", "status"];

    public static $listFields = ["id", "user_id", "company_id", "name", "type", "value", "reason", "censor", "status", "created_at", "updated_at"];

    protected $casts = [
        "user_id" => IntegerCast::class,
		"company_id" => IntegerCast::class,
		"name" => StringCast::class,
		"type" => IntegerCast::class,
		"censor" => StringCast::class,
		"status" => IntegerCast::class,
		
    ];
}
