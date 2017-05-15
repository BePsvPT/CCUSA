<a
  href="{{ $href }}"
  target="{{ $target or '_self' }}"
  rel="noopener noreferrer"
  class="{{ $class or '' }}"
>
  @isset($icon)
    <i class="fa fa-{{ is_array($icon) ? implode(' fa-', $icon) : $icon }}"></i>
  @endisset

  @isset($title)
    <span>{{ $title }}</span>
  @endisset
</a>
