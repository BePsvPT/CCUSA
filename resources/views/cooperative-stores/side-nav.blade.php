<ul id="slide-out" class="side-nav">
  <li><a class="subheader">分類</a></li>

  @foreach ($groups as $name => $group)
    <li><div class="divider"></div></li>

    <li>
      <a href="{{ route('cooperative-stores.index', ['group' => $name]) }}">{{ $name }}</a>
    </li>

    @foreach ($group as $type)
      <li style="padding: 0 16px;">
        <a href="{{ route('cooperative-stores.index', ['group' => $type]) }}">{{ $type }}</a>
      </li>
    @endforeach
  @endforeach
</ul>

<a
  href="#"
  data-activates="slide-out"
  class="button-collapse waves-effect waves-light btn"
  style="margin-bottom: 1rem;"
>
  <i class="fa fa-bars" aria-hidden="true"></i> 分類
</a>
