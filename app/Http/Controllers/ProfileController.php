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
        $products = Product::with(['galleries', 'user'])->where('users_id', $id)->get();
        $sellTransactions = TransactionDetail::with(['transaction.user']) //memanggil data DB dan relasi di model
                            ->whereHas('product', function($product){ //mencari produk yang berhasil terjual
                                $product->where('users_id', Auth::user()->id); //mencari transaksi pada user yang sedang login
                            })->get();


        return view('pages.profile',[
            'users' => $users,
            'products_count' => $products->count(),
            'products' => $products,
            'sellTransactions' => $sellTransactions->count(),
        ]);
    }

    public function detail(Request $request, $slug)         //untuk mengambil produk seusai kategori yang diinginkan
    {
        
    }
}
