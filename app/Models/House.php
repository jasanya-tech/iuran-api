<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class House extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'houses';
    protected $fillable = [
        'house_name',
        'picture',
        'unit_cars',
        'unit_motorcycle',
        'address',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dues()
    {
        return $this->hasMany(Dues::class);
    }
}
