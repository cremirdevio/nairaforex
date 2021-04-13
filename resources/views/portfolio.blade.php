@extends('layouts.app')

@section('content')

<!-- section content begin -->
<div class="uk-section">
  <div class="uk-container in-wave-4">
    <div class="uk-grid uk-flex uk-flex-center">
      <div class="uk-width-1-1 uk-margin-small-bottom">
        <h1 class="uk-margin-remove uk-margin-small-bottom">My <span class="in-highlight">Portfolio</span></h1>
        <p class="uk-text uk-text-muted uk-margin-remove">Watch your capital grow.</p>
        <hr>
      </div>

      <div class="uk-grid uk-text-center uk-width-1-1">
        @php $ids = array(); @endphp
        @forelse($response as $trade)
        <div class="uk-width-1-3@s uk-width-1-4@m uk-margin-bottom">
          <div class="uk-card uk-card-default uk-card-body uk-padding-remove uk-overflow-hidden">
            <div class="uk-flex uk-flex-left uk-margin-remove uk-padding nf-card-head">
              <div class="uk-inline" style="height: 48px">
                <span class="in-icon-wrap nf-icon-wrap uk-overflow-hidden">
                  <img src="{{ $trade['data']->getThumbnail() }}" alt="Icon profile" class="nf-icon-size">
                </span>
                <!-- <img src="img/flags/ng.svg" alt="Nigeria office" class="flags-size nf-position-bottom-left"> -->
              </div>
              <div class="uk-flex uk-flex-column uk-margin-left">
                <h4 class="uk-margin-remove nf-table-trader-name">{{ $trade['data']->name }}</h4>
                <span class="uk-text-primary uk-text-left">
                  {{ $trade['data']->getCountry() }} <img src="{{ $trade['data']->getFlag() }}" alt="Nigeria office"
                    class="flags-size">
                </span>
              </div>
            </div>
            <div class="uk-padding nf-card-body">
              <div class="uk-grid uk-margin-remove nf-card-info">
                <div class="uk-width-1-2 uk-flex uk-flex-column uk-text-left uk-padding-remove">
                  <p class="uk-text-small uk-margin-remove nairaforex-key uk-text-uppercase">Estimated Returns</p>
                  <p class="uk-text-lead nairaforex-value uk-margin-remove nairaforex-positive">
                    {{ $trade['data']->returns }}%</p>
                </div>
                <div class="uk-width-1-2 uk-flex uk-flex-column uk-text-left uk-padding-remove">
                  <p class="uk-text-small uk-margin-remove nairaforex-key uk-text-uppercase">Duration</p>
                  <p class="uk-text-lead nairaforex-value uk-margin-remove">{{ $trade['data']->getDuration() }}</p>
                </div>
              </div>
              <div class="uk-grid uk-margin-remove nf-card-info">
                <div class="uk-width-1-2 uk-flex uk-flex-column uk-text-left uk-padding-remove">
                  <p class="uk-text-small uk-margin-remove nairaforex-key uk-text-uppercase">Experience</p>
                  <p class="uk-text-lead nairaforex-value uk-margin-remove">{{ $trade['data']->experience }}</p>
                </div>
                <div class="uk-width-1-2 uk-flex uk-flex-column uk-text-left uk-padding-remove">
                  <p class="uk-text-small uk-margin-remove nairaforex-key uk-text-uppercase">MBG</p>
                  <p class="uk-text-lead nairaforex-value uk-margin-remove nairaforex-positive">
                    {{ $trade['data']->mbg }}%</p>
                </div>
              </div>
              <div class="uk-grid uk-flex uk-flex-center uk-margin-remove nf-card-info">
                <div class="uk-width-2-3 uk-flex uk-flex-column uk-text-center uk-padding-remove">
                  <p class="uk-text-small uk-margin-remove nairaforex-key uk-text-uppercase">Rating
                    <span>{{ $trade['data']->rating }}</span>
                  </p>
                  <div>
                    {!! to_rating($trade['data']->rating) !!}
                  </div>
                </div>
              </div>

              @foreach($trade['portfolios'] as $portfolio)

              @php $ids[] = $trade['data']->id.'_'.$portfolio->transaction_id @endphp
              <div class="uk-grid uk-flex uk-flex-center uk-margin-remove nf-card-info">
                <div class="uk-width-1-1 uk-flex uk-flex-column uk-text-left uk-padding-remove">
                  @if(!$trade['data']->isCompleted($portfolio->end_date))
                  <p class="uk-text-small uk-margin-remove nairaforex-key uk-text-uppercase"> <i
                      class="fa fa-clock uk-text-success"></i>
                    <span id="{{ $trade['data']->id.'_'.$portfolio->transaction_id }}"
                      data-countdown="{{ $portfolio->end_date }}">[2D 3h:4min]
                    </span>
                  </p>
                  @elseif($portfolio->status === 'pending')
                  <p class="uk-text-small uk-margin-remove uk-text-uppercase uk-text-secondary uk-text-center">Cycle
                    Complete </p>
                  <form class="uk-flex uk-flex-center uk-margin-small"
                    action="{{ route('activate.payment', $portfolio->id) }}" method="post">
                    @csrf
                    <button type="submit" class="uk-button uk-button-primary uk-border-rounded uk-button-small">Get
                      Payment Now</button>
                  </form>
                  @else
                  <div class="uk-tile uk-tile-secondary uk-padding-small uk-margin-small">
                    <p class="uk-text-small uk-margin-remove uk-text-uppercase uk-text-success uk-text-center">Paid Out
                      <i class="fa fa-check"></i>
                    </p>
                  </div>
                  @endif

                  <div class="r-card__profit">
                    <div class="r-card__profit-head">
                      <div class="r-card__profit-title">&#8358;{{ to_money_format($portfolio->amount) }}</div>
                      <div class="r-card__profit-title">&#8358;{{ $trade['data']->getTotalReturns($portfolio->amount) }}
                      </div>
                    </div>
                    @php $pf = App\Models\TraderUser::find($portfolio->id); @endphp
                    @php $perc = $pf->getGrowth($portfolio->created_at); @endphp
                    <div class="r-card__profit-body" uk-tooltip="title: Percentage Growth: {{ $perc }}%">
                      <div class="r-card__profit-body-line _positive" style="width: {{ $perc }}%;"></div>
                      <div class="r-card__profit-body-line _negative" style="width: {{ 100 - $perc }}%;"></div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
        </div>
        @empty
        <div class="uk-tile bg-primary uk-padding-large">
          <p>You do not have capital assigned to any remote traders. Please click on Assign Remote traders below to
            assign one or more traders to your capital.</p>
          <a class="uk-button uk-button-secondary" href="{{ route('traders') }}">Assign Remote Traders</a>
        </div>
        @endforelse
      </div>


    </div>
  </div>
</div>
<!-- section content end -->


@endsection

@push('scripts')
<script type="text/javascript" src="//cdn.rawgit.com/hilios/jQuery.countdown/2.0.4/dist/jquery.countdown.min.js">
</script>
<script>
// let list = @json($ids);

// for (let i = 0; i < list.length; i++) {
//   countdown(list[i]);
// }

// Format: [2D 3H:4MIN]
$(function() {
  $('[data-countdown]').each(function() {
    var $this = $(this),
      finalDate = $(this).data('countdown');
    $this.countdown(finalDate, function(event) {
      $this.html(event.strftime('[%DD %HH:%MMIN:%SS]'));
    });
  });
});
</script>
@endpush