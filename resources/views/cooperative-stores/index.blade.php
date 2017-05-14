@extends('layouts.master')

@section('title', '特約商店 | 國立中正大學學生會')

@section('main')
  @if (Auth::check() && Auth::user()->hasRole(['cooperative-stores']))
    <div class="{{ $css->isEmpty() ? 'right-align' : 'pull-right' }}">
      @include('components.internal-link', [
        'href' => route('cooperative-stores.manage'),
        'class' => 'btn waves-effect waves-light amber',
        'title' => '管理',
      ])
    </div>
  @endif

  @if ($css->isEmpty())
    @include('components.empty-data')
  @else
    @include('cooperative-stores.side-nav', ['groups' => $groups])

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

              <div class="card-action">
                @include('components.internal-link', [
                  'href' => route('cooperative-stores.show', ['cs' => $cs->getAttribute('link')]),
                  'title' => $cs->getAttribute('name'),
                ])
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endforeach

    {!! $css->render() !!}
  @endif
@endsection
