@extends('layouts.master')

@section('main')
  <div class="row">
    {!! Form::model($document, [
      'route' => ['documents.update', 'hashid' => $document->getHashId()],
      'method' => 'PATCH',
      'class' => 'col s12 offset-m1 m10',
    ]) !!}
      @include('documents._form', ['submitButton' => '更新'])
    {!! Form::close() !!}
  </div>
@endsection
