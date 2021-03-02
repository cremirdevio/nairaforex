@extends('layouts.app')

@section('content')

<div class="uk-section uk-padding-remove-top uk-padding-remove-bottom" style="background-color: #fff;">
  <div class="uk-container uk-padding-remove-horizontal">
    <div class="uk-grid ">
      <div class="uk-width-1-1 uk-margin-small-bottom uk-margin-large-left">
        <h1 class="uk-margin uk-margin-small-bottom">Manage <span class="in-highlight">Roles</span></h1>

        <h3>Search Users</h3>
        <div class="uk-grid">
          <div class="uk-width-2-3@s uk-width-2-5@m">
            <input type="search" name="search" id="search-input" class="uk-input uk-border-rounded"
              placeholder="Search Users">
          </div>

          <div class="uk-width-1-3@s uk-width-1-5@m">
            <input type="submit" id="search" class="uk-button uk-button-primary uk-border-rounded" value="Search"
              onclick="event.preventDefault();
                                            fetchData('{{ route('admin.roles.search') }}');">
          </div>

          <div class="uk-width-1-1 uk-margin-small uk-overflow-auto" id="search-result">

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- section content begin -->
<div class="uk-section uk-padding-remove-top" style="background-color: #f3f4f6;">
  <div class="uk-container in-wave-4">
    <div class="uk-grid uk-flex uk-flex-center">

      @foreach($roles as $role)
      <!-- Profile Update Panel -->
      <div class="uk-grid uk-text-center uk-width-1-1 uk-margin-top">
        <div class="uk-width-1-3@m uk-text-left uk-margin-bottom">
          <h3 class="uk-margin-remove nf-profile-title uk-text-capitalize">{{ $role->name }}</h3>
          <!-- <p class="uk-margin-small-top nf-profile-desc">Has access to all available roles and permissions</p> -->
        </div>

        <div class="uk-width-2-3@m">
          <div
            class="uk-card uk-card-default nf-profile-card nf-card nf-card-border uk-overflow-hidden uk-margin-remove@s nf-card-border">
            <div class="uk-card-body">
              @if($role->users->isNotEmpty())
              <div class="uk-overflow-auto">
                <table class="uk-table uk-table-divider uk-table-striped uk-text-small uk-text-center">
                  <thead>
                    <tr>
                      <th class="uk-text-center">User ID</th>
                      <th class="uk-text-right">Username</th>
                      <th class="uk-text-right">Full Name</th>
                      <th class="uk-text-right">Email</th>
                      <th class="uk-text-right">Phone Number</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($role->users as $user)
                    <tr>
                      <td>{{ $user->id }}</td>
                      <td class="uk-text-right">{{ $user->firstname . ' ' . $user->lastname }}</td>
                      <td class="uk-text-right">{{ $user->username }}</td>
                      <td class="uk-text-right">{{ $user->email }}</td>
                      <td class="uk-text-right">{{ $user->phonenumber }}</td>
                      <td class="uk-text-right">
                        <form method="post" action="{{ route('admin.roles.detach') }}">
                          @csrf
                          <input type="hidden" name="user" value="{{ $user->id }}">
                          <input type="hidden" name="role" value="{{ $role->name }}">
                          <button type="submit" class="uk-button uk-button-danger">Remove</button>
                        </form>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              @endif
            </div>

          </div>
        </div>

      </div>
      @endforeach

      <div class="uk-width-1-1 uk-padding uk-visible@s">
        <hr class="">
      </div>

    </div>

    <div class="uk-grid uk-flex uk-flex-center">

    </div>
  </div>
</div>
<!-- section content end -->


@endsection

@push('scripts')
<script type="text/javascript" src="{{ asset('js/search.js') }}"></script>
@endpush