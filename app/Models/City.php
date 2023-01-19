<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'cities';
    protected $fillable = [
        'province_id',
        'city_name'
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
}
