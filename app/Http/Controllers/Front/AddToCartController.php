<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddToCartController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request) {
        // Validate the request
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);


        // Add the product to the cart
        // $cart = session()->get('cart', []);

        // if (isset($cart[$request->product_id])) {
        //     $cart[$request->product_id]['quantity'] += $request->quantity;
        // } else {
        //     $cart[$request->product_id] = [
        //         "name" => $request->name,
        //         "quantity" => $request->quantity,
        //         "price" => $request->price,
        //         "image" => $request->image,
        //     ];
        // }

        // session()->put('cart', $cart);

        // return route('page.shop.index')->with('success', 'Product added to cart successfully!');
        return redirect()->route('page.singleProduct')->with('success', 'Product added to cart successfully!');
        // return redirect()->back()->with('success', 'Product added to cart successfully!');

    }
}
