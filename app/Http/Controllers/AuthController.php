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
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'status' => StatusEnum::Active,
        ])) {
            $user = Auth::user();

            // Merge session cart into DB
            $cart = session()->get('cart', []);
            foreach ($cart as $item) {
                $user->carts()->create([
                    'product_id' => $item['product_id'],
                    'stock_id' => $item['stock_id'],
                    'quantity' => $item['quantity'],
                ]);
            }

            session()->forget('cart');

            return redirect()->route('home')->with('success', 'Welcome back, '.$user->name);
        }

        return redirect()->back()->withErrors([
            'email' => 'Invalid credentials or inactive account.',
        ]);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
