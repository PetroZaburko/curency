<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendRegistrationUserEmailJob;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class ExternalAuthController extends Controller
{

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $providerUser = Socialite::driver($provider)->user();
        if ($user = $this->findOrCreateUser($providerUser, $provider)) {
            Auth::login($user, true);
            Session::put('success', "Welcome $user->name! You successful logged via $provider");
        }
        return redirect('/login');

    }

    protected function findOrCreateUser($providerUser, $provider)
    {
        //        check is email not null
        if ($this->isEmailEmpty($providerUser->getEmail())) {
            Session::put('error', 'In your facebook account email field is empty. You must fill this value in your facebook account');
            return false;
        }
        //        find user if exist
        if ($user = $this->findUser($providerUser, $provider)) {
            return $user;
        }
        //        check is email unique
        if ($this->isEmailUnique($providerUser->getEmail())) {
            Session::put('error', __('validation.unique', ['attribute' => 'email']));
            return false;
        }

        return $this->createUser($providerUser, $provider);
    }

    protected function isEmailEmpty($email)
    {
        return is_null($email);
    }

    protected function isEmailUnique($email)
    {
        return User::where('email', $email)->first();
    }

    protected function findUser($providerUser, $provider)
    {
        return User::where('email', $providerUser->getEmail())
            ->where('provider', $provider)
            ->where('provider_id', $providerUser->id)
            ->first();
    }

    protected function createUser($user, $provider)
    {
        $user = User::create([
            'name' => $user->name,
            'email' => $user->email,
            'provider' => $provider,
            'password' => Hash::make(Str::random(10)),
            'provider_id' => $user->id,
        ]);
        $this->createdUser($user);
        return $user;
    }

    protected function createdUser($user)
    {
        $token = $user->createToken('ApiKey')->plainTextToken;
//        SendRegistrationUserEmailJob::dispatch($user, $request->get('password'));
        Session::put('error', __('main.api_create') . $token);

    }
}
