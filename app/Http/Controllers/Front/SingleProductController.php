<?php

namespace App\Http\Controllers\front;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;

class SingleProductController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $product = Product::findOrFail($request->id);
        $products = Product::where('category_id', $product->category_id)->get();
        // dd($product);
        $Categories = Category::with('children')->get();
        return view('front.pages.singleProduct', compact('product', 'Categories', 'products'));
    }
    public function addToCart(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);
        $data = $request->except('_token');
        // dd($data);
        if (Auth()->user()) {
            Cart::updateOrCreate(
                [
                    'user_id' => Auth()->user()->id,
                    'product_id' => $data['product_id'],
                    'price' => $data['price']
                ],
                [
                    'quantity' => $data['quantity'],
                    'total' => $data['price'] * $data['quantity'],
                ]

            );
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        } else {
            return redirect()->back()->with('filed', 'please login to add product to cart');
        }
    }
}
