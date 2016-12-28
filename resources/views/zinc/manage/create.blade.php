@extends('layouts.master')

@section('main')
  <div class="row">
    {!! Form::open(['route' => 'zinc.manage.store', 'method' => 'POST', 'files' => true, 'class' => 'col s12 offset-m2 m8 offset-l3 l6']) !!}

    <div class="input-field col s12">
      {!! Form::select('year', \App\Models\Zinc::year(), $now->year, ['required']) !!}
      {!! Form::label('year', '年份') !!}
    </div>

    <div class="input-field col s12">
      {!! Form::select('month', \App\Models\Zinc::month(), $now->month, ['required']) !!}
      {!! Form::label('month', '月份') !!}
    </div>

    <div class="input-field col s12">
      {!! Form::label('topic', '主題') !!}
      {!! Form::text('topic', null, ['class' => 'validate', 'length' => 255, 'required']) !!}
    </div>

    <div class="col s12">
      <p>
        {!! Form::checkbox('published', true, null, ['id' => 'published']) !!}
        {!! Form::label('published', '發佈') !!}
      </p>
    </div>

    <div class="file-field input-field col s12">
      <div class="btn">
        <span>圖片</span>
        <input type="file" name="image[]" multiple required>
      </div>

      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="Upload one or more files">
      </div>
    </div>

    <div class="input-field col s12 center-align">
      <button class="btn waves-effect waves-light" type="submit">
        <span>新增</span>
        <i class="fa fa-paper-plane right"></i>
      </button>
    </div>

    @include('layouts.form-errors')

    {!! Form::close() !!}
  </div>
@endsection
