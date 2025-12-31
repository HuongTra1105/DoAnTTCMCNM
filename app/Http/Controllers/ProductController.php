<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;

use App\Models\Products;
use App\Models\Choice;
class ProductController extends Controller
{
    public function show($id)
    {
        $product = Products::with('mainImage')->findOrFail($id);
        $colors = collect();
        $sizes  = collect();

    if ($product->options) {
        $colors = $product->options->pluck('mau')->filter()->unique();
        $sizes  = $product->options->pluck('size')->filter()->unique();
    }
    $options = Choice::where('Masanpham', $id)->get();

    return view('product', compact('product', 'options'));
    }
}
