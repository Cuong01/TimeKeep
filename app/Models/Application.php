<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\StringCast;
use App\Casts\IntegerCast;

class Application extends Model
{
    use HasFactory;

    protected $table = 'applications';

    protected $fillable = ["name", "salary", "day", "status"];

    public static $listFields = ["id", "name", "salary", "day", "status", "created_at", "updated_at"];

    protected $casts = [
        "name" => StringCast::class,
		"salary" => StringCast::class,
		"day" => StringCast::class,
		"status" => IntegerCast::class,
		
    ];
}
