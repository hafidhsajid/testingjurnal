<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class testcontroller extends Controller
{
    //
    public function login(Request $request)
    {
        // Auth::attempt(['email' => request('email'), 'password' => request('password')]);
        dd(Auth::check());
        dd(request());
    }
}
