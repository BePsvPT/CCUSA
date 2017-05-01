@if ($paginator->hasPages())
  <ul class="pagination center-align none-select">
    {{-- Previous Page Link --}}
    @if ($paginator->onFirstPage())
      <li class="disabled"><i class="fa fa-angle-left"></i></li>
    @else
      <li class="waves-effect">
        <a href="{{ $paginator->appends(Request::query())->previousPageUrl() }}" rel="prev">
          <i class="fa fa-angle-left"></i>
        </a>
      </li>
    @endif

    <span>　</span>

    {{-- Next Page Link --}}
    @if ($paginator->hasMorePages())
      <li class="waves-effect">
        <a href="{{ $paginator->appends(Request::query())->nextPageUrl() }}" rel="next">
          <i class="fa fa-angle-right"></i>
        </a>
      </li>
    @else
      <li class="disabled"><i class="fa fa-angle-right"></i></li>
    @endif
  </ul>
@endif
