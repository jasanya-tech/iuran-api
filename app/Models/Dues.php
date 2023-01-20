<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dues extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "dues";
    protected $fillable = [
        "house_id",
        "dues_type_id",
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }

    public function dues_type()
    {
        return $this->belongsTo(Dues_type::class);
    }
}
