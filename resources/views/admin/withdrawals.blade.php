@extends('layouts.app')

@section('content')
<!-- section content begin -->
<div class="uk-section">
  <div class="uk-container in-wave-4">
    <div class="uk-grid uk-flex uk-flex-center">

      <div class="uk-width-1-1">
        <h3>Withdrawal List</h3>
        <form action="" class="uk-inline" method="get">
          <div class="uk-grid">
            <div class="uk-width-1-2@s uk-width-1-4@m">
              <select class="uk-input uk-border-rounded" name="status">
                <option value="all">Any Status</option>
                <option value="pending">Only Pending</option>
                <option value="completed">Only Complete</option>
                <option value="cancelled">Only Cancelled</option>
              </select>
            </div>
            <div class="uk-width-1-2@s uk-width-1-4@m">
              <select class="uk-input uk-border-rounded" name="duration">
                <option value="all">All Time</option>
                <option value="this_month">This Month</option>
                <option value="prev_month">Previous Month</option>
                <option value="this_year">This Year</option>
                <option value="prev_year">Previous Year</option>
              </select>
            </div>
            <div class="uk-width-1-2@s uk-width-1-4@m">
              <button type="submit" class="uk-button uk-button-primary uk-border-rounded">Apply</button>
            </div>
          </div>
        </form>

        <div class="uk-overflow-auto">
          <table class="uk-table uk-table-divider uk-table-striped uk-text-small uk-text-center">
            <thead>
              <tr>
                <th class="uk-text-center">Time</th>
                <th class="uk-text-right">Username</th>
                <th class="uk-text-right">Amount</th>
                <th class="uk-text-right">Status</th>
                <th class="uk-text-right">Account No</th>
                <th class="uk-text-right">Bank Account</th>
                <th class="uk-text-right">Bank Name</th>
                <th class="uk-text-right">Balance</th>
                <th> </th>
              </tr>
            </thead>
            <tbody>
              @forelse($withdrawals as $withdrawal)
              <tr>
                <td>{{ $withdrawal->getDate() }} <br> {{ $withdrawal->getTime() }}</td>
                <td class="uk-text-capitalize">{{ $withdrawal->user->username }}</td>
                <td>{{ to_naira($withdrawal->amount) }}</td>
                <td class="uk-text-capitalize uk-text-{{ status($withdrawal->status) }}">{{ $withdrawal->status }}</td>
                <td class="uk-text-capitalize">{{ $withdrawal->user->wallet->banknumber }}</td>
                <td class="uk-text-capitalize">{{ $withdrawal->user->wallet->getBankName() }}</td>
                <td class="uk-text-capitalize">{{ $withdrawal->user->wallet->accountname }}</td>
                <td>{{ to_naira($withdrawal->balance) }}</td>
                <td class="p-0">
                  @if($withdrawal->status == "pending")
                  <form class="_form" action="{{ route('admin.withdrawals.settle', [$withdrawal]) }}" method="post">
                    @csrf
                    <button type="submit" class="uk-button uk-button-primary uk-margin-small">Settle</button>
                  </form>
                  <form class="_form" action="{{ route('admin.withdrawals.close', [$withdrawal]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="uk-button uk-button-danger uk-margin-small">Delete</button>
                  </form>
                  @endif
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="9">
                  <p><span uk-icon="warning" class="uk-text-warning"></span></p>
                  <p>Empty!</p>
                </td>
              </tr>
              @endforelse
            </tbody>
          </table>
          {{ $withdrawals->links() }}
        </div>


      </div>



    </div>
  </div>
</div>
<!-- section content end -->

@endsection