<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kepanitiaan extends Model
{
    protected $fillable = [
        'users_id',
        'penyelenggara',
        'nama_acara',
        'nama_jabatan',
        'divisi',
        'waktu_mulai',
        'waktu_selesai',
        'lokasi',
        'deskripsi'
    ];
     protected $hidden = [

    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
}
