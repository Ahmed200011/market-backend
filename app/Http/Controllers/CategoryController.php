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
            'image' => 'required',
        ]);



        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $request->file('image')->getClientOriginalName();
            $image_name = uniqid() . $name;
            $storing = $file->move(public_path('dashboard/assets/images/categoryImage'), $image_name);
        }
        // dd($storing->getFilename());
        Category::create([
            'category_name' => $request->category_name,
            'parent_id' => $request->parent_id,
            'image' => $storing->getFilename(),
        ]);

        return redirect()->route(route: 'dashboard.Category.index')->with('success', 'Category created successfully.');
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
    public function edit($id)
    {
        // dd($id);
        $category = Category::find($id);
        return view('dashboarda.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // 'parent_id' => 'nullable|exists:categories,id',
        ]);

        // dd($request->hasFile('image'));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $name = $request->file('image')->getClientOriginalName();
            $image_name = uniqid() . $name;
            $storing = $file->move(public_path('dashboard/assets/images/categoryImage'), $image_name);
        }
        if ($category->image) {
            $imagePath = public_path('dashboard/assets/images/user_image/' . $category->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $category->update([
            'category_name' => $request->category_name,
            'image' => $storing->getFilename(),
            // 'parent_id' => $request->parent_id,
        ]);
        return redirect()->route(route: 'dashboard.Category.index')->with('success', 'Category updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        // dd($category);
        $category = Category::find($id);
        if ($category->image) {
            $imagePath = public_path('dashboard/assets/images/user_image/' . $category->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        if ($category->children()->count() > 0) {
            return redirect()->route('dashboard.Category.index')->with('error', 'Cannot delete category with subcategories.');
        }

        $category->delete();
        return redirect()->route('dashboard.Category.index')->with('success', 'Category deleted successfully.');
    }
}
