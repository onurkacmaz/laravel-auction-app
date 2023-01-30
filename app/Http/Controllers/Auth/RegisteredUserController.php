<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Rules\TcIdentifyRule;
use App\Rules\UniqueTcIdetificationRule;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'tc_identification_number' => [
                'required',
                'integer',
                'digits:11',
                new UniqueTcIdetificationRule($request->all()),
                new TcIdentifyRule($request->all())
            ],
            'birth_date' => ['required', 'date', 'before:today'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
        ], [], [
            'name' => 'Ad Soyad',
            'email' => 'E-posta',
            'tc_identification_number' => 'TC Kimlik Numarası',
            'birth_date' => 'Doğum Tarihi',
            'password' => 'Şifre',
            'password_confirmation' => 'Şifre Tekrarı'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'tc_identification_number' => Hash::make($request->tc_identification_number),
            'birth_date' => $request->birth_date,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
