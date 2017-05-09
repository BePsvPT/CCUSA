<a
  class="btn waves-effect waves-light {{ $color or 'red' }}"
  data-delete="{{ $target or 'tr' }}"
  data-url="{{ $url }}"
><i class="fa fa-{{ $icon or 'trash' }}"></i></a>
