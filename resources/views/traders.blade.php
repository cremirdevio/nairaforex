@extends('layouts.app')

@section('content')
<!-- section content begin -->
<div class="uk-section">
  <div class="uk-container in-wave-4">
    <div class="uk-grid uk-flex uk-flex-center">
      <div class="uk-width-1-1 uk-flex uk-flex-between">
        <div>
          <h3>Remote Traders</h3>
        </div>

        <div id="layout" uk-tooltip="title: Toggle Layout">
          <span uk-icon="grid" id="grid-toggle" onclick="toggle()"></span>
          <span uk-icon="list" id="list-toggle" onclick="toggle()" ></span>
        </div>
      </div>
      <div class="uk-width-1-1" id="list-display">
        <table class="uk-table uk-table-divider uk-table-striped uk-text-small uk-text-center">
          <thead>
            <tr>
              <th class="uk-text-center"></th>
              <th class="uk-text-right">Estimated Returns</th>
              <th class="uk-text-right">Duration</th>
              <th class="uk-text-right">Experience</th>
              <th class="uk-text-right">MBG</th>
            </tr>
          </thead>
          <tbody>
            @forelse($traders as $trader)
            <tr>
              <td>
                <div class="uk-flex uk-flex-row">
                  <div class="uk-inline" style="height: 48px">
                    <span class="in-icon-wrap nf-icon-wrap uk-overflow-hidden">
                      <img
                      src="{{ $trader->getThumbnail() }}" alt="Icon" class="nf-icon-size">
                    </span>
                    <img src="{{ $trader->getFlag() }}" alt="Flag" class="flags-size nf-position-bottom-left">
                  </div>
                  <div class="uk-flex uk-flex-column uk-margin-left">
                    <h4 class="uk-margin-remove nf-table-trader-name cursor" data-src="{{ $trader->getThumbnail() }}" data-flag="{{ $trader->getFlag() }}"
                      onclick="showForm(this, {{ json_encode($trader) }}, '{{ route('traders.assign', $trader) }}')">
                      {{ $trader->name }}</h4>
                    <div>
                      {!! to_rating($trader->rating) !!}
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <div class="nairaforex-positive nf-table-cell uk-flex uk-flex-middle uk-flex-right">
                  <p class="uk-margin-remove nf-table-text nf-table-bold">{{ $trader->returns }}%</p>
                </div>
              </td>
              <td>
                <div class="nairaforex-positive nf-table-cell uk-flex uk-flex-middle uk-flex-right">
                  <p class="uk-margin-remove nf-table-text">{{ $trader->duration }} {{ $trader->duration_ }}</p>
                </div>
              </td>
              <td>
                <div class="nf-table-cell uk-flex uk-flex-middle uk-flex-right">
                  <p class="uk-margin-remove nf-table-text">{{ $trader->experience }}</p>
                </div>
              </td>
              <td>
                <div class="nf-table-cell uk-flex uk-flex-middle uk-flex-right">
                  <p class="uk-margin-remove nf-table-text">{{ $trader->mbg }}%</p>
                </div>
              </td>
            </tr>
            @empty
            <tr>
                <td colspan="9">
                  <p><span uk-icon="warning" class="uk-text-warning"></span></p>
                  <p>Error diplaying list!</p>
                </td>
              </tr>
            @endforelse

          </tbody>
        </table>

        {{ $traders->links() }}

      </div>

      <div class="uk-grid uk-text-center uk-width-1-1" id="grid-display">
        @forelse($traders as $trader)
        <div class="uk-width-1-3@s uk-width-1-4@m uk-margin-bottom">

          <div class="uk-card uk-card-default uk-card-body uk-padding-remove uk-overflow-hidden">
            <div class="uk-flex uk-flex-left uk-margin-remove uk-padding nf-card-head">
              <div class="uk-inline" style="height: 48px">
                <span class="in-icon-wrap nf-icon-wrap uk-overflow-hidden">
                  <img src="{{ $trader->getThumbnail() }}" alt="Icon" class="nf-icon-size">
                </span>
                <!-- <img src="img/flags/ng.svg" alt="Nigeria office" class="flags-size nf-position-bottom-left"> -->
              </div>
              <div class="uk-flex uk-flex-column uk-margin-left">
                <h4 class="uk-margin-remove nf-table-trader-name">{{ $trader->name }}</h4>
                <span class="uk-text-primary uk-text-left">
                {{ $trader->getCountry() }} <img src="{{ $trader->getFlag() }}" alt="Flag" class="flags-size">
                </span>
              </div>
            </div>
            <div class="uk-padding nf-card-body">
              <div class="uk-grid uk-margin-remove nf-card-info">
                <div class="uk-width-1-2 uk-flex uk-flex-column uk-text-left uk-padding-remove">
                  <p class="uk-text-small uk-margin-remove nairaforex-key uk-text-uppercase">Estimated Returns</p>
                  <p class="uk-text-lead nairaforex-value uk-margin-remove nairaforex-positive">{{ $trader->returns }}%
                  </p>
                </div>
                <div class="uk-width-1-2 uk-flex uk-flex-column uk-text-left uk-padding-remove">
                  <p class="uk-text-small uk-margin-remove nairaforex-key uk-text-uppercase">Duration</p>
                  <p class="uk-text-lead nairaforex-value uk-margin-remove">{{ $trader->duration }}
                    {{ $trader->duration_}}</p>
                </div>
              </div>
              <div class="uk-grid uk-margin-remove nf-card-info">
                <div class="uk-width-1-2 uk-flex uk-flex-column uk-text-left uk-padding-remove">
                  <p class="uk-text-small uk-margin-remove nairaforex-key uk-text-uppercase">Experience</p>
                  <p class="uk-text-lead nairaforex-value uk-margin-remove">{{ $trader->experience }}</p>
                </div>
                <div class="uk-width-1-2 uk-flex uk-flex-column uk-text-left uk-padding-remove">
                  <p class="uk-text-small uk-margin-remove nairaforex-key uk-text-uppercase">MBG</p>
                  <p class="uk-text-lead nairaforex-value uk-margin-remove nairaforex-positive">{{ $trader->mbg }}%</p>
                </div>
              </div>
              <div class="uk-grid uk-flex uk-flex-center uk-margin-remove nf-card-info">
                <div class="uk-width-2-3 uk-flex uk-flex-column uk-text-center uk-padding-remove">
                  <p class="uk-text-small uk-margin-remove nairaforex-key uk-text-uppercase">Rating <span>{{ $trader->rating }}</span>
                  </p>
                  <div>
                  {!! to_rating($trader->rating) !!}
                  </div>
                </div>
              </div>
              <a data-src="{{ $trader->getThumbnail() }}" data-flag="{{ $trader->getFlag() }}" onclick="showForm(this, {{ json_encode($trader) }}, '{{ route('traders.assign', $trader) }}')"
                class="uk-button uk-button-default uk-border-rounded uk-align-center uk-margin-remove">Assign
                trader<i class="fas fa-chevron-circle-right fa-xs uk-margin-small-left"></i></a>
            </div>
          </div>
        </div>

        @empty

        @endforelse

        {{ $traders->links() }}

      </div>


    </div>
  </div>
</div>
<!-- section content end -->

<div id="modal-sections" uk-modal>
  <div class="uk-modal-dialog">
    <button class="uk-modal-close-default" type="button" uk-close></button>
    <div class="uk-modal-header">
      <h2 class="uk-modal-title">Balance: {{ auth()->check() ? to_naira(auth()->user()->balance()) : '' }}</h2>
    </div>
    <form action="" id="trader-form" method="post">
      @csrf
      <!-- <input type="hidden" name="trader" value=""> -->
      <div class="uk-modal-body">
        <div class="uk-grid uk-margin-small-left">
          <div
            class="uk-width-2-5@s uk-flex uk-flex-left uk-margin-right@s uk-margin-small-bottom uk-padding uk-border-rounded nf-card-head">
            <div class="uk-inline" style="height: 52px">
              <span class="in-icon-wrap nf-icon-wrap uk-overflow-hidden">
                <img src="" alt="Nigeria office" id="modal-thumbnail" class="nf-icon-size">
              </span>
              <!-- <img src="img/flags/ng.svg" alt="Nigeria office" class="flags-size nf-position-bottom-left"> -->
            </div>
            <div class="uk-flex uk-flex-column uk-margin-left">
              <h4 class="uk-margin-remove nf-table-trader-name" id="modal-trader-name">Joseph O. A.</h4>
              <span class="uk-text-primary uk-text-left" id="modal-trader-country">
                 <img src="" id="modal-flag" alt="Nigeria office" class="flags-size">
              </span>
            </div>
          </div>

          <div class="uk-width-3-5@s">
            <div class="uk-margin uk-margin-small-bottom">
              <input class="uk-input uk-border-rounded" type="text" step="0.01" name="amount" id="amount"
                placeholder="Amount">
            </div>
            <div class="uk-margin-remove">
              <button class="uk-button uk-button-small uk-border-rounded" onclick="percent(event, 100)">100%</button>
              <button class="uk-button uk-button-small uk-border-rounded" onclick="percent(event, 75)">75%</button>
              <button class="uk-button uk-button-small uk-border-rounded" onclick="percent(event, 50)">50%</button>
              <button class="uk-button uk-button-small uk-border-rounded" onclick="percent(event, 25)">25%</button>
            </div>
          </div>
        </div>
      </div>
      <div class="uk-modal-footer uk-text-right">
        <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
        <button type="submit" class="uk-button uk-button-primary">Proceed</button>
      </div>
    </form>

  </div>
</div>
@endsection

@push('scripts')
<script>
$('#list-toggle').hide()
$('#grid-display').show()
$('#list-display').hide()

let authenticated = {{ auth()->check() ? 'true' : 'false' }}
let balance = {{ auth()->check() ? auth()->user()->balance() : 'null' }}

let screenWidth = screen.width
let canToggle = false
let list = true

if (screenWidth>=960) {
  $('#grid-toggle').hide()
  $('#list-toggle').show()
  
  $('#grid-display').hide()
  $('#list-display').show()
  canToggle = true
}

function toggle() {
  if (!canToggle) return;
  list = !list
  redraw()
}

function redraw() {
  if (list) {
    $('#list-display').show()
    $('#grid-display').hide()

    $('#list-toggle').show()
    $('#grid-toggle').hide()
  } else {
    $('#list-display').hide()
    $('#grid-display').show()

    $('#grid-toggle').show()
    $('#list-toggle').hide()
  }
}

function percent(e, value) {
  e.preventDefault()
  let total = (value / 100) * balance
  $('#amount').val(total / 100)
}

// $("#layout").click(function() {
//   console.log("Clicked")
// });

function showForm(element, trader, url) {
let imgsrc = $(element).data('src')
let flag = $(element).data('flag')

  if (!authenticated) {
    Toast.fire({
      icon: 'warning',
      title: 'Please log in!'
    })

    return;
  }
  $('#trader-form').attr('action', url)
  $('#modal-trader-name').text(trader.name)
  $('#modal-country').text(trader.country)
  $('#modal-thumbnail').attr('src', imgsrc)
  $('#modal-flag').attr('src', flag)

  UIkit.modal('#modal-sections').show();
}

$(window).resize(function() {
  screenWidth = screen.width
  
  if (screenWidth>=960) {
    $('#grid-toggle').hide()
    $('#list-toggle').show()
    
    $('#grid-display').hide()
    $('#list-display').show()
    canToggle = true
  } else {
    console.log(screenWidth)
    $('#grid-toggle').hide()
    $('#list-toggle').show()
    
    $('#grid-display').show()
    $('#list-display').hide()
    canToggle = false
    list = false
  }
  redraw()
})
</script>
@endpush

@push('styles')
<style>
#layout,
.cursor {
  cursor: pointer;
}
</style>
@endpush