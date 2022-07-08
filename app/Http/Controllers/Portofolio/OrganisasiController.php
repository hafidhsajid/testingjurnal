<?php

namespace App\Http\Controllers\Portofolio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Organisasi;
use App\Models\User;

class OrganisasiController extends Controller
{
    public function create(){
        $users = User::all();
        return view ('pages.portofolio.organisasi-create',[
            'users'=> $users
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->all();

        $organisasis = Organisasi::create($data);

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
        $item = Organisasi::findOrFail($id);
        $users = User::all();
        return view('pages.portofolio.organisasi-edit',[
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

        $item = Organisasi::findOrFail($id);

        $item->update($data);

        return redirect()->route('dashboard-kepanitiaan');
    }
    public function destroy($id)
    {
        $item = Organisasi::findOrFail($id);
        $item->delete();

        return redirect()->route('transaction.index');
    }
}
