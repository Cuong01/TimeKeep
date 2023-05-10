<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chamcong extends Model
{
    use HasFactory;

    protected $table = 'timekeeps';

    protected $fillable = ["user_id", "ip"];

    public static $listFields = ["id", "user_id", "ip", "created_at", "updated_at"];

    protected $casts = [];
}
