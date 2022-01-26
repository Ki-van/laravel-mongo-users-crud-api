<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $connection = "mongodb";
    protected $fillable = ['name'];

    public function role() {
        return $this->belongsTo(Role::class);
    }
}
