<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $connection = "mongodb";
    protected $fillable = ['name'];

    public function users() {

        return $this->hasMany(User::class);
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class, 'role_permission')->withTimestamps();
    }

}
