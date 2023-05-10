<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Emodule extends Model
{
    use HasFactory;

    protected $table = 'emodules';

    protected $fillable = ["name", "label", "slug", "icon", "permission"];

    public static $listFields = ["id", "name", "label", "slug", "icon", "permission", "created_at", "updated_at"];

    protected $casts = [
        
    ];
}
