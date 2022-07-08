<?php

namespace App\Http\Controllers\Portofolio;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use Illuminate\Http\Request;
use App\Models\Jabatan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ExperiencesController extends Controller
{
    public function create(){
        $user = Auth::user();
        $jabatans = Jabatan::all();
         return view('pages.portofolio.experiences-create', [
            'user' => $user,
            'jabatans'=>$jabatans
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->all();

        $experiences = Experience::create($data);

        return redirect()->route('dashboard-experiences');
    }
    public function index()
    {                           
        // varible untuk menampilkan data di cart
        $experiences = Experience::with(['jabatan', 'user']) //megambil data relasi di bagian cart untuk product & user
                ->where('users_id', Auth::user()->id) //melihat cart bedasarkan user yang sedang aktif
                ->get();
        return view('pages.portofolio.dashboard-experiences', [
            'experiences' => $experiences,
        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Experience::findOrFail($id);
        $users = User::all();
        $jabatans = Jabatan::all();
        return view('pages.portofolio.experiences-edit',[
            'item' => $item,
            'users' => $users,
            'jabatans' => $jabatans,
        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        $item = Experience::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-experiences');
    }
    public function destroy($id)
    {
        $item = Experience::findOrFail($id);
        $item->delete();

        return redirect()->route('transaction.index');
    }

}
