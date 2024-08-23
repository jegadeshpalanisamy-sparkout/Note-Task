<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display the user's dashboard with their notes.
     *
     * @return \Illuminate\View\View
     */
    public function home(){
        $notes = Note::where('user_id', auth()->id())->get();
        return view('dashboard',compact('notes'));
    }

    /**
     * Authenticate and log the user in.
     *
     * @param  \App\Http\Requests\LoginRequest  $request  The request containing user credentials.
     * @return \Illuminate\Http\RedirectResponse
    */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('dashboard')->with('success', 'You are logged in!');
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    //logout the auth user 
    public function logout(){
        auth()->logout();
        return redirect()->route('login');
    }
}
