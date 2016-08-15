<nav class="breadcrumb-nav">
  <div class="nav-wrapper">
    @foreach ($breadcrumbs as $breadcrumb)
      <a href="{{ $breadcrumb->url }}" class="breadcrumb">
        @if(isset($breadcrumb->img))
          <img src="{{ $breadcrumb->img }}" height="84">
        @endif

        @unless(isset($breadcrumb->notitle))
          <span>{{ $breadcrumb->title }}</span>
        @endunless
      </a>
    @endforeach
  </div>
</nav>
