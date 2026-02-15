<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);


        if (Auth::attempt($credentials)) {

            // 🔹 session yaratish (WEB uchun shart)
            $request->session()->regenerate();

            $user = Auth::user();

            // 🔹 Agar API bo‘lsa → token qaytar
            if ($request->expectsJson()) {
                $token = $user->createToken('auth_user')->plainTextToken;
                return response()->json(['token' => $token]);
            }

            // 🔹 Agar brauzer bo‘lsa → sahifaga kiritsin
            return redirect()->route('main'); // yoki posts.index
        }

        return back()->withErrors([
            'email' => 'Email yoki parol xato'
        ]);

        /*  if (Auth::attempt($credentials)) {
             $user = User::query()->where('email', $request->email)->first();

             $token = $user->createToken('auth_user')->plainTextToken;

             return response()->json(['token' =>$token]);
         } */

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function register_store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);
        $user->roles()->attach(3);

        auth()->login($user);

        return redirect()->route('main');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
