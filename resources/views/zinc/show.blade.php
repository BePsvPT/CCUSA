<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>國立中正大學學生會會刊</title>
        <style>html{overflow:hidden;}html,body{margin:0;}</style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jssor-slider/19.0.1/jssor.slider.mini.js"></script>
        <style>#warning-message{text-align:center;display:none}@media only screen and (orientation:portrait){#warning-message{display:block}}</style>
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
                    <div><img u="image" src2="{{ $media->getUrl() }}"></div>
                @endforeach
            </div>
        </div>

        <script>
            var slider = new $JssorSlider$('slider', {$Loop: 0});
            slider.$ScaleWidth(document.documentElement.clientWidth);
            $('#slider').css('top', (document.documentElement.clientHeight - $('#slider').height()) / 2);
        </script>
    </body>
</html>
