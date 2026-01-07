<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Products;
class CategoryController extends Controller
{
    public function show($param)
    {
        if (is_numeric($param)) {
            $category = Category::findOrFail($param);
        }
        else {
            $category = Category::where('slug', $param)->firstOrFail();
        }
        if ($category->DanhmucCha == null) {
            $subCategories = Category::where('DanhmucCha', $category->id)->get();
            $categoryIds = $subCategories->pluck('id')->toArray();
            $categoryIds[] = $category->id;
        } else {
            $subCategories = Category::where('DanhmucCha', $category->DanhmucCha)->get();
            $categoryIds = [$category->id];
        }
    $products = Products::whereIn('Madanhmuc', $categoryIds)
        ->where('Trang_thai', 1)
        ->paginate(12);
    return view('category', compact(
        'category',
        'subCategories',
        'products'
        ));
    }
}
