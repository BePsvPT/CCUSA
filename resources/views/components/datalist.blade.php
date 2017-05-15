<datalist id="groupName">
  @foreach ($groups as $item)
    <option value="{{ $item }}">{{ $item }}</option>
  @endforeach
</datalist>
