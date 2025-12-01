<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Categories;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $books = Book::with(['media'])->get();
        if (auth()->user()->role === 'seller') {
            $books = Book::with(['media'])->where('user_id', $user->id)->get();
        }

        $categories = Categories::all();

        return view('dashboard', compact('books', 'categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $books = Book::where('title', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->get();

        return view('dashboard', compact('books', 'query'));
    }

    public function detail($id): View
    {
        // $books = Book::findOrFail($id);
        $books = Book::with('approver')->findOrFail($id);
        $categories = Categories::all();
        $users = User::all();

        return view('detail', [
            'books' => $books,
            'categories' => $categories,
            'users' => $users,
        ]);
    }
}
