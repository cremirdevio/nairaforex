@extends('layouts.app')

@section('content')
<!-- section content begin -->
<div class="uk-section">
  <div class="uk-container">
    <div class="uk-grid-match uk-grid-medium uk-child-width-1-2@s uk-child-width-1-3@m in-card-10" data-uk-grid>
      <div class="uk-width-1-1">
        <h1 class="uk-margin-remove">Admin <span class="in-highlight">Dashboard</span></h1>
        <p class="uk-text-lead uk-text-muted uk-margin-remove">Manage Nairaforex with ease.</p>

      </div>

      <div>
        <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-light in-card-green">
          <i class="fas fa-seedling fa-lg in-icon-wrap uk-margin-bottom"></i>
          <h4 class="uk-margin-top">
            <a href="{{ route('traders') }}">Traders ({{ $traders }})<i
                class="fas fa-chevron-right uk-float-right"></i></a>
          </h4>
        </div>
      </div>
      <div>
        <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-light in-card-blue">
          <i class="fas fa-chart-bar fa-lg in-icon-wrap uk-margin-bottom"></i>
          <h4 class="uk-margin-top">
            <a href="{{ route('admin.transactions') }}">Transactions ({{ $transactions }})<i
                class="fas fa-chevron-right uk-float-right"></i></a>
          </h4>
        </div>
      </div>
      <div>
        <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-light in-card-purple">
          <i class="fas fa-chart-pie fa-lg in-icon-wrap uk-margin-bottom"></i>
          <h4 class="uk-margin-top">
            <a href="{{ route('admin.withdrawals') }}">Withdrawals ({{ $withdrawals }})<i
                class="fas fa-chevron-right uk-float-right"></i></a>
          </h4>
        </div>
      </div>
      <div>
        <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-light in-card-navy">
          <i class="fas fa-chalkboard-teacher fa-lg in-icon-wrap uk-margin-bottom"></i>
          <h4 class="uk-margin-top">
            <a href="{{ route('admin.users') }}">Users ({{ $users }})<i
                class="fas fa-chevron-right uk-float-right"></i></a>
          </h4>
        </div>
      </div>
      <div>
        <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-light in-card-grey">
          <i class="fas fa-funnel-dollar fa-lg in-icon-wrap uk-margin-bottom"></i>
          <h4 class="uk-margin-top">
            <a href="{{ route('admin.withdrawals') }}?status=pending">Pending Withdrawals ({{ $pending_withdrawals }})<i
                class="fas fa-chevron-right uk-float-right"></i></a>
          </h4>
        </div>
      </div>
      <div>
        <div class="uk-card uk-card-default uk-card-body uk-border-rounded uk-light in-card-orange">
          <i class="fas fa-handshake fa-lg in-icon-wrap uk-margin-bottom"></i>
          <h4 class="uk-margin-top">
            <a href="{{ route('admin.testimonials') }}">Testimonials ({{ $testimonials }})<i
                class="fas fa-chevron-right uk-float-right"></i></a>
          </h4>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- section content end -->

@endsection