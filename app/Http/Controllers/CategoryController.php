<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $products = Product::with(['galleries'])->paginate(8);      //mengambil data product dengan relasi gelleries untuk mengambil gambar productnya
        $categories = Category::all();                  //mengambil data semuanya di table kategori

        return view('pages.category',[
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function detail(Request $request, $slug)         //untuk mengambil produk seusai kategori yang diinginkan
    {
        $categories = Category::all();      //mengambil semua data kategori
        $category = Category::where('slug', $slug)->firstOrFail();      //mengambil kategori berdasrkan nama slugnya untuk dipanggil 
        $products = Product::with(['galleries'])->where('categories_id', $category->id)->paginate(8); //mengambil data product bersama relasi gallery untuk dipangil berdasrakan category yang diingikan

        return view('pages.category',[
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
