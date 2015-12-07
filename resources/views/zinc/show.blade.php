<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta property="og:title" content="{{ $zinc->getAttribute('topic') }} | 國立中正大學學生會會刊">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ Request::url() }}">
        <meta property="og:image" content="{{ asset($zinc->getRelation('media')->first()->getUrl()) }}">
        <meta property="og:locale" content="zh_TW">
        <title>國立中正大學學生會會刊</title>
        <style>html{overflow:hidden;}html,body{margin:0;}#warning-message{text-align:center;display:none}@media only screen and (orientation:portrait){#warning-message{display:block}}</style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jssor-slider/19.0.1/jssor.slider.mini.js"></script>
    </head>
    <body style="background-color: #eeeeee;">
        @if (Agent::isMobile())
            <div id="warning-message">
                <span>您目前正在使用行動裝置瀏覽</span><br>
                <span>為了獲得更佳體驗，建議您橫向擺放裝置</span><br>
                <span>（提醒您：橫向擺置後需重新整理網頁）</span>
            </div>
        @endif

        <div id="slider" style="position: relative; top: 0; left: 0; width: 600px; height: 300px;">
            <div u="slides" style="cursor: move; position: absolute; overflow: hidden; left: 0; top: 0; width: 600px; height: 300px;">
                @foreach ($zinc->getRelation('media') as $media)
                    <div><img data-slide-image u="image" src2="{{ $media->getUrl() }}"></div>
                @endforeach
            </div>
        </div>

        <script>
            var left = -1, images = $('img[data-slide-image]'), wHeight = $(window).height(), wWidth = $(window).width();
            var slider = new $JssorSlider$('slider', {$FillMode: 1, $Loop: 0});

            slider.$ScaleHeight(wHeight);

            slider.$On($JssorSlider$.$EVT_LOAD_END, function (slideIndex) {
                if (-1 === left) {
                    left = (wWidth - images[slideIndex].naturalWidth / (images[slideIndex].naturalHeight / wHeight)) / 2 / ($('#slider').width() / 600);
                }

                images[slideIndex].style.left = left + 'px';
            });

            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');ga('create','UA-65962475-3','auto');ga('send','pageview');
        </script>
    </body>
</html>
