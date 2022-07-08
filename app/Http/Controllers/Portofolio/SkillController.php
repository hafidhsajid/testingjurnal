<?php

namespace App\Http\Controllers\Portofolio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Skill;

class SkillController extends Controller
{
    public function create(){
        $users = User::all();
        return view ('pages.portofolio.skill-create',[
            'users'=> $users
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->all();

        $skills = Skill::create($data);

        return redirect()->route('portofolio.dashboard');
    }
    public function destroy($id)
    {
        $item = Skill::findOrFail($id);
        $item->delete();

        return redirect()->route('transaction.index');
    }
}
