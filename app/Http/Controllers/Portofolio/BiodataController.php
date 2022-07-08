<?php

namespace App\Http\Controllers\portofolio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prodi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'nim' => 'nullable|string|max:255',
            'email' => 'required','string','email','max:255',Rule::unique('users')->ignore($request->id),
            'tempat_lahir' => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
            'address_one' => 'nullable|string',
            'alamat_solo' => 'nullable|string',
            'angkatan' => 'nullable|integer',
            'fakultas' => 'nullable|string|max:255',
            'deskripsi' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response(['errors'=>$validator->errors()->all()], 422);
        }

        $user = User::where('id', $request->users_id)->first();

        $user['name'] = $request['name'];
        $user['nim'] = $request['nim'];
        $user['email'] = $request['email'];
        $user['tempat_lahir'] = $request['tempat_lahir'];
        $user['tanggal_lahir'] = $request['tanggal_lahir'];
        $user['address_one'] = $request['address_one'];
        $user['alamat_solo'] = $request['alamat_solo'];
        $user['angkatan'] = $request['angkatan'];
        $user['fakultas'] = $request['fakultas'];
        $user['deskripsi'] = $request['deskripsi'];
        $user['updated_at'] = Carbon::now();

        $user->save();

        return view('pages.portofolio.biodata', [
            'user' => $user
        ]);
    }

    public function index() {
        $user = Auth::user();
        return view('pages.portofolio.biodata', [
            'user' => $user
        ]);
    }
    
}
