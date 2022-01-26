<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $connection = "mongodb";

    public function users() {
        $database = app(User::class)->getConnection()->getDatabaseName();
        return $this->belongsToMany(User::class, $database."user_role", "role_id", "user_id");
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class)->withTimestamps();
    }
}
