<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'judul',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'deskripsi',
        'users_id',
    ];

    protected $hidden = [

    ];
}
