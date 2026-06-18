<?php

namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Wishlist;

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

            $customer = Auth::guard('customer')->user();

            $this->mergeGuestCart($customer);
            $this->mergeGuestWishlist($customer);

            $request->session()->regenerate();

            return redirect()
                ->route('user.dashboard.index')
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

        $this->mergeGuestCart($customer);
        $this->mergeGuestWishlist($customer);

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('user.login');
    }

    private function mergeGuestCart(Customer $customer)
    {
        $guestCart = Cart::where(
            'session_id',
            session()->getId()
        )->first();

        if (!$guestCart) {
            return;
        }

        $userCart = Cart::firstOrCreate(
            [
                'user_id' => $customer->id
            ],
            [
                'session_id' => session()->getId(),
                'total_amount' => 0
            ]
        );

        if ($guestCart->id == $userCart->id) {

            $userCart->update([
                'user_id' => $customer->id
            ]);

            return;
        }

        foreach ($guestCart->items as $item) {

            $existingItem = CartItem::where('cart_id', $userCart->id)
                ->where('product_id', $item->product_id)
                ->where('variant_id', $item->variant_id)
                ->first();

            if ($existingItem) {

                $existingItem->quantity += $item->quantity;
                $existingItem->total =
                    $existingItem->quantity * $existingItem->price;

                $existingItem->save();

            } else {

                CartItem::create([
                    'cart_id' => $userCart->id,
                    'product_id' => $item->product_id,
                    'variant_id' => $item->variant_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'total' => $item->total,
                ]);
            }
        }

        $userCart->update([
            'total_amount' => $userCart->items()->sum('total')
        ]);

        $guestCart->items()->delete();
        $guestCart->delete();
    }

    private function mergeGuestWishlist(Customer $customer)
    {
        $guestWishlistItems = Wishlist::where(
            'session_id',
            session()->getId()
        )->get();

        if ($guestWishlistItems->isEmpty()) {
            return;
        }

        foreach ($guestWishlistItems as $item) {

            $exists = Wishlist::where(
                'customer_id',
                $customer->id
            )
                ->where(
                    'product_id',
                    $item->product_id
                )
                ->exists();

            if (!$exists) {

                Wishlist::create([
                    'customer_id' => $customer->id,
                    'session_id' => null,
                    'product_id' => $item->product_id,
                    'expires_at' => $item->expires_at,
                ]);
            }
        }

        Wishlist::where(
            'session_id',
            session()->getId()
        )->delete();
    }

}