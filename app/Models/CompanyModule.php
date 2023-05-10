<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CompanyModule extends Model
{
    use HasFactory;

    protected $table = 'company_modules';

    protected $fillable = ["company_id", "module_id"];

    public static $listFields = ["company_id", "module_id", "created_at", "updated_at"];

    protected $casts = [
        
    ];
}
