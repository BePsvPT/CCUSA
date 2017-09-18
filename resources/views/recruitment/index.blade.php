
@extends('layouts.master')

@php
  $cards = [
    ['name' => 'CCU Zine', 'desc' => '一本屬於中正的會刊小誌。', 'img' => 'zinc.png', 'route' => 'zinc.index'],
    ['name' => '學生會二三事', 'desc' => '了解，看到更多學生會', 'img' => 'document.png', 'route' => 'documents.index'],
    ['name' => '特約商店', 'desc' => '特約商店', 'img' => 'cooperative-store.jpg', 'route' => 'cooperative-stores.index'],
  ];
@endphp

@section('main')
  <div class="row">
    @foreach ($cards as $card)
      <div class="col s12 m4">
        <div class="card hoverable">
          <div class="card-image">
            <a href="{{ route($card['route']) }}">
              {!! Html::image("assets/media/images/general/guide/{$card['img']}") !!}
            </a>
          </div>

          <div class="card-content">
            <p class="grey-text  text-darken-1">{{ $card['desc'] }}</p>
          </div>

          <div class="card-action">
            <a href="{{ route($card['route']) }}" class="flow-text">
              <span>{{ $card['name'] }} <i class="fa fa-external-link-square"></i></span>
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
