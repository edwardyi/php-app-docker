<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() 
    {
        return Product::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'slug' => 'required|string',
            'description' => 'string',
            'price' => 'required|numeric',
        ]);

        return Product::create($data);
    }

    public function show($id)
    {
        return Product::find($id);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $result = $product->update($request->all());

        return $product;
    }

    public function destroy($id)
    {
        Product::destroy($id);
    }

    public function search($name)
    {
        return Product::where('name', 'like', '%'.$name.'%')->get();
    }
}
