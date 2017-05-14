@extends('layouts.master')

@section('main')
  <div class="row">
    {!! Form::open([
      'route' => 'zinc.store',
      'method' => 'POST',
      'files' => true,
      'class' => 'col s12 offset-m1 m10'
    ]) !!}
      @include('zinc._form', ['submitButton' => '新增'])
    {!! Form::close() !!}
  </div>
@endsection
