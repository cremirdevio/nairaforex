<nav class="uk-navbar-container uk-navbar-transparent"
  data-uk-sticky="show-on-up: true; top: 80; animation: uk-animation-fade;">
  <div class="uk-container" data-uk-navbar>
    <div class="uk-navbar-left uk-width-auto">
      <div class="uk-navbar-item">
        <!-- module logo begin -->
        <a class="uk-logo" href="/">
          <img class="uk-margin-small-right in-offset-top-10" src="{{ asset('img/logo/nairaforex-1.png') }}"
            data-src="{{ asset('img/logo/nairaforex-1.png') }}" alt="wave" width="134" height="23" data-uk-img>
        </a>
        <!-- module logo begin -->
      </div>
    </div>
    <div class="uk-navbar-right uk-width-expand uk-flex uk-flex-right">
      <ul class="uk-navbar-nav uk-visible@m">

        <li><a href="/">Home</a></li>
        <li><a href="{{ route('traders') }}">Remote Traders</a></li>
        @guest
        @else
        <li><a href="{{ route('portfolio') }}">My Portfolio</a></li>
        <li><a href="#">Withdraw/Deposit<i class="fas fa-chevron-down"></i></a>
          <div class="uk-navbar-dropdown">
            <ul class="uk-nav uk-navbar-dropdown-nav">
              <li><a href="{{ route('withdrawals.create') }}">Withdraw Funds</a></li>
              <li><a href="{{ route('static', 'deposit-funds') }}">Deposit Funds</a></li>
              <li><a href="{{ route('transactions') }}">Transaction History</a></li>
            </ul>
          </div>
        </li>
        <li><a href="#"> {{ auth()->user()->username }}<i class="fas fa-chevron-down"></i></a>
          <div class="uk-navbar-dropdown">
            <ul class="uk-nav uk-navbar-dropdown-nav">
              <li><a href="{{ route('account') }}">Account Settings</a></li>

              <li><a href="signin.html" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();"><i
                    class="fa fa-sign-out uk-margin-small-right"></i>{{ __('Logout') }}</a></li>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
              </form>
            </ul>
          </div>
        </li>
        @hasanyrole('funder|admin|compiler|customer service')
        <li><a href="#">Admin<i class="fas fa-chevron-down"></i></a>
          <div class="uk-navbar-dropdown">
            <ul class="uk-nav uk-navbar-dropdown-nav">
              <li><a href="{{ route('admin.dashboard') }}">Main Dashboard</a></li>
              @hasrole('admin|compiler')
              <li><a href="{{ route('admin.traders') }}">Traders</a></li>
              <li><a href="{{ route('admin.traders.create') }}">Create Trader</a></li>
              @endhasrole
              @hasrole('admin|customer service')
              <li><a href="{{ route('admin.users') }}">Users</a></li>
              @endhasrole
              @hasrole('admin|funder')
              <li><a href="{{ route('admin.withdrawals') }}">Withdrawals</a></li>
              <li><a href="{{ route('admin.transfer.funder') }}">Funder Transfer</a></li>
              @endhasrole
              @hasrole('admin')
              <li><a href="{{ route('admin.transactions') }}">Transaction</a></li>
              <li><a href="{{ route('admin.roles') }}">Roles</a></li>
              <li><a href="{{ route('admin.transfer') }}">Admin Transfer</a></li>
              @endhasrole
            </ul>
          </div>
        </li>
        @endhasanyrole
        @endguest
      </ul>
      <div class="uk-navbar-item uk-visible@m in-optional-nav">
        @guest
        <a href="{{ route('login') }}" class="uk-button uk-button-text"><i
            class="fas fa-user-circle uk-margin-small-right"></i>Log in</a>
        <a href="{{ route('register') }}" class="uk-button uk-button-primary uk-button-small uk-border-pill">Sign up</a>
        @else
        <a href="#" class="uk-button uk-button-primary uk-border-rounded uk-button-small"><i
            class="fas fa-user-circle uk-margin-small-right"></i>&#8358;
          {{ to_naira(auth()->user()->balance()) }}</a>
        @endguest
      </div>
    </div>
  </div>
</nav>