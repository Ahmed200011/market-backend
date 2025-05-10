<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Categories = Category::with(['parent', 'children'])->get();
        if (Auth::user()) {
            $usersAddresses = UserAddress::where('user_id', auth()->user()->id)->get();
        }
        $cart=Cart::where('user_id', auth()->user()->id)->get();
        $products = Product::all();

        return view('front.pages.payment', compact('Categories', 'usersAddresses', 'cart', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:15',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'payment' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:10',
            'country' => 'required|string|max:255',
        ]);
        UserAddress::updateOrCreate([
            'user_id' => auth()->user()->id,
        ], [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'country' => $request->country,
            'city' => $request->city,
            'state' => $request->state,
            'zip_code' => $request->zip_code,
            'payment' => $request->payment,
        ]);
        return redirect()->route('page.payment.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(UserAddress $userAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserAddress $userAddress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserAddress $userAddress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserAddress $userAddress)
    {
        //
    }
}
