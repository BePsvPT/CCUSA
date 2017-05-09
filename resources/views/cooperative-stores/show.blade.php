@extends('layouts.master')

@section('fetch-info')
  <meta property="og:title" content="{{ $cs->getAttribute('name')  }} | 國立中正大學學生會特約商店">
  <meta property="og:url" content="{{ route('cooperative-stores.show', ['cs' => $cs->getAttribute('link')]) }}">
  <meta property="og:image" content="{{ asset($cs->getFirstMedia('cs-cover')->getUrl()) }}">
@endsection

@section('title')
  特約商店 - {{ $cs->getAttribute('name')  }} |
@endsection

@section('main')
  <img
    class="materialboxed"
    style="margin: 1rem auto;"
    width="90%"
    src="{{ $cs->getFirstMedia('cs-cover')->getUrl() }}"
  >

  <table class="cooperative-store-info">
    <tbody>
      <tr>
        <td>
          <div class="chip red darken-1 white-text">店　　名</div>
        </td>
        <td>{{ $cs->getAttribute('name') }}</td>
      </tr>
      <tr>
        <td>
          <div class="chip red darken-1 white-text">日　　期</div>
        </td>
        <td>{{ $cs->getAttribute('began_at') }} ~ {{ $cs->getAttribute('ended_at') }}</td>
      </tr>
      <tr>
        <td>
          <div class="chip red darken-1 white-text">電　　話</div>
        </td>
        <td>{{ $cs->getAttribute('phone') }}</td>
      </tr>
      <tr>
        <td>
          <div class="chip red darken-1 white-text">地　　址</div>
        </td>
        <td>
          <span>{{ $cs->getAttribute('address') }}</span>

          @include('components.external-link', [
            'href' => 'https://www.google.com/maps?q='.rawurlencode($cs->getAttribute('address')),
            'icon' => 'map-marker',
          ])
        </td>
      </tr>
      <tr>
        <td>
          <div class="chip red darken-1 white-text">營業時間</div>
        </td>
        <td>
          <p>{!! $cs->getAttribute('business_hours') !!}</p>
        </td>
      </tr>
      <tr>
        <td>
          <div class="chip red darken-1 white-text">描　　述</div>
        </td>
        <td>
          <p>{!! $cs->getAttribute('description') !!}</p>
        </td>
      </tr>
    </tbody>
  </table>

  @if(! $cs->getMedia('cs-gallery')->isEmpty())
    <div class="slider" style="width: 85%; margin: 1rem auto;">
      <ul class="slides">
        @foreach($cs->getMedia('cs-gallery') as $image)
          <li>
            <a href="{{ $image->getUrl() }}" target="_blank">
              <img src="{{ $image->getUrl() }}">
            </a>
          </li>
        @endforeach
      </ul>
    </div>
  @endif
@endsection
