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

    <div>
      聯盟介紹
     </div>

    {!! $css->render() !!}
  @endif
@endsection
