@extends('layouts.app')

@section('content')

<div class="uk-section uk-padding-remove-top uk-padding-remove-bottom" style="background-color: #fff;">
  <div class="uk-container uk-padding-remove-horizontal">
    <div class="uk-grid ">
      <div class="uk-width-1-1 uk-margin-small-bottom uk-margin-large-left">
        <h1 class="uk-margin uk-margin-small-bwo Factor Authenticationottom">Account <span class="in-highlight">Settings</span></h1>
      </div>
    </div>
  </div>
</div>

<!-- section content begin -->
<div class="uk-section uk-padding-remove-top" style="background-color: #f3f4f6;">
  <div class="uk-container in-wave-4">
    <div class="uk-grid uk-flex uk-flex-center">

      <!-- Profile Update Panel -->
      <div class="uk-grid uk-text-center uk-width-1-1 uk-margin-top">
        <div class="uk-width-1-3@m uk-text-left uk-margin-bottom">
          <h3 class="uk-margin-remove nf-profile-title">Profile Information</h3>
          <p class="uk-margin-small-top nf-profile-desc">Update your account's profile information</p>
          <div class="uk-alert uk-alert-danger">
            <!-- <p>Ensure your mobile number is set correctly(by selecting the right country) as this will be used to send
              you vital information.</p> -->
          </div>
        </div>


        <div class="uk-width-2-3@m ">
          <form class="uk-form-stacked" action="{{ route('user-profile-information.update') }}" method="post">
            @csrf
            @method('put')
            <div
              class="uk-card uk-card-default nf-profile-card nf-card nf-card-border uk-margin-remove@s nf-card-border">
              <div class="uk-card-body">

                <div class="uk-grid uk-text-left">
                  <div class="uk-margin-small-bottom uk-width-1-2@s">
                    <label class="uk-form-label nf-profile-desc" for="form-stacked-text">First Name</label>
                    <div class="uk-form-controls">
                      <input class="uk-input uk-border-rounded" id="form-stacked-text" name="firstname"
                        value="{{ $user->firstname }}" type="text" placeholder="First Name">
                    </div>
                  </div>

                  <div class="uk-margin-small-bottom uk-width-1-2@s">
                    <label class="uk-form-label nf-profile-desc" for="form-stacked-text">Last Name</label>
                    <div class="uk-form-controls">
                      <input class="uk-input uk-border-rounded" id="form-stacked-text" name="lastname"
                        value="{{ $user->lastname }}" type="text" placeholder="Last Name">
                    </div>
                  </div>

                </div>

                <div class="uk-grid uk-text-left uk-margin-small-top">
                  <div class="uk-margin-small-bottom uk-width-1-2@s">
                    <label class="uk-form-label nf-profile-desc" for="form-stacked-text">Email</label>
                    <div class="uk-form-controls">
                      <input class="uk-input uk-border-rounded" id="form-stacked-text" name="email"
                        value="{{ $user->email }}" type="email" placeholder="Email Address">
                    </div>
                  </div>

                  <div class="uk-margin-small-bottom uk-width-1-2@s">
                    <label class="uk-form-label nf-profile-desc" for="form-stacked-text">Mobile Number</label>
                    <div class="uk-form-controls">
                      <input class="uk-input uk-border-rounded" id="phone_number" value="{{ $user->phonenumber }}"
                        type="tel" placeholder="Mobile Number">
                    </div>
                  </div>

                </div>
              </div>
              <div class="uk-card-footer nf-card-footer uk-text-right" style="background: #f0eff3;">
                <button class="uk-button nf-card-button uk-button-secondary uk-border-rounded">Save</button>
              </div>
            </div>
          </form>
        </div>

      </div>

      <div class="uk-width-1-1 uk-padding uk-visible@s">
        <hr class="">
      </div>

      <!-- Banking Update Panel -->
      <div class="uk-grid uk-text-center uk-width-1-1 uk-margin-top">
        <div class="uk-width-1-3@m uk-text-left uk-margin-bottom">
          <h3 class="uk-margin-remove nf-profile-title">Banking Information</h3>
          <p class="uk-margin-small-top nf-profile-desc">Update your account's banking information. Payment will be
            sent here.</p>
        </div>

        <div class="uk-width-2-3@m ">

          <form class="uk-form-stacked" action="{{ route('account.wallet.update') }}" method="post">
            @csrf
            @method('put')
            <div
              class="uk-card uk-card-default nf-profile-card nf-card nf-card-border uk-overflow-hidden uk-margin-remove@s nf-card-border">
              <div class="uk-card-body">
                <div class="uk-grid uk-text-left">
                  <div class="uk-margin-small-bottom uk-width-2-3@s">
                    <label class="uk-form-label nf-profile-desc" for="form-stacked-text">Account Name</label>
                    <div class="uk-form-controls">
                      <input class="uk-input uk-border-rounded" id="form-stacked-text" name="accountname"
                        value="{{ $user->wallet->accountname }}" type="text" placeholder="Account Name">
                    </div>
                  </div>
                </div>

                <div class="uk-grid uk-text-left uk-margin-small-top">
                  <div class="uk-margin-small-bottom uk-width-1-2@s">
                    <label class="uk-form-label nf-profile-desc" for="form-stacked-text">Bank Name</label>
                    <div class="uk-form-controls">
                      <select class="uk-select uk-border-rounded" name="bankname" value="{{ $user->wallet->bankname }}">
                        @foreach(config('banks') as $key => $value)
                        <option value="{{ $key }}" {{ $key == $user->wallet->bankname ? 'selected' : '' }}>{{ $value }}
                        </option>
                        @endforeach
                      </select>
                    </div>
                  </div>

                  <div class="uk-margin-small-bottom uk-width-1-2@s">
                    <label class="uk-form-label nf-profile-desc" for="form-stacked-text">Bank Number</label>
                    <div class="uk-form-controls">
                      <input class="uk-input uk-border-rounded" id="form-stacked-text" name="banknumber"
                        value="{{ $user->wallet->banknumber }}" type="text" placeholder="Bank Number">
                    </div>
                  </div>

                </div>
              </div>
              <div class="uk-card-footer nf-card-footer uk-text-right" style="background: #f0eff3;">
                <button type="submit"
                  class="uk-button nf-card-button uk-button-secondary uk-border-rounded">Save</button>
              </div>
            </div>
          </form>
        </div>

      </div>

      <div class="uk-width-1-1 uk-padding uk-visible@s">
        <hr class="">
      </div>

      <!-- Password Update Panel -->
      <div class="uk-grid uk-text-center uk-width-1-1 uk-margin-top">
        <div class="uk-width-1-3@m uk-text-left uk-margin-bottom">
          <h3 class="uk-margin-remove nf-profile-title">Update Password</h3>
          <p class="uk-margin-small-top nf-profile-desc">Ensure your account is using a long, random password to stay
            secure.</p>
        </div>

        <div class="uk-width-2-3@m ">
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          <form class="uk-form-stacked" action="{{ route('user-profile-information.update') }}" method="post">
            @csrf
            @method('put')
            <div
              class="uk-card uk-card-default nf-profile-card nf-card nf-card-border uk-overflow-hidden uk-margin-remove@s nf-card-border">
              <div class="uk-card-body">

                <div class="uk-grid uk-text-left">
                  <div class="uk-margin-small-bottom uk-width-1-2@s">
                    <label class="uk-form-label nf-profile-desc" for="form-stacked-text">Current Password</label>
                    <div class="uk-form-controls">
                      <input class="uk-input uk-border-rounded" id="form-stacked-text" name="current_password"
                        type="password" placeholder="Current Password">
                      {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                    </div>
                  </div>

                  <div class="uk-margin-small-bottom uk-width-1-2@s">
                    <label class="uk-form-label nf-profile-desc" for="form-stacked-text">New Password</label>
                    <div class="uk-form-controls">
                      <input class="uk-input uk-border-rounded" id="form-stacked-text" name="password" type="password"
                        placeholder="New Password">
                    </div>
                  </div>

                </div>

                <div class="uk-grid uk-text-left uk-margin-small-top">
                  <div class="uk-margin-small-bottom uk-width-2-3@s">
                    <label class="uk-form-label nf-profile-desc" for="form-stacked-text">Confirm Password</label>
                    <div class="uk-form-controls">
                      <input class="uk-input uk-border-rounded" id="form-stacked-text" name="confirm-password"
                        type="password" placeholder="Confirm Password">
                    </div>
                  </div>
                </div>
              </div>
              <div class="uk-card-footer nf-card-footer uk-text-right" style="background: #f0eff3;">
                <button type="submit"
                  class="uk-button nf-card-button uk-button-secondary uk-border-rounded">Save</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="uk-width-1-1 uk-padding uk-visible@s">
        <hr class="">
      </div>

      <!-- Two Factor Authentication Panel -->
      

    </div>

  </div>
</div>
<!-- section content end -->


@endsection

@push('scripts')
<script src="{{ asset('js/intlTelInput.js') }}"></script>
<script>
var input = document.querySelector("#phone_number");
window.intlTelInput(input, {
  hiddenInput: "phonenumber",
  preferredCountries: ["us", "gb", "co", "de"],
  utilsScript: "{{ asset('js/utils.js') }}"
});
</script>
@endpush

@push('styles')
<link rel="stylesheet" href="{{ asset('css/intlTelInput.css') }}" />
@endpush