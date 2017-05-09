@extends('layouts.master')

@section('main')
  <canvas id="zinc-analytics"></canvas>
@endsection

@push('scripts')
{!! Html::script('assets/js/chart.min.js', ['defer']) !!}
@endpush
