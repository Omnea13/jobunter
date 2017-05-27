<?php

namespace App\Http\Controllers;

use App\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $active = 'category';
        return view('category.index',compact('categories','active'));
    }

    public function addNewCategory(Request $request)
    {
        $category       = new Category;
        $category->name = $request->name;
        $category->save();

        if($category->save()) {
            return response()->json(['success' => true]);
        }
    }

    public function editCategory(Request $id )
    {
        $category = Category::find($id);
        return response()->json($category, 200);

    }

    public function updateCategory(Request $request)
    {
        $category = Category::find($request->id);
        $category->name = $request->name;

        $category->save();

        if($category->save()) {
            return response()->json(['success' => true]);
        }
    }

    public function deleteCategory(Request $id)
    {
        Category::find($id)->delete();
    }
}
