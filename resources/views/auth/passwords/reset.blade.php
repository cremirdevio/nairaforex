@extends('layouts.app')

@section('content')
<!-- Page Title #6 -->
<section id="page-title" class="page-title bg-overlay bg-overlay-dark bg-parallax">
  <div class="bg-section">
    <img src="{{ asset('assets/images/page-titles/1.jpg') }}" alt="Background" />
  </div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
        <div class="title title-6 text-center">
          <div class="title--heading">
            <h1>Account Login</h1>
          </div>
          <div class="clearfix"></div>
          </ol>
        </div>
        <!-- .title end -->
      </div>
      <!-- .col-md-12 end -->
    </div>
    <!-- .row end -->
  </div>
  <!-- .container end -->
</section>
<!-- #page-title end -->

<div class="container-fluid bg-grey p-5">
  <div class="row justify-content-center">
    <div class="col-sm-8 col-sm-offset-2">
      <div class="panel bg-white">
        <div class="panel-heading login100-form-title px-5 pt-5">{{ __('Reset Password') }}</div>

        <div class="card-body px-5">
          <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group row">
              <div class="col-xs-12 col-sm-12">
                <label for="email" class="text-md-right">{{ __('E-Mail Address') }}</label>
                <input id="email" type="email" class="form-control mb-2 @error('email') is-invalid @enderror"
                  name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                @error('username')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <div class="col-xs-12 col-sm-12">
                <label for="password" class="text-md-right">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control mb-2 @error('password') is-invalid @enderror"
                  name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <div class="col-xs-12 col-sm-12">
                <label for="password-confirm" class="text-md-right">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                  autocomplete="new-password">
              </div>
            </div>

            <div class="form-group row mb-0">
              <div class="col-xs-12 col-sm-12">
                <button type="submit" class="btn btn--primary btn--rounded">
                  {{ __('Reset Password') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection