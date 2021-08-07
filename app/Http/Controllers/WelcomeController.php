<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $products = Product::query()->latest('updated_at')->limit(8)->get();

        return view('welcome', compact('products'));
    }
}
