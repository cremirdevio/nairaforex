@extends('layouts.app')

@section('content')
<!-- section content begin -->
<div class="uk-section">
  <div class="uk-container">
    <div class="uk-grid uk-flex-center">

      <div class="uk-width-3-5@s">
        <h3>Edit Testimonial</h3>
        <div class="uk-inline uk-width-1-2@s uk-margin" style="height: 48px">
          <span class="in-icon-wrap nf-icon-wrap uk-overflow-hidden">
            <img src="{{ $testimonial->getThumbnail() }}" alt="Icon" class="nf-icon-size">
          </span>
        </div>
        <div>
          <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="post" class="uk-grid-small"
            enctype="multipart/form-data" uk-grid>
            @csrf
            @method('put')
            <div class="uk-width-1-1@s">
              <div class="uk-margin">
                <input class="uk-input uk-border-rounded" type="text" name="name" value="{{ $testimonial->name }}"
                  placeholder="Name">
              </div>
              <div class="uk-margin">
                <textarea class="uk-textarea uk-border-rounded" name="message"
                  placeholder="Message">{{ $testimonial->message }}</textarea>
              </div>
              <div class="uk-margin">
                <label class="uk-form-label">Optional*</label>
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

          <form action="{{ route('admin.testimonials.delete', $testimonial) }}" method="post">
            @csrf
            @method('delete')
            <div class="uk-flex uk-margin uk-flex-row uk-flex-between uk-flex-middle uk-text-right">
              <button class="uk-button uk-border-rounded uk-button-danger">Delete Testimonial</button>
            </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- section content end -->

@endsection