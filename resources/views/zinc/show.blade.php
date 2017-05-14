<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    {!! $og->renderTags() !!}

    <title>{{ $zinc->getAttribute('topic') }} | 國立中正大學學生會會刊</title>

    {!! Html::style('assets/css/lightgallery.min.css') !!}
    {!! Html::script('assets/js/jquery.min.js') !!}
    {!! Html::script('assets/js/lightgallery.min.js') !!}
    {!! Html::script('assets/js/lg-thumbnail.min.js') !!}
    {!! Html::script('assets/js/lg-fullscreen.min.js') !!}
    {!! Html::script('assets/js/lg-zoom.min.js') !!}

    <style>
      html, body {
        overflow: hidden;
      }
    </style>
  </head>
  <body>
    <div>
      <h2 style="text-align: center">如未正常播放，請手動點擊第一張圖片！</h2>

      <div id="ccusa-zinc">
        @foreach ($zinc->getRelation('media') as $media)
          <a href="{{ $media->getUrl() }}">
            <img src="{{ $media->getUrl('thumb') }}">
          </a>
        @endforeach
      </div>
    </div>

    <script>
      $(document).ready(function() {
        $("#ccusa-zinc").lightGallery({
          closable: false,
          escKey: false
        });

        $('a')[0].click();
      });

      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o), m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');ga('create','UA-65962475-3','auto');ga('send','pageview');
    </script>
  </body>
</html>
