<?php

namespace App\Http\Controllers;

use App\Models\User; // Import the User model

class UserController extends Controller
{
    // Method to get all users
    public function index()
    {
        // Retrieve all users from the database using Eloquent
        $users = User::all(); // This fetches all rows from the 'users' table

        // Return the users data to a view (optional, can be an API response as well)
        return view('users.index', compact('users')); // Passing the users to a view
    }

    // Method to get a single user by ID
    public function show($id)
    {
        // Retrieve a user by ID using Eloquent
        $user = User::find($id); // This fetches a user by its ID

        // Return the user data to a view (optional, can be an API response as well)
        return view('users.show', compact('user')); // Passing the user to a view
    }
}
