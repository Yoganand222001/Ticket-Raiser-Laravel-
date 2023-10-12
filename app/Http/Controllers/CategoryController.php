<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
         Category::create([
             'category' => $request->validated('category-name')
         ]);

        session()->flash('work_done' , 'category created successfully');

         return redirect()->route('categories');
    }

    public function update(UpdateCategoryRequest $request)
    {
        Category::where('id', $request->validated('category'))
            ->update([
            'category' => $request->validated('category-rename')
            ]);

        session()->flash('work_done' , 'category edited successfully');

        return redirect()->route('categories');
    }

    public function destroy(Request $request)
    {
        if (!$request->delete_category)
            throw ValidationException::withMessages([
                'delete_category' => 'Must select one category to delete'
            ]);

        Category::where('id', $request->delete_category)
            ->delete();

        session()->flash('work_done' , 'category deleted successfully');

        return redirect()->route('categories');
    }
}
