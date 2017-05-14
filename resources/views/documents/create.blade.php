@extends('layouts.master')

@section('main')
  <div class="row">
    {!! Form::open([
      'route' => 'documents.store',
      'method' => 'POST',
      'files' => true,
      'class' => 'col s12 offset-m1 m10',
    ]) !!}
      @include('documents._form', ['submitButton' => '新增'])
    {!! Form::close() !!}
  </div>
@endsection
