@if (1 !== $pagination->currentPage() || $pagination->hasMorePages())
  <ul class="pagination center-align">
    @if (1 !== $pagination->currentPage())
      <li class="waves-effect">
        <a href="{{ $pagination->appends(Request::query())->previousPageUrl() }}"><i class="fa fa-angle-left"></i></a>
      </li>
    @else
      <li class="disabled">
        <a href="#!"><i class="fa fa-angle-left"></i></a>
      </li>
    @endif

    @if ($pagination->hasMorePages())
      <li class="waves-effect">
        <a href="{{ $pagination->appends(Request::query())->nextPageUrl() }}"><i class="fa fa-angle-right"></i></a>
      </li>
    @else
      <li class="disabled">
        <a href="#!"><i class="fa fa-angle-right"></i></a>
      </li>
    @endif
  </ul>
@endif
