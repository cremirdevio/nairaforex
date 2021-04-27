@extends('layouts.app')

@section('content')
<!-- section content begin -->
<div class="uk-section">
  <div class="uk-container in-wave-4">
    <div class="uk-grid uk-flex uk-flex-center">

      <div class="uk-width-1-1">
        <form action="" method="get">
          <div class="uk-grid">
            <div class="uk-width-1-2@s uk-width-1-4@m">
              <label class="uk-form-label">Status</label>
              <select class="uk-input uk-border-rounded" name="status" id="status-filter">
                <option value="all">Any Status</option>
                <option value="pending">Only Pending</option>
                <option value="completed">Only Complete</option>
                <option value="cancelled">Only Cancelled</option>
              </select>
            </div>
            <div class="uk-width-1-2@s uk-width-1-4@m">
              <label class="uk-form-label">Time</label>
              <select class="uk-input uk-border-rounded" name="duration" id="date-filter">
                <option value="all">All Time</option>
                <option value="this_month">This Month</option>
                <option value="prev_month">Previous Month</option>
                <option value="this_year">This Year</option>
                <option value="prev_year">Previous Year</option>
              </select>
            </div>
            <div class="uk-width-1-2@s uk-width-1-4@m uk-margin-top">
              <button type="submit" class="uk-button uk-button-primary uk-border-rounded">Apply Filter</button>
            </div>
          </div>
        </form>

        <h3>Your Transaction History</h3>
        <div class="uk-overflow-auto">
          <table class="uk-table uk-table-divider uk-table-striped uk-text-small uk-text-center">
            <thead>
              <tr>
                <th class="uk-text-center">Request ID</th>
                <th class="uk-text-right">Type</th>
                <th class="uk-text-right">Status</th>
                <th class="uk-text-right">Amount</th>
                <th class="uk-text-right">Balance</th>
                <th class="uk-text-right">Created</th>
              </tr>
            </thead>
            <tbody>
              @forelse($transactions as $transaction)
              <tr>
                <td>{{ $transaction->reference }}</td>
                <td class="uk-text-right uk-text-uppercase">{{ $transaction->type }}</td>
                <td class="uk-text-right uk-text-uppercase">
                  {{ $transaction->status }}
                  <span
                    uk-icon="{{ $transaction->status == 'succeed' ? 'check' : ( $transaction->status == 'closed' ? 'close' : 'future') }}"
                    class="uk-text-{{ $transaction->status == 'succeed' ? 'success' : ( $transaction->status == 'closed' ? 'danger' : 'warning') }}"></span>
                </td>
                <td class="uk-text-right">{{ to_naira($transaction->amount) }}</td>
                <td class="uk-text-right">
                  {{  $transaction->type == 'deposit' ? '' : to_naira($transaction->balance) }}</td>
                <td class="uk-text-right">{{ $transaction->created_at->diffForHumans() }}</td>
              </tr>
              @empty
              <tr>
                <td colspan="6">
                  <p><span uk-icon="warning" class="uk-text-warning"></span></p>
                  <p>No transations!</p>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>

        {{ $transactions->links() }}
      </div>



    </div>
  </div>
</div>
<!-- section content end -->

@endsection