<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Position extends Model
{
    use HasFactory;

    protected $table = 'positions';

    protected $fillable = ["name", "company_id", "level"];

    public static $listFields = ["id", "name", "company_id", "level", "created_at", "updated_at"];

    protected $casts = [
        
    ];
}
