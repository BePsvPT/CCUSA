@extends('layouts.master')

@section('main')
    <div class="row">
        <button  id="heading_center" class="col" data-toggle="collapse" data-target="#center_collapse" >
            行政中心
        </button>
        <div class="col">
            <div class="collapse" id="center_collapse"  data-parent="#data_view">
                <p>
                    會長 - XXX :
                        XX系......
                </p>
            </div>
        </div>
    </div>
@endsection
