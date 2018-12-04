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
            <div class="col">
                <div class="collapse" id="" >
                    <p> 會長 OOO</p>
                    <p> 系級：</p>
                    <p> 電子信箱：</p>
                    <br/>
                    <p> 副會長 OOO</p>
                    <p>  系級</p>
                    <p>  電子信箱</p>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <details>
            <div class="row">
                <summary class="col btn text-left container-fluid">行政中心</summary>
            </div>
            <div class="row">
                <div class="col">
                    <div class="" id="center_collapse">
                        <p>
                            秘書長 OOO<br/>
                            系級<br/>
                            電子信箱<br/>
                            <br/>
                            主計副秘書長 OOO<br/>
                            系級<br/>
                            電子信箱<br/>
                            ……<br/>
                        </p>
                    </div>
                </div>
            </div>
        </details>
    </div>

    <div class="row">
        <details>
            <div class="row">
                <summary class="col btn text-left container-fluid">學生議會</summary>
            </div>
            <div class="row">
                <div class="col">
                    <div class="" id="metting_collapse">
                        <p>
                            議長 OOO<br/>
                            系級<br/>
                            選舉區<br/>
                            電子信箱<br/>
                            委員會<br/>
                            <br/>
                            副議長OOO<br/>
                            系級<br/>
                            選舉區<br/>
                            電子信箱<br/>
                            委員會<br/>
                        </p>
                    </div>
                </div>
            </div>
        </details>
    </div>

    <div class="row">
        <details>
            <div class="row">
                <summary class="col btn text-left container-fluid">評議委員會</summary>
            </div>
            <div class="row">
                <div class="col">
                    <div class="" id="">

                        <p>  委員長OOO</p>
                        <p>  系級</p>
                        <p>  提名方式：</p>

                        <p>   以上是學生會的介紹，行政中心副首長可以不用放照片。</p>
                        <p>   評議委員會不放照片</p>

                        <p>   以下是各級會議代表，希望這個頁面是適合使用者更新的：</p>

                    </div>
                </div>
            </div>
        </details>
    </div>
@endsection
