<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        // Behoud ondersteuning voor bestaande Breeze-registratietests zonder account_type.
        $request->merge(['account_type' => $request->input('account_type', 'particulier')]);

        $validated = $request->validate([
            'account_type' => ['required', Rule::in(['particulier', 'zakelijk'])],
            'company_name' => [Rule::requiredIf(fn () => $request->input('account_type') === 'zakelijk'), 'nullable', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        // Default Breeze User model only makes name/email/password mass-assignable.
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Values were validated above. Account type is never an authorization role.
        $user->forceFill([
            'account_type' => $validated['account_type'],
            'company_name' => $validated['account_type'] === 'zakelijk' ? $validated['company_name'] : null,
        ])->save();

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
