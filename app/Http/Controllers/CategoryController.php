<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with('parent')->paginate(5);
        return view('dashboarda.category.all', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parents = Category::with('parent')->get();
        return view('dashboarda.category.add', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        Category::create($request->all());

        return redirect()->route('dashboard.Category.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        dd($category->id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $category = Category::find($id);
        if ($category->children()->count() > 0) {
            return redirect()->route('dashboard.Category.index')->with('error', 'Cannot delete category with subcategories.');
        }

        $category->delete();
        return redirect()->route('dashboard.Category.index')->with('success', 'Category deleted successfully.');
    }
}
