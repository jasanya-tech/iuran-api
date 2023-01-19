<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dues_type extends Model
{
    use HasFactory, SoftDeletes;

    public function dues()
    {
        return $this->hasMany(Dues::class);
    }
}
