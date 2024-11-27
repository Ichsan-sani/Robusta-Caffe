<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::simplePaginate(10);
        return view('products.index', compact('products'));
    }

    public function showProduct()
    {
        $products = Product::all();
        return view('home', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'stock' => 'required|numeric|min:1',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric|min:1',
            'type' => 'required|string|max:255',
        ]);

        $imagePath = null;
        if ($request->hasFile('img')) {
            $imagePath = $request->file('img')->store('product', 'public');
        }

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
            'img' => $imagePath ? 'storage/' . $imagePath : null,
            'type' => $request->type,
        ]);

        return $product
            ? redirect()->route('products.index')->with('success', 'Berhasil menambahkan produk.')
            : redirect()->back()->with('failed', 'Gagal menambahkan produk.');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'stock' => 'required|numeric|min:1',
            'price' => 'required|numeric|min:1',
            'type' => 'required|string|max:255',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);

        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
            'type' => $request->type,
        ];

        if ($request->hasFile('img')) {
            if ($product->img) {
                Storage::disk('public')->delete(str_replace('storage/', '', $product->img));
            }

            $imagePath = $request->file('img')->store('product', 'public');
            $data['img'] = 'storage/' . $imagePath;
        }

        $proses = $product->update($data);

        return $proses
            ? redirect()->route('products.index')->with('success', 'Berhasil mengedit produk.')
            : redirect()->back()->with('failed', 'Gagal mengedit produk.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->img) {
            Storage::disk('public')->delete(str_replace('storage/', '', $product->img));
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Berhasil menghapus produk.');
    }
}
