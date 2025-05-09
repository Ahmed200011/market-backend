<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormSubmitted;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {
        $Categories = Category::with('parent','children')->get();
        return view('front.pages.contact',compact('Categories'));
    }
    public function submit(Request $request)
    {
    //    dd($request->all());
       $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string',
    ]);
    Mail::to('am9695960@gmail.com')->send(new ContactFormSubmitted($validatedData));


    return redirect()->route('page.contact')->with('success', 'the message was sent successfully');


    }

}
