@extends('layouts.master')

@section('title', 'PROFILE | 國立中正大學學生會')

@section('main')
    <div class="row">
        <div class="row">
            <button  id="heading_center" class="col btn text-left container-fluid collapsed" data-toggle="collapse" data-target="#center_collapse" >
                行政中心
            </button>
        </div>
        <div class="row">
            <div class="col">
                <div class="collapse" id="center_collapse"  data-parent="#data_view">
                    <p>
                        會長 - XXX :
                            XX系......
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
