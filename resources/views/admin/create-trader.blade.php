@extends('layouts.app')

@section('content')
<!-- section content begin -->
<div class="uk-section">
  <div class="uk-container">
    <div class="uk-grid uk-flex-center">

      <div class="uk-width-3-5@s">
        <h3>Create Trader</h3>
        <div>
          <form action="{{ route('admin.traders.store') }}" method="post" class="uk-grid-small" uk-grid>
            @csrf
            <div class="uk-width-1-2@s">
              <div class="uk-margin">
                <input class="uk-input uk-border-rounded" type="text" name="name" value="{{ old('name') }}"
                  placeholder="Trader's full name">
              </div>
              <div class="uk-margin">
                <input class="uk-input uk-border-rounded" type="number" step="0.01" min="0" max="100" name="returns"
                  value="{{ old('returns') }}" placeholder="Percentage Returns">
              </div>
              <div class="uk-margin">
                <input class="uk-input uk-border-rounded" type="number" name="duration" value="{{ old('duration') }}"
                  placeholder="Duration.e.g 4">
              </div>
              <div class="uk-margin">
                <label class="uk-form-label" for="duration_">Duration in:</label>
                <select class="uk-select uk-border-rounded" id="duration_" name="duration_">
                  <option value="weeks" {{ old('duration_') == 'weeks' ? 'selected' : '' }}>Weeks</option>
                  <option value="months" {{ old('duration_') == 'months' ? 'selected' : '' }}>Months</option>
                  <option value="years" {{ old('duration_') == 'years' ? 'selected' : '' }}>Years</option>
                  <option value="days" {{ old('duration_') == 'days' ? 'selected' : '' }}>Days</option>
                </select>
              </div>
            </div>

            <div class="uk-width-1-2@s">
              <div class="uk-margin">
                <input class="uk-input uk-border-rounded" type="text" name="experience" value="{{ old('experience') }}"
                  placeholder="Experience">
              </div>
              <div class="uk-margin">
                <input class="uk-input uk-border-rounded" type="number" step="0.01" min="0" max="200" name="mbg"
                  value="{{ old('mbg') }}" placeholder="Money Back Guarantee">
              </div>
              <div class="uk-margin">
                <input class="uk-input uk-border-rounded" type="number" step="0.1" min="0" max="10" name="rating"
                  value="{{ old('rating') }}" placeholder="Rating (1-10)">
              </div>
              <div class="uk-margin">
                <select class="uk-select uk-border-rounded" name="nationality">
                  <option>Select Country</option>
                  @foreach(config('countries') as $key => $value))
                  <option value="{{ $key }}" {{ old('nationality') == $key ? 'selected' : '' }}>
                    {{ $value }}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="uk-flex uk-flex-row uk-flex-between uk-flex-middle uk-text-right">
                <button class="uk-button uk-border-rounded uk-button-primary">Create</button>
              </div>
            </div>

          </form>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- section content end -->

@endsection