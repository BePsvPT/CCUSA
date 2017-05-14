@extends('layouts.master')

@section('main')
  <div class="row">
    {!! Form::model($zinc, [
      'route' => ['zinc.update', 'zinc' => $zinc->getAttribute('id')],
      'method' => 'PATCH',
      'class' => 'col s12 offset-m1 m10'
    ]) !!}
      @include('zinc._form', ['submitButton' => '更新'])
    {!! Form::close() !!}
  </div>
@endsection
