<?php

namespace App\Http\Controllers\Portofolio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pendidikan;

class PendidikanController extends Controller
{
    public function create(){ //fungsi menambahkan riwayat pendidikan
        $users = User::all();
        return view ('pages.portofolio.pendidikan-create',[
            'users'=> $users
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->all();

        $pendidikans = Pendidikan::create($data);

        return redirect()->route('portofolio.dashboard');
    }
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item =Pendidikan::findOrFail($id);
        $users = User::all();
        return view('pages.portofolio.pendidikan-edit',[
            'item' => $item,
            'users' => $users
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

        $item =Pendidikan::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-kepanitiaan');
    }
    public function destroy($id)
    {
        $item = Pendidikan::findOrFail($id);
        $item->delete();

        return redirect()->route('transaction.index');
    }
}
