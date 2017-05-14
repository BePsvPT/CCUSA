@extends('layouts.master')

@section('title', 'ZINE | 國立中正大學學生會')

@section('main')
  @if (Auth::check() && Auth::user()->hasRole(['zinc']))
    <div class="right-align">
      @include('components.internal-link', [
        'href' => route('zinc.manage'),
        'class' => 'btn waves-effect waves-light amber',
        'title' => '管理',
      ])
    </div>
  @endif

  @forelse ($zincs->chunk(3) as $chunk)
    <div class="row">
      @if ($chunk->count() < 3)
        <div class="hide-on-med-and-down col l{{ 6 - $chunk->count() * 2 }}"><span>　</span></div>
      @endif

      @foreach ($chunk as $zinc)
        <div class="col s12 l4">
          <div class="card hoverable">
            <div class="card-image">
              <a
                href="{{ route('zinc.show', $zinc->getAttribute('identify')) }}"
                target="_blank"
              ><img src="{{ $zinc->getFirstMediaUrl('zinc') }}"></a>
            </div>

            <div class="card-action">
              @include('components.external-link', [
                'href' => route('zinc.show', $zinc->getAttribute('identify')),
                'title' => $zinc->getAttribute('topic'),
              ])
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @empty
    @include('components.empty-data')
  @endforelse

  {!! $zincs->render() !!}
@endsection
