@if (count($breadcrumbs))
    <nav>
        <div class="nav-wrapper blue">
            <div class="col s12">
                @foreach ($breadcrumbs as $breadcrumb)
                    <a href="{{ $breadcrumb['link'] }}" class="breadcrumb">{{ $breadcrumb['text'] }}</a>
                @endforeach
            </div>
        </div>
    </nav>

    <br>
@endif
