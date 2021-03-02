@extends('layouts.app')

@section('content')
<!-- section content begin -->
<div class="uk-section">
  <div class="uk-container">
    <div class="uk-grid uk-flex-center">

      <div class="uk-width-3-5@s">
        <h3>Create Testimonial</h3>
        <div>
          <form action="{{ route('admin.testimonials.store') }}" method="post" class="uk-grid-small"
            enctype="multipart/form-data" uk-grid>
            @csrf

            <div class="uk-width-1-1@s">
              <div class="uk-margin">
                <input class="uk-input uk-border-rounded" type="text" name="name" value="{{ old('name') }}"
                  placeholder="Name">
              </div>
              <div class="uk-margin">
                <textarea class="uk-textarea uk-border-rounded" name="message"
                  placeholder="Message">{{ old('message') }}</textarea>
              </div>
              <div class="uk-margin">
                <div uk-form-custom="target: true">
                  <input type="file" name="thumbnail">
                  <input class="uk-input uk-form-width-medium" type="text" placeholder="Select Image" disabled>
                </div>
              </div>
              <div class="uk-flex uk-flex-row uk-flex-between uk-flex-middle uk-text-right">
                <button class="uk-button uk-border-rounded uk-button-primary">Add</button>
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