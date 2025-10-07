<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function __invoke(Request $request)
    {
        $userData = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required','unique:users', 'email'],
            'password' => ['required','min:8','confirmed'],
        ]);

        $user = User::create($userData);

        Auth::Login($user);
        return redirect()->route('dashboard');
    }
}
