@extends('layouts.master')

@section('main')
    <div class="valign row">
        <div class="col s12 m6 offset-l1 l5">
            <div class="card hoverable">
                <div class="card-image">
                    <a href="{{ route('zinc') }}">
                        <img src="{{ asset('assets/images/guide/zinc.png') }}">
                    </a>
                </div>
                <div class="card-action">
                    <a href="{{ route('zinc') }}" class="flow-text">
                        <span>會刊 <i class="fa fa-external-link-square"></i></span>
                    </a>
                </div>
            </div>
        </div>

        <div class="col s12 m6 l5">
            <div class="card hoverable">
                <div class="card-image">
                    <a href="{{ route('document') }}">
                        <img src="{{ asset('assets/images/guide/document.png') }}">
                    </a>
                </div>
                <div class="card-action">
                    <a href="{{ route('document') }}" class="flow-text">
                        <span>文件下載 <i class="fa fa-external-link-square"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection