@extends('layouts.master')

@section('main')
    <div class="row">
        <div class="col s12 offset-m3 m6">
            <div class="card large">
                <div class="card-image">
                    <img src="{{ asset('assets/images/zinc/logo.svg') }}">
                </div>
                <div class="card-content">
                    <p class="flow-text">會刊</p>
                </div>
                <div class="card-action">
                    <a href="{{ route('zinc') }}" class="flow-text">
                        <span>Go! <i class="fa fa-external-link-square"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection