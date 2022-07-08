<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendidikan extends Model
{
    protected $fillable = [
        'jenjang',
        'nama',
        'jurusan',
        'masuk',
        'keluar',
        'users_id'
    ];
     protected $hidden = [

    ];
    public function user() {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
