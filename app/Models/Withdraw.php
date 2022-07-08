<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'transaction_details_id',
        'total_withdraw',
        'name',
        'rekening',
        'bank',
        'status',
    ];

    protected $hidden = [
        
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    public function transactionDetails() {
        return $this->hasMany(TransactionDetail::class, 'id', 'transaction_details_id');
    }
}
