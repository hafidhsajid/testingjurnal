<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    protected $fillable = [
        'nama',
        'jabatan',
        'divisi',
        'waktu_mulai',
        'waktu_selesai',
        'deskripsi',
        'users_id'
    ];
     protected $hidden = [

    ];
    public function user() {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
