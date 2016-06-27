<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta property="og:title" content="{{ $zinc->getAttribute('topic') }} | 國立中正大學學生會會刊">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ Request::url() }}">
    <meta property="og:image" content="{{ asset($zinc->getRelation('media')->shift()->getUrl()) }}">
    <meta property="og:locale" content="zh_TW">
    <title>國立中正大學學生會會刊</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.2.18/css/lightgallery.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
    <style>*{font-family:"Microsoft yahei","Roboto",sans-serif}</style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.2.18/js/lightgallery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.2.18/js/lg-thumbnail.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.2.18/js/lg-fullscreen.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.2.18/js/lg-zoom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js" defer></script>
  </head>
  <body>
    <div class="container">
      <h2 class="center">如未正常播放，請手動點擊第一張圖片！</h2>

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
