@extends('layouts.app')

@section('content')
<!-- section content begin -->
<div class="uk-section">
  <div class="uk-container in-wave-4">
    <div class="uk-grid uk-flex uk-flex-center">
      <div class="uk-width-1-1 uk-flex uk-flex-between">
        <div>
          <h3>Testimonials</h3>
        </div>

        <div id="layout" uk-tooltip="title: Create new testimonial">
          <a href="{{ route('admin.testimonials.create') }}"><span uk-icon="plus-circle"></span></a>
        </div>
      </div>
      <div class="uk-width-1-1" class="list-display">
        <div class="uk-overflow-auto">
          <table class="uk-table uk-table-divider uk-table-striped uk-text-small uk-text-center">
            <thead>
              <tr>
                <th class="uk-text-center"></th>
                <th class="uk-text-right">Message</th>
                <th class="uk-text-right">Name</th>
              </tr>
            </thead>
            <tbody>
              @forelse($testimonials as $testimonial)
              <tr>
                <td>
                  <a href="{{ route('admin.testimonials.edit', $testimonial) }}">
                    <div class="uk-flex uk-flex-row">
                      <div class="uk-inline" style="height: 48px">
                        <span class="in-icon-wrap nf-icon-wrap uk-overflow-hidden">
                          <img src="{{ $testimonial->getThumbnail() }}" alt="Icon" class="nf-icon-size">
                        </span>
                      </div>
                    </div>
                </td>
                <td>
                  <p class="uk-text-meta">
                    {{ $testimonial->message }}
                  </p>
                </td>
                <td>
                  <p class="uk-text-uppercase">
                    {{ $testimonial->name }}
                  </p>
                </td>
                </a>
              </tr>
              @empty
              <tr>
                <td colspan="3">
                  <p><span uk-icon="warning" class="uk-text-warning"></span></p>
                  <p>No Testimonial!</p>
                </td>
              </tr>
              @endforelse

            </tbody>
          </table>

          {{ $testimonials->links() }}
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