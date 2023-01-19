<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role_user extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "role_users";
    protected $fillable = [
        "role_name",
        "access"
    ];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
