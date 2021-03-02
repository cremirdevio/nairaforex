@extends('layouts.app')

@section('content')
<!-- section content begin -->
<div class="uk-section">
  <div class="uk-container in-wave-4">
    <div class="uk-grid uk-flex uk-flex-center">
      <div class="uk-width-1-1 uk-flex uk-flex-between">
        <div>
          <h3>Registered Remote Traders</h3>
        </div>

        <div id="layout" uk-tooltip="title: Create new trader">
          <a href="{{ route('admin.traders.create') }}"><span uk-icon="plus-circle"></span></a>
        </div>
      </div>
      <div class="uk-width-1-1" class="list-display">
        <div class="uk-overflow-auto">
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
                        <img src="{{ $trader->getThumbnail() }}" alt="Icon" class="nf-icon-size">
                      </span>
                      <img src="{{ $trader->getFlag() }}" alt="Nigeria office"
                        class="flags-size nf-position-bottom-left">
                    </div>
                    <div class="uk-flex uk-flex-column uk-margin-left">
                      <h4 class="uk-margin-remove nf-table-trader-name cursor">
                        <a href="{{ route('admin.traders.edit', $trader) }}">{{ $trader->name }}</a>
                      </h4>
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

              @endforelse

            </tbody>
          </table>

          {{ $traders->links() }}
        </div>

      </div>


    </div>
  </div>
</div>
<!-- section content end -->

@endsection

@push('scripts')
<script>
let authenticated = {
  {
    auth() - > check() ? 'true' : 'false'
  }
}
let balance = {
  {
    auth() - > check() ? auth() - > user() - > balance() : 'null'
  }
}

function percent(e, value) {
  e.preventDefault()
  let total = (value / 100) * balance
  $('#amount').val(total / 100)
}

$("#layout").click(function() {
  console.log("Clicked")
});

function showForm(element, trader, url) {
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
  $('#modal-thumbnail').attr('src', trader.thumbnail)

  UIkit.modal('#modal-sections').show();
}
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