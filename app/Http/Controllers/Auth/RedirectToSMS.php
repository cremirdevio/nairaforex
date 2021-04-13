<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Failed;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\LoginRateLimiter;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Fortify\Actions\RedirectIfTwoFactorAuthenticatable;
use App\Verify\Service as TwilioService;
use Illuminate\Support\MessageBag;

class RedirectToSMS extends RedirectIfTwoFactorAuthenticatable
{
    protected $verify;
    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @param  \Laravel\Fortify\LoginRateLimiter  $limiter
     * @return void
     */
    public function __construct(StatefulGuard $guard, LoginRateLimiter $limiter, TwilioService $verify)
    {
        $this->verify = $verify;
        parent::__construct($guard, $limiter);
    }

    /**
     * Get the two factor authentication enabled response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function twoFactorChallengeResponse($request, $user)
    {
        $request->session()->put([
            'login.id' => $user->getKey(),
            'login.remember' => $request->filled('remember'),
        ]);

        // Send the SMS OTP with Twilio Verify API
        $verification = $this->verify->startVerification($user->phonenumber, 'sms');
        // dd($verification);
        if (!$verification->isValid()) {
            
            $errors = new MessageBag();
            foreach($verification->getErrors() as $error) {
                $errors->add('error', $error);
            }

            return redirect()->route('login')->withErrors($errors);
        }

        return $request->wantsJson()
                    ? response()->json(['two_factor' => true])
                    : redirect()->route('two-factor.login')->with('success', "Code sent to {$user->phonenumber}");
    }
}