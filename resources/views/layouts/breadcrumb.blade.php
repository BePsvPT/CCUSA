@if (count($breadcrumbs))
    <nav>
        <div class="nav-wrapper blue">
            @foreach ($breadcrumbs as $breadcrumb)
                <a href="{{ $breadcrumb['link'] }}" class="breadcrumb">{{ $breadcrumb['text'] }}</a>
            @endforeach
        </div>
    </nav>
@endif
