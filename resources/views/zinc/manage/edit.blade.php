@extends('layouts.master')

@section('main')
  <div class="row">
    {!! Form::model($zinc, ['route' => ['zinc.manage.update', 'manage' => $zinc->getAttribute('id')], 'method' => 'PATCH', 'class' => 'col s12 offset-m2 m8 offset-l3 l6']) !!}

    <div class="input-field col s12">
      {!! Form::select('year', \App\Models\Zinc::year(), null, ['required']) !!}
      {!! Form::label('year', '年份') !!}
    </div>

    <div class="input-field col s12">
      {!! Form::select('month', \App\Models\Zinc::month(), null, ['required']) !!}
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

    <div class="input-field col s12 center-align">
      <button class="btn waves-effect waves-light" type="submit">
        <span>更新</span>
        <i class="fa fa-paper-plane right"></i>
      </button>
    </div>

    @include('layouts.form-errors')

    {!! Form::close() !!}
  </div>
@endsection
