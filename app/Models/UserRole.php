<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\HybridRelations;

class UserRole extends Model
{
    use HasFactory, HybridRelations;

    protected $table = 'user_role';
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
