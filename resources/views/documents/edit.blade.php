@extends('layouts.master')

@section('main')
    <div class="row">
        {{ Form::model($document, [
            'route' => ['documents.update', 'documents' => $document->getKey()],
            'method' => 'PATCH',
            'class' => 'col s12 offset-m2 m8 offset-l3 l6',
        ]) }}
            @include('documents._form', ['submitButton' => '更新'])
        {{ Form::close() }}
    </div>
@endsection
