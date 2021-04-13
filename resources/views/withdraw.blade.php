@extends('layouts.app')

@section('content')
<!-- section content begin -->
<div class="uk-section">
  <div class="uk-container">
    <div class="uk-grid">
      <div class="uk-width-2-3@s">
        <div class="uk-grid uk-grid-small" data-uk-grid>
          <div class="uk-width-auto@m">
            <i class="fas fa-money-bill-wave fa-2x in-icon-wrap large primary-color uk-margin-right"></i>
          </div>
          <div class="uk-width-expand">
            <h3>Withdraw you funds.</h3>
            <p>Withdraw from your wallet and get paid into the bank account you registered with.</p>
            <div class="uk-grid uk-width-large in-margin-bottom-30@s" data-uk-grid>
              <div>
                <ul class="uk-list uk-list-bullet in-list-check">
                  <li>Every payment is processed within 24hours or less.</li>
                  <li>Ensure your banking details is correct.</li>
                  <li>T+0 settlement</li>
                  <li>We do not charge any fee on deposits..</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="uk-width-1-3@s">
        <h3>Withdrawal Form</h3>
        <div>
          <div class="uk-margin">
            <input class="uk-input uk-border-rounded" type="text" value="{{ config('banks')[$user->wallet->bankname] }}"
              disabled>
          </div>
          <div class="uk-margin">
            <input class="uk-input uk-border-rounded" type="text" value="{{ $user->wallet->banknumber }}" disabled>
          </div>
          <p class="uk-text-small"><a href="{{ route('account') }}">Update Account Details</a></p>
          <p class="uk-text-small">Balance; &#8358;{{ to_naira(auth()->user()->balance(0 ))}}</p>
          <form action="{{ route('withdrawals.store') }}" method="post">
            @csrf
            <div class="uk-margin">
              <input class="uk-input uk-border-rounded" name="amount" type="text" placeholder="Amount">
            </div>
            <div class="uk-flex uk-flex-row uk-flex-between uk-flex-middle uk-text-right">
              <p class="uk-text-small"><a href="{{ route('withdrawals') }}">Withdrawal History</a></p>
              <button class="uk-button uk-border-rounded uk-button-primary">Proceed</button>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>
</div>
<!-- section content end -->
@endsection