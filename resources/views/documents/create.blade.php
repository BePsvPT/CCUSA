@extends('layouts.master')

@section('main')
  <div class="row">
    {!! Form::open([
        'route' => 'documents.store',
        'method' => 'POST',
        'files' => true,
        'class' => 'col s12 offset-m2 m8 offset-l3 l6',
    ]) !!}
      @include('documents._form', ['submitButton' => '新增'])
    {!! Form::close() !!}
  </div>
@endsection
