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
  <img class="materialboxed" width="100%" src="{{ $cs->getFirstMedia('cs-cover')->getUrl() }}">

  <table class="cooperative-store-info">
    <tbody>
      <tr>
        <td>店名：</td>
        <td>{{ $cs->getAttribute('name') }}</td>
      </tr>
      <tr>
        <td>開始日期：</td>
        <td>{{ $cs->getAttribute('began_at') }}</td>
      </tr>
      <tr>
        <td>結束日期：</td>
        <td>{{ $cs->getAttribute('ended_at') }}</td>
      </tr>
      <tr>
        <td>電話：</td>
        <td>{{ $cs->getAttribute('phone') }}</td>
      </tr>
      <tr>
        <td>地址：</td>
        <td>{{ $cs->getAttribute('address') }}</td>
      </tr>
      <tr>
        <td>營業時間：</td>
        <td>
          <blockquote>{!! $cs->getAttribute('business_hours') !!}</blockquote>
        </td>
      </tr>
      <tr>
        <td>描述：</td>
        <td>
          <blockquote>{!! $cs->getAttribute('description') !!}</blockquote>
        </td>
      </tr>
    </tbody>
  </table>

  @if(! $cs->getMedia('cs-gallery')->isEmpty())
    <div class="slider" style="margin-bottom: 2rem;">
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
