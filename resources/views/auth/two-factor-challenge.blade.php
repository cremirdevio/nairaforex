@extends('layouts.app')

@section('content')
<div class="uk-section uk-padding-large">
  <div class="uk-container in-wave-2">
    <div class="uk-grid uk-flex-center">
      <div class="uk-width-2-5@m">
        <h3 class="uk-margin-bottom uk-text-center">{{ __('2FA Verification') }}</h3>

        <div class="uk-card uk-card-body uk-card-default nf-card-border uk-padding-remove-bottom">
          {{ __('Please enter your authentication code to login.') }}

          <form method="POST" action="{{ url('/two-factor-challenge') }}">
            @csrf

            <div class="uk-margin-small uk-width-1-1 uk-inline">

              <label for="password" class="text-md-right">{{ __('Code') }}</label>
              <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
              <input class="uk-input uk-border-rounded" name="code" id="code" type="text" placeholder="OTP Code">
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="uk-margin-small uk-width-1-1">
              <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left" type="submit"
                name="submit">Continue</button>
            </div>
            @if (Route::has('password.request'))
            <!-- <div class="uk-margin-small uk-width-expand uk-text-small">
              <label class="uk-align-right"><a class="uk-link-reset"
                  href="#">{{ __('Forgot Your Password?') }}</a></label>
            </div> -->
            @endif

          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection