<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductViewController extends Controller
{
    /**
     * Muestra la lista de productos.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    /**
     * Muestra el formulario para crear un producto.
     */
    public function create()
    {
        $categories = Product::getCategories(); // Obtiene las categorias del enum
        return view('products.create', compact('categories'));
    }

    /**
     * Almacena un producto en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:' . implode(',', Product::getCategories()),
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'weight' => 'nullable|numeric|min:0',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validatedData);

        return redirect()->route('products.index')->with('success', 'Producto creado correctamente.');
    }

    /**
     * Muestra el formulario para editar un producto.
     */
    public function edit(Product $product)
    {
        $categories = Product::getCategories();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Actualiza un producto en la base de datos.
     */
    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'type' => 'required|in:' . implode(',', Product::getCategories()),
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'weight' => 'nullable|numeric|min:0',
            'image' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validatedData);

        return redirect()->route('products.index')->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Elimina un producto de la base de datos.
     */
    public function destroy(Product $product)
    {
        // Elimina la imagen del producto, si existe
        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
    }
}
