<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SellerController extends Controller
{
    public function index()
    {
        $users = User::where('role', 'seller')->get();

        return view('seller.index', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:255|unique:users,phone',
                'id_number' => 'required|string|max:255|unique:users,id_number',
                'role' => 'required|string|max:255',
                'email' =>  'required|string|max:255|unique:users,email',
            ],
            [
                'id_number.unique' => 'This ID number already exists in the system.',
                'phone.unique' => 'This phone number already exists in the system.',
                'email.unique' => 'This email already exists in the system.',
            ]
        );


        $role = $validated['role'] ?? 'seller';
        $password = $validated['name'] .''. '123@';

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'id_number' => $validated['id_number'],
            'role' => $role,
            'password' =>  Hash::make($password),
        ]);

        return redirect()->route('seller.index')->with('success', 'Seller created successfully!');
    }

    public function edit($id): View
    {
        $users = User::find($id);

        return view('seller.edit', [
            'users' => $users,
        ]);
    }

    public function update($id)
    {
        $users = User::findOrFail($id);

        return redirect()->route('seller.index')->with('success', 'Updated.');
    }

    public function remove($id)
    {
        $users = User::findOrFail($id);
        $users->delete();

        return redirect()->route('seller.index')->with('success', 'Removed.');
    }

    public function status($id)
    {
        $users = User::findOrFail($id);
        $users->status = 1;
        $users->save();

        return redirect()->route('seller.index')->with('success', 'Approved.');
    }
}
