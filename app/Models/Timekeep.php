<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timekeep extends Model
{
    use HasFactory;

    protected $table = 'timekeeps';

    protected $fillable = ["user_id", "time", "company_id", "status", "note"];

    public static $listFields = ["id", "user_id", "time", "company_id", "status", "note", "created_at", "updated_at"];

    protected $casts = [];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
