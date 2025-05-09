<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(15);
        return view('dashboarda.product.all', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboarda.product.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $request->file('image')->getClientOriginalName();

            $file = Image::read($file);
            $resizedImage = $file->scale(height: 300, width: 248);


            $path = public_path('dashboard/assets/images/products');
            $image_name = uniqid() . $name;
            $resizedImage->save($path . '/' . $image_name);
            // $storing=$file->move(public_path('dashboard/assets/images/products'),$image_name);
            // dd($image_name);


        }

        $request->except('_token');
        Product::create([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'image' => $image_name
        ]);
        
        return redirect()->route('dashboard.product.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $old_category = Category::find($product->category_id);
        $categories = Category::all();
        return view('dashboarda.product.edit', compact('product', 'categories', 'old_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {

        $request->validate([
            'product_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'category_id' => 'exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $request->file('image')->getClientOriginalName();
            $image_name = uniqid() . $name;
            $storing = $file->move(public_path('dashboard/assets/images/products'), $image_name);
            $storing = $storing->getFilename();
        } else {
            $storing = $product->image;
        }
        if ($product->image) {
            $imagePath = public_path('dashboard/assets/images/products/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        if ($request->category_id) {
            $category_name = $request->category_id;
        } else {
            $category_name = $product->category_id;
        }
        $request->except('_token');

        $product->update([
            'product_name' => $request->product_name,
            'price' => $request->price,
            'description' => $request->description,
            'category_id' => $category_name,
            'image' => $storing
        ]);
        return redirect()->route('dashboard.product.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image) {
            $imagePath = public_path('dashboard/assets/images/products/' . $product->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        // unlink(public_path('dashboard/assets/images/products/' . $product->image));
        $product->delete();
        return redirect()->route('dashboard.product.index')->with('success', 'Product deleted successfully');
    }
}
