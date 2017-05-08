<a
  href="{{ $href }}"
  target="{{ $target or '_self' }}"
  rel="noopener noreferrer"
  class="{{ $class or '' }}"
>
  @if (isset($icon))
    <i class="fa fa-{{ is_array($icon) ? implode(' fa-', $icon) : $icon }}"></i>
  @endif

  @if (isset($title))
    <span>{{ $title }}</span>
  @endif
</a>
