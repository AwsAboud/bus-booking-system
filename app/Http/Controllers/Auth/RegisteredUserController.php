<?php

namespace App\Http\Controllers\Auth;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Http;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        //dd($request);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'phone_number' => ['required', 'string', 'max:10', 'unique:users'],
            // 'g-recaptcha-response' => ['required' ,
            //         function (string $attribute, mixed $value, Closure $fail) {
            //             $g_response = Http::asForm()->post("https://www.google.com/recaptcha/api/siteverify",[
            //                 'secret' => config('services.recaptcha.secret_key'),
            //                 'response' => $value,
            //             ]);
            //             //dd($g_response->json());
            //             if (  $g_response->json('success')) {
            //                 $fail("The {$attribute} is invalid.");
            //             }
            //         },
            // ] ,
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
        ]);

        event(new Registered($user));

        Auth::login($user);
        alert()->image('Welcome !','We are so glade to join our family ' . auth()->user()->name,'/imgs/logo.png','60%','50%','Image Alt');
        return redirect(RouteServiceProvider::HOME);
    }
}
