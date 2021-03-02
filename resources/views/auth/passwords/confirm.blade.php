@extends('layouts.app')

@section('content')
<div class="uk-section uk-padding-large">
  <div class="uk-container in-wave-2">
    <div class="uk-grid uk-flex-center">
      <div class="uk-width-2-5@m">
        <h3 class="uk-margin-bottom uk-text-center">{{ __('Confirm Password') }}</h3>

        <div class="uk-card uk-card-body uk-card-default nf-card-border uk-padding-remove-bottom">
          {{ __('Please confirm your password before continuing.') }}

          <form method="POST" action="{{ url('/user/confirm-password') }}">
            @csrf

            <div class="uk-margin-small uk-width-1-1 uk-inline">

              <label for="password" class="text-md-right">{{ __('Password') }}</label>
              <span class="uk-form-icon uk-form-icon-flip fas fa-lock fa-sm"></span>
              <input class="uk-input uk-border-rounded" name="password" id="password" type="password"
                placeholder="Password">
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="uk-margin-small uk-width-1-1">
              <button class="uk-button uk-width-1-1 uk-button-primary uk-border-rounded uk-float-left" type="submit"
                name="submit">Sign in</button>
            </div>
            @if (Route::has('password.request'))
            <div class="uk-margin-small uk-width-expand uk-text-small">
              <label class="uk-align-right"><a class="uk-link-reset"
                  href="#">{{ __('Forgot Your Password?') }}</a></label>
            </div>
            @endif

          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection