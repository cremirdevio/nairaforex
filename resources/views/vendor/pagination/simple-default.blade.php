@if ($paginator->hasPages())
<!-- <nav>
        <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="disabled" aria-disabled="true"><span>@lang('pagination.previous')</span></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a></li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a></li>
            @else
                <li class="disabled" aria-disabled="true"><span>@lang('pagination.next')</span></li>
            @endif
        </ul>
    </nav> -->

<ul class="uk-pagination uk-flex-center">
  {{-- Previous Page Link --}}
  @if ($paginator->onFirstPage())
  <li class="uk-disabled" aria-disabled="true"><a href="#"><span uk-pagination-previous></span> Previous</a></li>
  @else
  <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev"><span uk-pagination-previous></span> Previous</a></li>
  @endif

  {{-- Next Page Link --}}
  @if ($paginator->hasMorePages())
  <li class=""><a href="{{ $paginator->nextPageUrl() }}" rel="next">Next <span class="uk-margin-small-left"
        uk-pagination-next></span></a></li>
  @else
  <li class=" uk-disabled" aria-disabled="true"><a href="#">Next <span class="uk-margin-small-left"
        uk-pagination-next></span></a></li>
  @endif
</ul>
@endif