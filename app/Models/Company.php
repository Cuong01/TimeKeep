<?php

namespace App\Models;

use App\Casts\LogoCast;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Casts\JsonCast;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = ["name", "slug", "teaser", "logo", "address", "phone", "parent_id", "active"];

    public static $listFields = ["id", "name", "slug", "teaser", "logo", "address", "phone", "parent_id", "active", "created_at", "updated_at"];

    public function departments(){
        return $this->hasMany(Department::class,"company_id","id");
    }
    public function positions(){
        return $this->hasMany(Position::class,"company_id","id");
    }
    public function users(){
        return $this->hasMany(User::class,"company_id","id");
    }
    public function parent(){
        return $this->belongsTo(Company::class,"parent_id","id");
    }
    public function children(){
        return $this->hasMany(Company::class,"parent_id","id");
    }
    protected $casts = [
        "logo" => LogoCast::class,

    ];
}
