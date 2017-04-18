{{--{{ dd(Route::current()->parameters('cs')) }}--}}

@extends('layouts.master')

@section('main')
  <div class="row">
    {{ Form::model($cs, [
        'route' => ['cooperative-stores.update', 'cs' => $cs->getAttribute('link')],
        'method' => 'PATCH',
        'files' => true,
        'class' => 'col s12 offset-m1 m10',
    ]) }}
    @include('cooperative-stores._form', ['submitButton' => '更新'])
    {{ Form::close() }}
  </div>
@endsection
