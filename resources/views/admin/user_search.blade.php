@if(!is_null($user))
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
    <tr>
      <td class="uk-text-center">{{ $user->id }}</td>
      <td class="uk-text-right">{{ $user->username }}</td>
      <td class="uk-text-right">{{ $user->fullname() }}</td>
      <td class="uk-text-right">{{ $user->email }}</td>
      <td class="uk-text-right">{{ $user->phonenumber }}</td>
      <td class="uk-text-right">{{ $user->balance() }}</td>
    </tr>
  </tbody>

  <table class="uk-table uk-table-divider uk-table-striped uk-text-small uk-text-center">
    <thead>
      <tr>
        <th class="uk-text-center">Account Name</th>
        <th class="uk-text-right">Bank Name</th>
        <th class="uk-text-right">Account Number</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        @if($user->profileUncompleted())
        <td colspan="3" class="uk-text-center">
          <h6>User hasn't completed profile!</h6>
        </td>
        @else
        <td class="uk-text-center">{{ $user->wallet->accountname }}</td>
        <td class="uk-text-right">{{ $user->wallet->getBankName() }}</td>
        <td class="uk-text-right">{{ $user->wallet->banknumber }}</td>
        @endif
      </tr>
    </tbody>
  </table>
  @else
  <div class="uk-grid">
    <div class="uk-width-1-1 in-card-16">
      <div class="uk-card uk-card-default uk-card-body uk-box-shadow-small uk-border-rounded">
        <h5 class="uk-text-center"> <i class="fa fa-frown-o"></i> User not found!</h5>
      </div>
    </div>
  </div>
  @endif