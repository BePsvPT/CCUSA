@extends('layouts.master')

@section('main')
  <div class="row">
    {!! Form::open([
        'route' => 'cooperative-stores.store',
        'method' => 'POST',
        'files' => true,
        'class' => 'col s12 offset-m1 m10',
    ]) !!}
      @include('cooperative-stores._form', ['submitButton' => '新增'])
    {!! Form::close() !!}
  </div>
@endsection
