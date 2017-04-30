@extends('layouts.master')

@section('fetch-info')
  <meta property="og:title" content="國立中正大學學生會特約商店">
  <meta property="og:url" content="{{ route('cooperative-stores.index') }}">
  @foreach ($css as $cs)
    <meta property="og:image" content="{{ asset($cs->getFirstMedia('cs-cover')->getUrl()) }}">
  @endforeach
@endsection

@section('main')
  @if (Auth::check() && Auth::user()->hasRole(['cooperative-stores']))
    <div class="pull-right">
      {!! Html::linkRoute('cooperative-stores.manage', '管理', [], ['class' => 'btn waves-effect waves-light amber']) !!}
    </div>
  @endif

  @include('cooperative-stores.side-nav', ['groups' => $groups])

  <br><br>

  @foreach ($css->chunk(3) as $chunk)
    <div class="row">
      @if ($chunk->count() < 3)
        <div class="hide-on-med-and-down col l{{ 6 - $chunk->count() * 2 }}"><span>　</span></div>
      @endif

      @foreach ($chunk as $cs)
        <div class="col s12 l4">
          <div class="card hoverable">
            <div class="card-image">
              <a href="{{ route('cooperative-stores.show', ['cs' => $cs->getAttribute('link')]) }}">
                {!! Html::image($cs->getFirstMedia('cs-cover')->getUrl()) !!}
              </a>
            </div>

            <div class="card-action flow-text">
              {!! Html::linkRoute('cooperative-stores.show', $cs->getAttribute('name'), ['cs' => $cs->getAttribute('link')]) !!}
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endforeach

  @include('layouts.simple-paginate', ['pagination' => $css])
@endsection
