<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Categories::all();

        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'category' => 'required|string|max:255|unique:categories,category',
                'description' => 'required|string|max:255',
            ],
            [
                'categories.unique' => 'This category already exists in the system.',
            ]
        );

        $categories = Categories::create([
            'category' => $validated['category'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('categories.index')->with('success', 'Category created successfully!');
    }

    public function edit($id): View
    {
        $categories = Categories::findOrFail($id);

        return view('categories.edit', [
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $categories = Categories::findOrFail($id);
        $categories->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully');
    }

    public function remove($id)
    {
        $categories = Categories::findOrFail($id);
        $categories->delete();

        return redirect()->route('categories.index')->with('success', 'Category removed successfully!');
    }
}
