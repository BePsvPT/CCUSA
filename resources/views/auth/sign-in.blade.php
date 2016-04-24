@extends('layouts.master')

@section('main')
    <div class="row">
        {!! Form::open(['route' => 'auth.sign-in', 'method' => 'POST', 'class' => 'col s10 offset-s1 m8 offset-m2']) !!}

        <div class="row">
            <div class="input-field col s12">
                <i class="material-icons prefix">account_circle</i>
                {!! Form::label('username', '帳號') !!}
                {!! Form::text('username', null, ['class' => 'validate', 'required']) !!}
            </div>

            <div class="input-field col s12">
                <i class="material-icons prefix">lock</i>
                {!! Form::label('password', '密碼') !!}
                {!! Form::password('password', ['class' => 'validate', 'required']) !!}
            </div>

            <div class="input-field col s12 center">
                <button class="btn waves-effect waves-light" type="submit">
                    <span>登入</span>
                    <i class="fa fa-paper-plane right"></i>
                </button>
            </div>

            <div class="input-field col s12">
                @include('layouts.form-errors')
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@endsection
