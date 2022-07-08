<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Prodi;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    public function create(){
        $prodis = Prodi::all();
        return view ('pages.portofolio.mahasiswa-create',[
            'prodis'=> $prodis
        ]);
    }
     public function store(Request $request)
    {
        $data = $request->all();

        $mahasiswa = Mahasiswa::create($data);

        return redirect()->route('portofolio.dashboard');
    }


}
