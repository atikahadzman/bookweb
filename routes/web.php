<?php

use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/books', function () {
    return view('books');
});

Route::get('/categories', function () {
    return view('categories');
})->middleware('role:admin');

Route::middleware('role:admin')->group(function () {
    // categories management
    Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoriesController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoriesController::class, 'update'])->name('categories.update');
    Route::get('/categories/{id}/remove', [CategoriesController::class, 'remove'])->name('categories.remove');

    // seller management
    Route::get('/seller', [SellerController::class, 'index'])->name('seller.index');
    Route::post('/seller', [SellerController::class, 'store'])->name('seller.store');
    Route::get('/seller/{id}/edit', [SellerController::class, 'edit'])->name('seller.edit');
    Route::put('/seller/{id}/update', [SellerController::class, 'update'])->name('seller.update');
    Route::put('/seller/{id}/status', [SellerController::class, 'status'])->name('seller.status');
    Route::get('/seller/{id}/remove', [SellerController::class, 'remove'])->name('seller.remove');
});

// books management
Route::get('/books', [BooksController::class, 'index'])->name('books.index');
Route::post('/books', [BooksController::class, 'store'])->name('books.store');
Route::put('/books/{id}/status', [BooksController::class, 'status'])->name('books.status');
Route::get('/books', [BooksController::class, 'index'])->name('books.index');
Route::get('/books/{id}/edit', [BooksController::class, 'edit'])->name('books.edit');
Route::put('/books/{id}', [BooksController::class, 'update'])->name('books.update');
Route::get('/books/{id}/remove', [BooksController::class, 'remove'])->name('books.remove');

// search
Route::get('/books/search', [DashboardController::class, 'search'])->name('books.search');
Route::get('/books/search', [BooksController::class, 'search'])->name('books.search');

Route::get('/dashboard/{id}/detail', [DashboardController::class, 'detail'])->name('detail');


require __DIR__.'/auth.php';
