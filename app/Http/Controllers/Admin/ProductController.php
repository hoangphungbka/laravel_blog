<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        $products = Product::with(['category', 'brand', 'color'])->orderByDesc('id')->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        $categories = Category::all(['id', 'name']);
        $brands = Brand::all(['id', 'name']);
        $colors = Color::all(['id', 'name']);
        $sizes = Size::all(['id', 'size']);

        return view('admin.products.create', compact('categories', 'brands', 'colors', 'sizes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $product = Product::query()->create($request->all());

        if ($fileUpload = $request->file('image')) {
            $filename = date('YmdHis') . '_' . $fileUpload->getClientOriginalName();
            $fileUpload->move(public_path('img/product'), $filename);

            $product->update(['image' => "/img/product/$filename"]);
        }

        $data = collect($request->input('sizes'))->combine($request->input('quantities'))
            ->map(function (int $quantity) { return ['quantity' => $quantity]; });

        $product->sizes()->sync($data);

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return bool
     * @throws \Exception
     */
    public function destroy(int $id): bool
    {
        $products = Product::query()->findOrFail($id);

        $products->sizes()->detach();
//        $products->reviews()->detach();
//        $products->favorites()->detach();

        return $products->delete();
    }
}
