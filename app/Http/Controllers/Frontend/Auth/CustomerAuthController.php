<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
class CustomerAuthController extends Controller
{
    public function registerForm()
    {
        return view('user.register');
    }

    public function loginForm()
    {
        return view('user.login');
    }

    public function register(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => ['required', 'max:100', 'regex:/^[A-Za-z\s]+$/'],
                'email' => ['required', 'email', 'unique:customers,email'],
                'mobile' => ['required', 'regex:/^[6-9]\d{9}$/', 'unique:customers,mobile'],
                'alternate_mobile' => ['required', 'regex:/^[6-9]\d{9}$/', 'different:mobile'],
                'password' => ['required', 'min:8', 'confirmed'],
            ],
            [
                'name.regex' => 'Name should contain only letters.',
                'mobile.regex' => 'Enter a valid Indian mobile number.',
                'alternate_mobile.regex' => 'Enter a valid alternate mobile number.',
                'alternate_mobile.different' => 'Alternate number must be different from mobile number.',
                'password.confirmed' => 'Password and confirm password do not match.',
            ]
        );
        $customer = Customer::create($validated);

        Auth::guard('customer')->login($customer);

        return redirect()
            ->route('user.login')
            ->with('success', 'Registration completed successfully. Please login.');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->boolean('remember');

        if (Auth::guard('customer')->attempt($credentials, $remember)) {

            $request->session()->regenerate();

            return redirect()
                ->route('user.dashboard')
                ->with('success', 'Login successful.');
        }

        return back()
            ->withInput()
            ->withErrors([
                'email' => 'Invalid email or password.',
            ]);
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        $customer = Customer::firstOrCreate(
            [
                'email' => $googleUser->email,
            ],
            [
                'name' => $googleUser->name,
                'google_id' => $googleUser->id,
                'avatar' => $googleUser->avatar,
                'password' => bcrypt(str()->random(20)),
                'mobile' => time(),
                'alternate_mobile' => time() + 1,
            ]
        );

        Auth::guard('customer')->login($customer);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }

}