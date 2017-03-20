@extends('layouts.master')

@section('main')
  <div class="row">
    <div class="col s12 m6 offset-l1 l5">
      <div class="card hoverable">
        <div class="card-image">
          <a href="{{ route('zinc.index') }}">
            <img src="{{ asset('assets/media/images/general/guide/zinc_update_2017_03_20.png') }}">
          </a>
        </div>

        <div class="card-content">
          <p class="grey-text  text-darken-1">一本屬於中正的會刊小誌。</p>
        </div>

        <div class="card-action">
          <a href="{{ route('zinc.index') }}" class="flow-text">
            <span>CCU Zine <i class="fa fa-external-link-square"></i></span>
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
