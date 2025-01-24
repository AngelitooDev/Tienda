<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductControllerApi extends Controller
{
    /**
     * Lista todos los productos.
     */
    public function index()
    {
        // Devuelve todos los productos en formato JSON
        return response()->json(Product::all(), 200);
    }

    /**
     * Muestra un producto específico.
     */
    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        return response()->json($product, 200);
    }

    /**
     * Crea un nuevo producto.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'type' => 'required|in:Armas cortas,Cuchillos,Armas largas',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'weight' => 'nullable|numeric|min:0',
            'image' => 'nullable|url|max:255', // Ahora solo aceptamos URL para la imagen
        ]);

        // Crear el producto
        $product = Product::create($validatedData);

        // Devolver el producto creado con un código 201 (creado)
        return response()->json($product, 201);
    }

    /**
     * Actualiza un producto existente.
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        // Validar los datos de entrada
        $validatedData = $request->validate([
            'type' => 'nullable|in:Armas cortas,Cuchillos,Armas largas',
            'name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'stock' => 'nullable|integer|min:0',
            'weight' => 'nullable|numeric|min:0',
            'image' => 'nullable|url|max:255', // Imagen por URL
        ]);

        // Actualizar el producto con los datos validados
        $product->update($validatedData);

        return response()->json($product, 200);
    }

    /**
     * Elimina un producto.
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $product->delete();

        return response()->json(['message' => 'Producto eliminado correctamente'], 200);
    }
}
