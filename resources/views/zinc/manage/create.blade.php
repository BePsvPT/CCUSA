@extends('layouts.master')

@section('main')
    <h3 class="center-align">新增會刊</h3>

    <div class="row">
        {!! Form::open(['route' => 'zinc.manage.store', 'method' => 'POST', 'files' => true, 'class' => 'col s12 offset-m2 m8 offset-l3 l6']) !!}

        <div>
            {!! Form::label('year', '年份') !!}
            {!! Form::select('year', \App\Ccusa\Zinc::year(), Carbon\Carbon::now()->year, ['class' => 'browser-default', 'required']) !!}
        </div>

        <div>
            {!! Form::label('month', '月份') !!}
            {!! Form::select('month', \App\Ccusa\Zinc::month(), Carbon\Carbon::now()->month, ['class' => 'browser-default', 'required']) !!}
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

        <div class="file-field input-field">
            <div class="btn">
                <span>圖片</span>
                <input type="file" name="image[]" multiple required>
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Upload one or more files">
            </div>
        </div>

        <div class="center-align">
            <button class="btn waves-effect waves-light" type="submit">
                <span>新增</span>
                <i class="fa fa-paper-plane right"></i>
            </button>
        </div>

        @include('layouts.form-errors')

        {!! Form::close() !!}
    </div>
@endsection
