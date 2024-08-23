<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Mail\UserRegisteredMail;
use App\Models\User;
use App\Notifications\RegisterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SignUpController extends Controller
{
    use Notifiable;
    public function signUp(){
        return view('signup');
    }

    /**
     * Store a newly registered user in the database.
     * @param  \App\Http\Requests\StoreUserRequest  $request  The request containing validated user data.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreUserRequest $request)
    {
        // Validate the request data
        $validated = $request->validated();

        // Create a new user record
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'], // Save phone number
        ]);
        // $user->notify(new RegisterMail());

        Mail::to($user->email)->queue(new UserRegisteredMail($user));
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'User registered successfully.');
    }
}
