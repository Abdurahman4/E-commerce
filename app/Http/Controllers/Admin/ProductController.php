<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::orderBy('created_at','desc')->paginate(10);
        return view('admin.products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'=> 'required|string|max:255',
            'price'=> 'required|numeric',
            'description'=> 'nullable|string',
            'stock' => 'nullable|integer',
            'image' => 'nullable|image|max:2048',
            'extra_details' => 'nullable|string',

        ]);
        if($request->hasFile('image')){
            $path = $request->file('image')->store('images','public');
            $data['image']= $path;
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success','Product created successfully.');
    }


    public function edit(Product $product)
{
    // فقط ترجع صفحة التعديل
    return view('admin.products.edit', compact('product'));
}

public function update(Request $request, Product $product)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'price'=> 'required|numeric',
        'description' => 'nullable|string',
        'stock' => 'required|integer',
        'image' => 'nullable|image|max:2048',
        'extra_details' => 'nullable|string',
    ]);

    if ($request->hasFile('image')) {
        $path = $request->file('image')->store('images', 'public');
        $data['image'] = $path;
    }

    $product->update($data);

    return redirect()->route('admin.products.index')->with('success', 'Product updated.');
}
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success','Product deleted.');
    } 
}
