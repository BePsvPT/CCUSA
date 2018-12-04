@extends('layouts.master')

@section('title', 'PROFILE | 國立中正大學學生會')

@section('main')
    <script rel="script" type="application/javascript">
        function show(id) {
            document.getElementById('center_collapse').hidden=true;

            document.getElementById(id).hidden=false;
        }
    </script>

    <div class="row">
        <div class="row">
            <button  id="heading_center" class="col btn text-left container-fluid collapsed" data-toggle="collapse" data-target="#center_collapse" onclick="show('center_collapse');">
                行政中心
            </button>
        </div>
        <div class="row">
            <div class="col">
                <div class="collapse" id="center_collapse"  data-parent="#data_view" hidden>
                    <p>
                        會長 - XXX :<br/>
                            XX系......
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="row">
            <details>
                <summary class="col btn text-left container-fluid">行政中心</summary>
                <p>會長 - XXX</p>
                <p> XXX 系 ........</p>
            </details>
        </div>
    </div>
@endsection
