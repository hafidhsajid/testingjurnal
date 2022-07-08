<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ListProductController extends Controller
{
     public function index()
    {
        $products = Product::with(['galleries'])->paginate(25);      //mengambil data product dengan relasi gelleries untuk mengambil gambar productnya

        return view('pages.listproduct',[
            'products' => $products,
        ]);
    }
}
