<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $products = Product::query()->latest('updated_at')->limit(8)->get();

        return view('welcome', compact('products'));
    }

    public function category(Request $request)
    {
        $perPage = $request->query('per_page', 9);
        $sortField = $request->query('sort', 'id');

        $categories = Category::query()->withCount('products')->get();
        $brands = Brand::query()->withCount('products')->get();
        $colors = Color::query()->withCount('products')->get();

        $products = Product::query()->selectRaw('id, name, image, price, discount, price * discount / 100 as calc_price')
            ->orderByDesc($sortField)->paginate($perPage)->appends(['per_page' => $perPage, 'sort' => $sortField]);

        return view('category', compact('categories', 'brands', 'colors', 'products', 'perPage', 'sortField'));
    }

    public function show($id)
    {
        $product = Product::with('category', 'availableSizes')->findOrFail($id);

        return view('product', compact('product'));
    }
}
