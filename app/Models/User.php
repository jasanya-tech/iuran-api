<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "users";
    protected $fillable = [
        'full_name',
        'email',
        'picture',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function house()
    {
    }
}
