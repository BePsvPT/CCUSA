@include('layouts.form-errors')

<div class="input-field">
  <i class="material-icons prefix">recent_actors</i>
  {!! Form::label('name', '店名') !!}
  {!! Form::text('name', null, ['class' => 'validate', 'maxlength' => 191, 'required']) !!}
</div>

<div class="input-field">
  <i class="material-icons prefix">today</i>
  {!! Form::input('date', 'began_at', null, ['class' => 'validate', 'required']) !!}
  {!! Form::label('began_at', '開始日期', ['class' => 'active']) !!}
</div>

<div class="input-field">
  <i class="material-icons prefix">date_range</i>
  {!! Form::input('date', 'ended_at', null, ['class' => 'validate', 'required']) !!}
  {!! Form::label('ended_at', '結束日期', ['class' => 'active']) !!}
</div>

<div class="input-field">
  <i class="material-icons prefix">phone</i>
  {!! Form::label('phone', '電話') !!}
  {!! Form::text('phone', null, ['class' => 'validate', 'maxlength' => 16, 'required']) !!}
</div>

<div class="input-field">
  <i class="material-icons prefix">place</i>
  {!! Form::label('address', '地址') !!}
  {!! Form::text('address', null, ['class' => 'validate', 'maxlength' => 64, 'required']) !!}
</div>

<div class="input-field">
  <i class="material-icons prefix">group_work</i>
  {!! Form::text('group', null, ['list' => 'groupName', 'class' => 'validate', 'required', 'maxlength' => 48]) !!}
  {!! Form::label('group', '群組') !!}

  <datalist id="groupName">
    @foreach ($groups as $item)
      <option value="{{ $item }}">{{ $item }}</option>
    @endforeach
  </datalist>
</div>

<div class="input-field">
  <p>描述</p>
  {!! Form::textarea('description', null, ['class' => 'tinymce-editor']) !!}
</div>

<div class="input-field">
  <p>營業時間</p>
  {!! Form::textarea('business_hours', null, ['class' => 'tinymce-editor']) !!}
</div>

<div class="file-field input-field">
  <div class="btn">
    <span>封面相片</span>
    {!! Form::input('file', 'cover[]', null, ['accept' => 'image/*']) !!}
  </div>

  <div class="file-path-wrapper">
    <input class="file-path validate" type="text" {{ isset($cs) ? '' : 'required' }} placeholder="{{ isset($cs) ? '如不需更新，則留空' : '必要' }}">
  </div>
</div>

<div class="file-field input-field">
  <div class="btn">
    <span>特色圖片</span>
    {!! Form::input('file', 'gallery[]', null, ['accept' => 'image/*', 'multiple']) !!}
  </div>

  <div class="file-path-wrapper">
    <input class="file-path validate" type="text" placeholder="{{ isset($cs) ? '如不需更新，則留空' : '可選' }}">
  </div>
</div>

<div>
  <p>
    {!! Form::checkbox('published', true, isset($cs) ? ! is_null($cs->getAttribute('published_at')) : null, ['id' => 'published']) !!}
    {!! Form::label('published', '發布') !!}
  </p>
</div>

@include('components.submit-button', compact('submitButton'))

@push('scripts')
  <script src="{{ asset('assets/tinymce/tinymce.min.js') }}" defer></script>
@endpush
