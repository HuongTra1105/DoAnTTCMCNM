<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;

class HomeController extends Controller
{
    public function index()
    {
     $categories = Category::whereNull('DanhmucCha')->get();

        $products = Products::with('mainImage')
            ->where('Trang_thai', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(8);
        return view('index', compact('categories', 'products'));
    }
    public function search(Request $request)
    {
        $categories = Category::whereNull('DanhmucCha')->get();

        $products = Products::with('mainImage') // QUAN TRỌNG
            ->where('Tensanpham', 'like', '%' . $request->q . '%')
            ->paginate(12)
            ->appends(['q' => $request->q]);
        return view('index', compact('categories', 'products'));
    }   


}
