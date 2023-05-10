<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\StringCast;
use App\Casts\BooleanCast;

class Holiday extends Model
{
    use HasFactory;

    protected $table = 'holidays';

    protected $fillable = ["name", "from_day", "to_day", "salary_half", "salary_working", "status"];

    public static $listFields = ["id", "name", "from_day", "to_day", "salary_half", "salary_working", "status", "created_at", "updated_at"];

    protected $casts = [
        "name" => StringCast::class,
		"salary_half" => StringCast::class,
		"salary_working" => StringCast::class,
		"status" => BooleanCast::class,
		
    ];
}
