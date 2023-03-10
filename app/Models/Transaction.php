<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'transactions';
    protected  $fillable = [
        'invoice',
        'total_dues',
        'house_id',
        'proof_payment',
        'confirmation_date',
        'status'
    ];

    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
