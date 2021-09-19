<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(int $id): RedirectResponse
    {
        $product = Product::query()->findOrFail($id);

        $cart = session()->get('cart', []);

        $index = array_search($id, array_column($cart, 'id'));

        if ($index !== false) {
            $cart[$index]['quantity']++;

            session()->put('cart', $cart);

            return back()->with('success', 'Product added to cart successfully.');
        }

        array_push($cart, [
            'id' => $id,
            'name' => $product->getAttribute('name'),
            'price' => $product->price * (100 - $product->discount) / 100,
            'photo' => $product->getAttribute('image'),
            'quantity' => 1
        ]);

        session()->put('cart', $cart);

        return back()->with('success', 'Product added to cart successfully.');
    }

    public function checkout()
    {
        dd('Hello World.');
    }
}
