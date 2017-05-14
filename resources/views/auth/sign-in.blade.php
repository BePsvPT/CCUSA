@extends('layouts.master')

@section('title', '登入 | 國立中正大學學生會')

@section('main')
  <div class="row">
    {!! Form::open(['route' => 'auth.sign-in', 'method' => 'POST', 'class' => 'col s10 offset-s1 m8 offset-m2']) !!}
      @include('layouts.form-errors')

      <div class="input-field">
        <i class="material-icons prefix">account_circle</i>
        {!! Form::label('username', '帳號') !!}
        {!! Form::text('username', null, ['class' => 'validate', 'autofocus', 'required']) !!}
      </div>

      <div class="input-field">
        <i class="material-icons prefix">lock</i>
        {!! Form::label('password', '密碼') !!}
        {!! Form::password('password', ['class' => 'validate', 'required']) !!}
      </div>

      @include('components.submit-button', ['submitButton' => '登入'])
    {!! Form::close() !!}
  </div>
@endsection
