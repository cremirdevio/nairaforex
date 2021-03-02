@extends('layouts.app')

@section('content')
<!-- section content begin -->
<div class="uk-section">
  <div class="uk-container">
    <div class="uk-grid uk-flex-center">

      <div class="uk-width-3-5@s">
        <h3>Edit Trader <span class="uk-text-meta">({{ $trader->name }})</span></h3>
        <div class="uk-grid-small" uk-grid>
          <div class="uk-inline uk-width-1-2@s" style="height: 48px">
            <span class="in-icon-wrap nf-icon-wrap uk-overflow-hidden">
              <img src="{{ $trader->getThumbnail() }}" alt="Nigeria office" class="nf-icon-size">
            </span>
            <img src="{{ $trader->getFlag() }}" alt="Nigeria office" class="flags-size nf-position-bottom-left">
          </div>
          <div class="uk-width-1-2@s">
            <form action="{{ route('admin.traders.icon', $trader) }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="uk-margin" uk-margin>
                <div uk-form-custom="target: true">
                  <input type="file" name="thumbnail">
                  <input class="uk-input uk-form-width-medium" type="text" placeholder="Select Image" disabled>
                </div>
                <button class="uk-button uk-button-default">Upload</button>
              </div>
            </form>
          </div>
        </div>
        <hr>
        <div>
          <form action="{{ route('admin.traders.store') }}" method="post" class="uk-grid-small" uk-grid>
            @csrf
            <div class="uk-width-1-2@s">
              <div class="uk-margin">
                <label class="uk-form-label">Trader's Name:</label>
                <input class="uk-input uk-border-rounded" type="text" name="name" value="{{ $trader->name }}"
                  placeholder="Trader's full name">
              </div>
              <div class="uk-margin">
                <label class="uk-form-label">Expected Returns:</label>
                <input class="uk-input uk-border-rounded" type="number" step="0.01" min="0" max="100"
                  value="{{ $trader->returns }}" name="returns" placeholder="Percentage Returns">
              </div>
              <div class="uk-margin">
                <label class="uk-form-label">Duration:</label>
                <input class="uk-input uk-border-rounded" type="number" name="duration" value="{{ $trader->duration }}"
                  placeholder="Duration.e.g 4">
              </div>
              <div class="uk-margin">
                <label class="uk-form-label" for="duration_">Duration in:</label>
                <select class="uk-select uk-border-rounded" id="duration_" name="duration_">
                  <option value="weeks" {{ $trader->duration_ == 'weeks' ? 'selected' : '' }}>Weeks</option>
                  <option value="months" {{ $trader->duration_ == 'months' ? 'selected' : '' }}>Months</option>
                  <option value="years" {{ $trader->duration_ == 'years' ? 'selected' : '' }}>Years</option>
                  <option value="days" {{ $trader->duration_ == 'days' ? 'selected' : '' }}>Days</option>
                </select>
              </div>
            </div>

            <div class="uk-width-1-2@s">
              <div class="uk-margin">
                <label class="uk-form-label">Experience:</label>
                <input class="uk-input uk-border-rounded" type="text" name="experience"
                  value="{{ $trader->experience }}" placeholder="Experience">
              </div>
              <div class="uk-margin">
                <label class="uk-form-label">Money Back Guarantee:</label>
                <input class="uk-input uk-border-rounded" type="number" step="0.01" min="0" max="100" name="mbg"
                  value="{{ $trader->mbg }}" placeholder="Money Back Guarantee">
              </div>
              <div class="uk-margin">
                <label class="uk-form-label">Rating:</label>
                <input class="uk-input uk-border-rounded" type="number" step="0.1" min="0" max="10" name="rating"
                  value="{{ $trader->rating }}" placeholder="Rating (1-10)">
              </div>
              <div class="uk-margin">
                <label class="uk-form-label">Country:</label>
                <select class="uk-select uk-border-rounded" name="nationality">
                  <option>Select Country</option>
                  @foreach(config('countries') as $key => $value))
                  <option value="{{ $key }}" {{ $trader->nationality == $key ? 'selected' : '' }}>
                    {{ $value }}
                  </option>
                  @endforeach
                </select>
              </div>
              <div class="uk-flex uk-flex-row uk-flex-between uk-flex-middle uk-text-right">
                <button class="uk-button uk-border-rounded uk-button-primary">Update</button>
              </div>
            </div>

          </form>

          <form action="{{ route('admin.traders.delete', $trader) }}" method="post">
            @csrf
            @method('delete')
            <div class="uk-flex uk-margin uk-flex-row uk-flex-between uk-flex-middle uk-text-right">
              <button class="uk-button uk-border-rounded uk-button-danger">Delete Trader</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- section content end -->

@endsection