@extends('layouts.master')

@section('main')
    @foreach ($zincs->chunk(3) as $chunk)
        <div class="row">
            <div class="hide-on-med-and-down col l{{ 6 - $chunk->count() * 2 }}"><span>　</span></div>
            @foreach ($chunk as $zinc)
                <div class="col s12 l4">
                    <div class="card hoverable">
                        <div class="card-image">
                            <a href="{{ route('zinc.show', ['year' => $zinc->getAttribute('year'), 'month' => $zinc->getAttribute('month')]) }}" target="_blank">
                                <img src="{{ $zinc->getRelation('media')->first()->getUrl() }}">
                            </a>
                        </div>
                        <div class="card-action flow-text">
                            {!! link_to_route('zinc.show', $zinc->getAttribute('topic'), ['year' => $zinc->getAttribute('year'), 'month' => $zinc->getAttribute('month')], ['target' => '_blank']) !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach

    @if (Auth::check())
        <div class="fixed-action-btn">
            <a href="{{ route('zinc.manage.index') }}" class="btn-floating btn-large waves-effect waves-light light-green">
                <span>管理</span>
            </a>
        </div>
    @endif
@endsection
