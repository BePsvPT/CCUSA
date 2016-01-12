@extends('layouts.master')

@section('main')
    <div>
        <span><i class="fa fa-square" style="color: rgba(220,220,220,1)"></i> Visitors</span><br>
        <span><i class="fa fa-square" style="color: rgba(151,187,205,1)"></i> Page Views</span>

        <hr>

        <canvas id="zinc-analytics"></canvas>
    </div>
@endsection
