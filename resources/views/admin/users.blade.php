@extends('layouts.app')

@section('content')
<!-- section content begin -->
<div class="uk-section">
  <div class="uk-container in-wave-4">
    <div class="uk-grid uk-flex uk-flex-center">

      <div class="uk-width-1-1">
        <h3>Search Users</h3>
        <div class="uk-grid">
          <div class="uk-width-2-3@s uk-width-2-5@m">
            <input type="search" name="search" id="search-input" class="uk-input uk-border-rounded"
              placeholder="Search Users">
          </div>

          <div class="uk-width-1-3@s uk-width-1-5@m">
            <input type="submit" id="search" class="uk-button uk-button-primary uk-border-rounded" value="Search"
              onclick="event.preventDefault();
                                            fetchData('{{ route('admin.users.search') }}');">
          </div>

          <div class="uk-width-1-1 uk-margin-small uk-overflow-auto" id="search-result">

          </div>
        </div>

        <h3>Users List</h3>
        <div class="uk-overflow-auto">
          <table class="uk-table uk-table-divider uk-table-striped uk-text-small uk-text-center">
            <thead>
              <tr>
                <th class="uk-text-center">ID</th>
                <th class="uk-text-right">Username</th>
                <th class="uk-text-right">Fullname</th>
                <th class="uk-text-right">Email</th>
                <th class="uk-text-right">Phone Number</th>
                <th class="uk-text-right">Balance</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                <td class="uk-text-center">{{ $user->id }}</td>
                <td class="uk-text-right">{{ $user->username }}</td>
                <td class="uk-text-right">{{ $user->fullname() }}</td>
                <td class="uk-text-right">{{ $user->email }}</td>
                <td class="uk-text-right">{{ $user->phonenumber }}</td>
                <td class="uk-text-right">{{ $user->balance() }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>

          {{ $users->links() }}
        </div>
      </div>



    </div>
  </div>
</div>
<!-- section content end -->

@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('js/search.js') }}"></script>
@endpush