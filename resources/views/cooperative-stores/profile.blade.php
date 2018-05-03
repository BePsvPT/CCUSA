@extends('layouts.master')

@section('title', '特約商店 | 國立中正大學學生會')

@section('main')
  @include('cooperative-stores.side-nav', ['groups' => $groups])

    <div>
      聯盟介紹
     </div>

    {!! $css->render() !!}
  @endif
@endsection
