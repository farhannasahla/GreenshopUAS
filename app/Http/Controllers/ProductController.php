<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
  public function index()
{
    $products = Product::select(
        'id',
        'category_id',
        'name',
        'price',
        'stock'
    )
    ->with('category:id,name')
    ->paginate(10);

    return view('products.index', compact('products'));
}
}