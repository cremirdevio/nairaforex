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
            <h3>Funder Transfer</h3>
            <p>Latest transactions</p>
            <div class="uk-grid in-margin-bottom-30@s" data-uk-grid>

              <div>
                <table class="uk-table uk-table-divider uk-table-striped uk-text-small uk-text-center">
                  <thead>
                    <tr>
                      <th class="uk-text-center">Recipient</th>
                      <th class="uk-text-right">Amount</th>
                      <th class="uk-text-right">Status</th>
                      <th class="uk-text-right">Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @forelse($transactions as $transaction)
                    <tr>
                      <td>{{ $transaction->transfer_recipient->username }}</td>
                      <td class="uk-text-right">{{ to_naira($transaction->amount) }}</td>
                      <td class="uk-text-right uk-text-uppercase">{{ $transaction->status }}</td>
                      <td class="uk-text-right">{{ $transaction->created_at->diffForHumans() }}</td>
                    </tr>
                    @empty
                    <tr>
                      <td colspan="4">
                        <p><span uk-icon="warning" class="uk-text-warning"></span> Empty!</p>
                      </td>
                    </tr>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="uk-width-1-3@s">
        <h3>Transfer Funds Now</h3>
        <h5>Transfer to users from your wallet</h5>

        <div>
          <form action="{{ route('admin.transfer') }}" method="post">
            @csrf
          <p class="uk-text-small">Balance: &#8358;{{ to_naira(auth()->user()->balance(0 ))}}</p>

            <input type="hidden" name="role" value="funder">
            <div class="uk-margin">
              <input class="uk-input uk-border-rounded" type="text" name="username" placeholder="Customer's username">
            </div>
            <div class="uk-margin">
              <input class="uk-input uk-border-rounded" min="0" name="amount" step=".01" type="number"
                placeholder="Amount to transfer">
            </div>
            <div class="uk-flex uk-flex-row uk-flex-between uk-flex-middle uk-text-right">
              <p class="uk-text-small"><a href="{{ route('admin.transactions') }}">Transaction History</a></p>
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