@include('layouts.form-errors')

<div class="input-field">
  {!! Form::select('year', \App\Models\Zinc::year(), isset($zinc) ? null : \Carbon\Carbon::now()->year, ['required']) !!}
  {!! Form::label('year', '年份') !!}
</div>

<div class="input-field">
  {!! Form::select('month', \App\Models\Zinc::month(), isset($zinc) ? null : \Carbon\Carbon::now()->month, ['required']) !!}
  {!! Form::label('month', '月份') !!}
</div>

<div class="input-field">
  {!! Form::label('topic', '主題') !!}
  {!! Form::text('topic', null, ['class' => 'validate', 'length' => 255, 'required']) !!}
</div>

<div>
  <p>
    {!! Form::checkbox('published', true, isset($zinc) ? ! is_null($zinc->getAttribute('published_at')) : null, ['id' => 'published']) !!}
    {!! Form::label('published', '發佈') !!}
  </p>
</div>

@if (Route::currentRouteNamed('zinc.create'))
  <div class="file-field input-field">
    <div class="btn">
      <span>圖片</span>
      <input type="file" name="image[]" multiple required>
    </div>

    <div class="file-path-wrapper">
      <input class="file-path validate" type="text" placeholder="Upload one or more files">
    </div>
  </div>
@endif

@include('components.submit-button', compact('submitButton'))
