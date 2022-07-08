<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index(Request $request, $id)
    {
        $users = User::findOrFail($id);
        $products = Product::with(['galleries', 'user'])->latest()->where('users_id', $id)->get();
        $products2 = Product::with(['galleries', 'user'])->where('users_id', $id)->get();
        return view('pages.profile',[
            'users' => $users,
            'products_count' => $products->count(),
            'products' => $products,
            'products2' => $products2,
        ]);
    }

    public function detail(Request $request, $slug)         //untuk mengambil produk seusai kategori yang diinginkan
    {
        
    }
}
