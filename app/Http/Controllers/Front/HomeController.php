<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // Mail::to('am9695960@email.com')->send(new WelcomeMail(Auth::user()));
        $Categories = Category::with(['parent', 'children'])->get();
        $featuredProducts = Product::with('category')->inRandomOrder()->take(8)->get();
        $latestProducts = Product::with('category')->inRandomOrder()->skip(8)->take(8)->get();
    
        // $featuredProducts=Product::with('category')->where('status',1)->where('featured',1)->latest()->take(10)->get();
        // $bestSellingProducts=Product::with('category')->where('status',1)->where('best_selling',1)->latest()->take(10)->get();
        // $specialProducts=Product::with('category')->where('status',1)->where('special',1)->latest()->take(10)->get();
        // $hotDealsProducts=Product::with('category')->where('status',1)->where('hot_deals',1)->latest()->take(10)->get();
        // $topRatedProducts=Product::with('category')->where('status',1)->where('top_rated',1)->latest()->take(10)->get();
        // $trendingProducts=Product::with('category')->where('status',1)->where('trending',1)->latest()->take(10)->get();
        return view('front.pages.home', compact(['Categories', 'featuredProducts', 'latestProducts']));
    }
}
