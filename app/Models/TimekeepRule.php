<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\StringCast;
use App\Casts\IntegerCast;

class TimekeepRule extends Model
{
    use HasFactory;

    protected $table = 'timekeep_rules';

    protected $fillable = ["name", "type", "value", "status", "active"];

    public static $listFields = ["id", "name", "type", "value", "status", "active", "created_at", "updated_at"];

    protected $casts = [
        "name" => StringCast::class,
        "type" => StringCast::class,
        "status" => IntegerCast::class,

    ];
}
