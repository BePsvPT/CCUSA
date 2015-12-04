@if (count($errors) > 0)
    <br>

    <div class="red-text">
        <ul class="collection">
            @foreach ($errors->all() as $error)
                <li class="collection-item">
                    <i class="fa fa-exclamation-triangle"></i>
                    <span> {{ $error }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endif
