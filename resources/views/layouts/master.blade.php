<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="zh_TW">
    @section('fetch-info')
      <meta property="og:title" content="國立中正大學學生會">
      <meta property="og:url" content="{{ route('home') }}">
      <meta property="og:image" content="{{ asset('assets/media/images/general/logo/ccusa.png') }}">
    @show
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>國立中正大學學生會</title>
    {!! Html::style('assets/css/materialize.min.css') !!}
    {!! Html::style('assets/css/material-icons.css') !!}
    {!! Html::style('assets/css/font-awesome.min.css') !!}
    {!! Html::style('assets/css/app.css') !!}
  </head>
  <body class="yellow lighten-5">
    <header class="container">
      @include('layouts.header')
    </header>

    <main class="container">
      @yield('main')
    </main>

    <footer class="page-footer orange lighten-1">
      @include('layouts.footer')
    </footer>

    <script src="{{ asset('assets/js/jquery.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/materialize.min.js') }}" defer></script>
    @stack('scripts')
    <script src="{{ asset('assets/js/all.js') }}" defer></script>
  </body>
</html>
