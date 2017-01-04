@extends('layouts.master')

@section('main')
  <div class="row">
    <div class="col s12 m6 offset-l1 l5">
      <div class="card hoverable">
        <div class="card-image">
          <a href="{{ route('zinc.index') }}">
            <img src="{{ asset('assets/media/images/general/guide/zinc.png') }}">
          </a>
        </div>

        <div class="card-content">
          <p class="grey-text  text-darken-1">點擊，翻開你的精彩生活</p>
        </div>

        <div class="card-action">
          <a href="{{ route('zinc.index') }}" class="flow-text">
            <span>Zinc 會刊 <i class="fa fa-external-link-square"></i></span>
          </a>
        </div>
      </div>
    </div>

    <div class="col s12 m6 l5">
      <div class="card hoverable">
        <div class="card-image">
          <a href="{{ route('documents.index') }}">
            <img src="{{ asset('assets/media/images/general/guide/document.png') }}">
          </a>
        </div>

        <div class="card-content">
          <p class="grey-text  text-darken-1">了解，看到更多學生會</p>
        </div>

        <div class="card-action">
          <a href="{{ route('documents.index') }}" class="flow-text">
            <span>學生會二三事 <i class="fa fa-external-link-square"></i></span>
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
