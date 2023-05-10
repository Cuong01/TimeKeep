<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = ["name", "company_id", "parent_id", "root_id"];

    public static $listFields = ["id", "name", "company_id", "parent_id", "root_id", "created_at", "updated_at"];

    protected $casts = [
        
    ];
}
