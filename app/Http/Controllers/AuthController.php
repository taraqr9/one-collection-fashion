<?php

namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\User\RegistrationRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
    public function loginView(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('user.auth.login');
    }

    public function registrationView(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('user.auth.register');
    }

    public function registration(RegistrationRequest $request): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        $user = User::create($request->validated());

        if ($user && Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => StatusEnum::Active])) {
            return redirect()->route('home')->with('success', 'Registration completed successfully!');
        }

        return redirect()->back()->with('error', 'Registration failed!');
    }

    public function login(Request $request): RedirectResponse
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => StatusEnum::Active])) {
            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['email' => $request->email]);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
