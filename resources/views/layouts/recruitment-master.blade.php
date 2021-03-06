<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    {!! $og->renderTags() !!}
    <meta property="og:url" content="https://ccusa.ccu.edu.tw/recruitment">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', '國立中正大學學生會')</title>

    {!! Html::style('assets/css/materialize.min.css') !!}
    {!! Html::style('assets/css/material-icons.css') !!}
    {!! Html::style('assets/css/font-awesome.min.css') !!}
    {!! Html::style('assets/css/app.css') !!}
    <script  type="text/javascript">
      window.location.href='https://goo.gl/nDQ1rB';
    </script>
  </head>
  <body class="yellow lighten-5">
    @include('header.index')

    <main class="container">
      @yield('main')
      <iframe src='https://docs.google.com/forms/d/e/1FAIpQLSfqddGf6U66X_YTHEoGOA1aY8DzpXJVSKjZpPA4AWU1BLrozg/viewform?embedded=true' width="760" height="500" frameborder="0" marginheight="0" marginwidth="0">載入中…</iframe>
    </main>

    @include('footer.index')

    {!! Html::script('assets/js/jquery.min.js', ['defer']) !!}
    {!! Html::script('assets/js/materialize.min.js', ['defer']) !!}
    @stack('scripts')
    {!! Html::script('assets/js/all.js', ['defer']) !!}
  </body>
</html>
