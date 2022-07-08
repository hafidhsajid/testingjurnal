<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = [
        'jenis',
        'lembaga',
        'tanggal',
        'tanggal_expired',
        'no_sertifikat',
        'users_id',
    ];

    protected $hidden = [

    ];
}
