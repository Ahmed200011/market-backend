<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {


        //the old code
        // // dd($request->all());
        // if ($request->select != null) {
        //     $products = Product::when($request->search, function ($model, $value) use ($request) {

        //         if ($request->select == 0) {
        //             $model->where('product_name', 'like', "%$value%")->paginate(18);;
        //         } else {
        //             $model->where('category_id ', $request->select)
        //             ->where('product_name', 'like', "%$value%")->paginate(18);
        //         }
        //     });
        // }

        // elseif ($request->hasAny([0, 100, 200, 400, 1000, 1500, 2000, 3000])) {
        //     $products = Product::when([$request], function ($model, $value) use ($request) {
        //         if ($request->has('0') != null) {
        //             return  $model->where('price', '>', 0)->paginate(18);
        //         } elseif ($request->has('100') != null) {
        //             return  $model->where('price', '<=', 100)->paginate(18);
        //         } elseif ($request->has('200') != null) {
        //             return  $model->where([['price', '>', 100], ['price', '<=', 200]])->paginate(18);
        //         } elseif ($request->has('400')!= null) {
        //             return  $model->where([['price', '>', 300], ['price', '<=', 400]])->paginate(18);
        //         } elseif ($request->has('1000') != null) {
        //             return  $model->where([['price', '>', 500], ['price', '<=', 1000]])->paginate(18);
        //         } elseif ($request->has('1500') != null) {
        //             return  $model->where([['price', '>', 1000], ['price', '<=', 1500]])->paginate(18);
        //         } elseif ($request->has('2000')!= null) {
        //             return  $model->where([['price', '>', 1500], ['price', '<=', 2000]])->paginate(18);
        //         } elseif ($request->has('3000') != null) {
        //             return  $model->where([['price', '>', 2000], ['price', '<=', 3000]])->paginate(18);
        //         } else {
        //             $model->paginate(18);
        //         }
        //     });
        // } else {
        //     // dd('aaaaaa');
        //     $products = Product::paginate(18);
        // }
        // $products =  $products;   // $products = Product::with('category')->paginate(18);



        $ProductQ = Product::query();
        if ($request->select != null) {
            if ($request->select == 0) {
                $ProductQ->where('product_name', 'like', "%$request->search%");
            } else {
                $ProductQ->where('category_id', $request->select)
                    ->where('product_name', 'like', "%$request->search%");
            }
        }

        if ($request->has('0')) {
            $ProductQ->where('price', '>', 0);
        } elseif ($request->has('100')) {
            $ProductQ->where('price', '<=', 100);
        } elseif ($request->has('200')) {
            $ProductQ->where([['price', '>', 100], ['price', '<=', 200]]);
        } elseif ($request->has('400')) {
            $ProductQ->where([['price', '>', 300], ['price', '<=', 400]]);
        } elseif ($request->has('1000')) {
            $ProductQ->where([['price', '>', 500], ['price', '<=', 1000]]);
        } elseif ($request->has('1500')) {
            $ProductQ->where([['price', '>', 1000], ['price', '<=', 1500]]);
        } elseif ($request->has('2000')) {
            $ProductQ->where([['price', '>', 1500], ['price', '<=', 2000]]);
        } elseif ($request->has('3000')) {
            $ProductQ->where([['price', '>', 2000], ['price', '<=', 3000]]);
        }

        $products = $ProductQ->paginate(18);
        $Categories = Category::with(['parent', 'children'])->get();
        return view('front.pages.shop', compact('products', 'Categories'));
    }
}
