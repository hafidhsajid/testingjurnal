<?php

namespace App\Http\Controllers\portofolio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prodi;
use Illuminate\Support\Facades\Auth;

class BiodataController extends Controller
{
    public function create(){
        $user = Auth::user();
        $prodis = Prodi::all();
         return view('pages.portofolio.biodata-create', [
            'user' => $user,
            'prodis'=>$prodis
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->all();

        $user = User::create($data);

        return redirect()->route('portofolio.dashboard');
    }

     
    
}
