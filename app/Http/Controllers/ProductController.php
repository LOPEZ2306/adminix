<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->merge([
            'price' => $this->parseColombianPrice($request->input('price'))
        ]);

        $request->validate([
            'product' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index')->with('success', 'Producto creado exitosamente.');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->merge([
            'price' => $this->parseColombianPrice($request->input('price'))
        ]);

        $request->validate([
            'product' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
        ]);

        $product->update($request->all());

        return redirect()->route('products.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado exitosamente.');
    }

    private function parseColombianPrice($price)
    {
        if (is_string($price)) {
            $price = preg_replace('/\.(?=\d{3}(?:,|$))/', '', $price);
            $price = str_replace(',', '.', $price);
        }

        return is_numeric($price) ? (float)$price : 0;
    }
}
