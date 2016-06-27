@if (count($errors) > 0)
  <div class="input-field col s12">
    <div class="red-text">
      <ul class="collection">
        @foreach ($errors->all() as $error)
          <li class="collection-item">
            <i class="fa fa-exclamation-triangle"></i>
            <span>{{ $error }}</span>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
@endif
