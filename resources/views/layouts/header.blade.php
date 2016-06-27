<nav class="breadcrumb-nav">
  <div class="nav-wrapper">
    <a href="{{ route('home') }}">
      <img src="{{ asset('assets/media/images/general/logo/banner.png') }}" height="84">
    </a>

    @foreach ($breadcrumbs as $breadcrumb)
      <a href="{{ $breadcrumb['link'] }}" class="breadcrumb">{{ $breadcrumb['text'] }}</a>
    @endforeach
  </div>
</nav>
