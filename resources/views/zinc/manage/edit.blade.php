@extends('layouts.master')

@section('main')
    <h3 class="center-align">編輯會刊</h3>

    <div class="row">
        {!! Form::model($zinc, ['route' => ['zinc.manage.update', 'manage' => $zinc->getAttribute('id')], 'method' => 'PATCH', 'files' => true, 'class' => 'col s12 offset-m2 m8 offset-l3 l6']) !!}

        <div>
            {!! Form::label('year', '年份') !!}
            {!! Form::select('year', \App\Ccusa\Zinc::year(), null, ['class' => 'browser-default', 'required']) !!}
        </div>

        <div>
            {!! Form::label('month', '月份') !!}
            {!! Form::select('month', \App\Ccusa\Zinc::month(), null, ['class' => 'browser-default', 'required']) !!}
        </div>

        <div class="input-field">
            {!! Form::label('topic', '主題') !!}
            {!! Form::text('topic', null, ['class' => 'validate', 'length' => 255, 'required']) !!}
        </div>

        <div>
            <p>
                {!! Form::checkbox('published', true, null, ['id' => 'published']) !!}
                {!! Form::label('published', '發佈') !!}
            </p>
        </div>

        <div class="center-align">
            <button class="btn waves-effect waves-light" type="submit">
                <span>更新</span>
                <i class="fa fa-paper-plane right"></i>
            </button>
        </div>

        @include('layouts.form-errors')

        {!! Form::close() !!}
    </div>
@endsection
