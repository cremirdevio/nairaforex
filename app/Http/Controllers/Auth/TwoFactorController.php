<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravel\Fortify\Contracts\FailedTwoFactorLoginResponse;
use Laravel\Fortify\Contracts\TwoFactorChallengeViewResponse;
use Laravel\Fortify\Contracts\TwoFactorLoginResponse;
use Laravel\Fortify\Http\Requests\TwoFactorLoginRequest;
use Laravel\Fortify\Http\Controllers\TwoFactorAuthenticatedSessionController;
use App\Verify\Service as TwilioService;
use Illuminate\Support\MessageBag;

class TwoFactorController extends TwoFactorAuthenticatedSessionController
{
    protected $verify;
    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard, TwilioService $verify)
    {
        $this->verify = $verify;
        parent::__construct($guard);
    }

    /**
     * Show the two factor authentication challenge view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\TwoFactorChallengeViewResponse
     */
    public function create(Request $request): TwoFactorChallengeViewResponse
    {
        return app(TwoFactorChallengeViewResponse::class);
    }

    /**
     * Attempt to authenticate a new session using the two factor authentication code.
     *
     * @param  \Laravel\Fortify\Http\Requests\TwoFactorLoginRequest  $request
     * @return mixed
     */
    public function store(TwoFactorLoginRequest $request)
    {
        $user = $request->challengedUser();

        $code = $request->code;
        $phone = $user->phonenumber;

        $verification = $this->verify->checkVerification($phone, $code);
        // if ($code = $request->validRecoveryCode()) {
        //     $user->replaceRecoveryCode($code);
        // } elseif (! $request->hasValidCode()) {
        //     return app(FailedTwoFactorLoginResponse::class);
        // }
        if (!$verification->isValid()) {
            return app(FailedTwoFactorLoginResponse::class);
        }

        $this->guard->login($user, $request->remember());

        $request->session()->regenerate();

        return app(TwoFactorLoginResponse::class);
    }
}