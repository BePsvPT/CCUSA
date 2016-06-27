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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/css/materialize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.6/js/materialize.min.js" defer></script>
    @stack('scripts')
    <script src="{{ asset('assets/js/all.js') }}" defer></script>
  </body>
</html>
