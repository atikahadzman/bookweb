<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BooksController extends Controller
{

    public function category()
    {
        return $this->belongsTo(Category::class, 'categories_id');
    }

    public function index(Request $request)
    {
        $user = $request->user();
        if ($user->role == 'seller' && $user->status != 1) {
            abort(403, 'Unauthorized access.');
        }

        $books = Book::with('media')->where('user_id', $user->id)->get();
        $categories = Categories::all();

        return view('books.index', compact('books', 'categories'));
    }

    public function store(Request $request)
    {
        $user = $request->user();
        
        $validated = $request->validate(
            [
                'title' => 'required|string|max:255',
                'categories_id' => 'required',
                'cover_image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
                'author' => 'required|string|max:255',
                'description' => 'required',
            ],
            [
                'isbn.unique' => 'This ISBN already exists in the system.',
            ]
        );

        // Handle image upload
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('cover_images', 'public');
        }

        $request->merge([
            'description' => ltrim($validated['description'])
        ]);

        $userId = $user->id;
        $isbn = 'ISBN-' . strtoupper(Str::random(10));

        $book = Book::create([
            'title' => $validated['title'],
            'user_id' => $user->id,
            'categories_id' => $validated['categories_id'],
            'author' => $validated['author'],
            'isbn' => $isbn,
            'description' => $validated['description'],
        ]);

        if ($request->hasFile('cover_image')) {
            $book->addMediaFromRequest('cover_image')
                ->toMediaCollection('cover_image');
        }

        return redirect()->route('books.index')->with('success', 'Book created successfully!');
    }

    public function edit($id): View
    {
        $books = Book::findOrFail($id);
        $categories = Categories::all();

        return view('books.edit', [
            'books' => $books,
            'categories' => $categories,
        ]);
    }

    public function update($id)
    {
        $book = Book::findOrFail($id);

        return redirect()->route('books.index')->with('success', 'Updated!');
    }

    public function remove($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'This book has been deleted.');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $books = Book::where('title', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->get();

        $categories = Categories::all();

        return view('books.index', compact('books', 'query', 'categories'));
    }

    public function status(Request $request, $id)
    {
        $user = $request->user();
        $book = Book::findOrFail($id);

        $book->status = $request->input('status');
        $book->updated_by = $user->id;
        $book->approved_at = now();
        $book->save();    

        $msg = 'Approved';
        if ($book->status == 11) {
            $msg = 'Rejected.';
        }

        return redirect()->route('detail', $book->id)->with('success', $msg);
    }
}
