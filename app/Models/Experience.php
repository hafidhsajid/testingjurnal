<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'users_id',
        'jabatan',
        'jabatans_id',
        'perusahaan',
        'lokasi_perusahaan',
        'waktu_mulai',
        'waktu_selesai',
        'bidang',
        'deskripsi'
    ];
     protected $hidden = [

    ];
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }
    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'jabatans_id', 'id');
    }
}
