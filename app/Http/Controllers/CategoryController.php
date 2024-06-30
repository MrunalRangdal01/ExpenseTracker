<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    function showCategory(Request $request)
    {
        $categories = Category::where('is_active', 1)->get();
        return view('category', get_defined_vars('categories'));
    }

    function addCategory(Request $request)
    {
        $request->validate([
            'cat_name' => 'required|string|max:255',
        ]);

        $data = [
            'category_name' => $request->cat_name,
        ];
        $category = new Category;
        $category->category_name = $data['category_name'];
        if ($category->save()) {
            session()->flash('successMsg', 'Category successfully added!');
        } else {
            session()->flash('errorMsg', 'Something went wrong!');
        }
        return redirect()->route('category');
    }

    function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->is_active = 0;
        $category->save();
        session()->flash('errorMsg', 'Category successfully deleted!');
        return redirect()->route('category');
    }

    function updateCategory(Request $request)
    {
        $request->validate([
            'cat_name' => 'required|string|max:255',
        ]);
        $category = Category::findOrFail($request->id);
        $category->category_name = $request->input('cat_name');
        $category->save();
        session()->flash('successMsg', 'Category successfully updated!');
        return redirect()->route('category');
    }
}
