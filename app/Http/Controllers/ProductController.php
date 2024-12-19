<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class ProductController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            new Middleware('auth:sanctum', except: ['index', 'show'])
        ];
    }

    public function index()
    {
        return Product::with('user')->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category_name' => 'required',
            'description' => 'required|max:255',
            'datetime' => 'required'
        ]);

        $product = $request->user()->products()->create($validated);

        return $product;
    }

    public function show(Product $product)
    {
        return $product;
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'category_name' => 'required',
            'description' => 'required|max:255',
            'datetime' => 'required'
        ]);

        $product->update($validated);

        return $product;
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json(['message' => "The product {$product->name} was deleted"]);
    }
}
