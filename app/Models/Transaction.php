<?php

namespace App\Models;

use App\Http\Controllers\Admin\UserController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'users_id',
        'insurace_price',
        'shipping_price',
        'total_price',
        'transaction_status',
        'code',
    ];

    protected $hidden = [

    ];

    public function user() {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

}
