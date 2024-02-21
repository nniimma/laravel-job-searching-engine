<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoginRequest;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create()
    {
        return view('users.register');
    }

    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        $user = User::create($validated);

        auth()->login($user);

        return redirect()->route('listings.index')->with('message', 'User created and logged in.');
    }

    public function showLogin()
    {
        return view('users.login');
    }

    public function postLogin(StoreLoginRequest $request)
    {
        $validated = $request->validated();

        if (auth()->attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->route('listings.index')->with('message', 'You are logged in.');
        }

        //! this is for when there is no such email to say invalid credentials
        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('listings.index')->with('message', 'You have been logged out.');
    }
}
