<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>國立中正大學學生會</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/css/materialize.min.css">
        <link rel="stylesheet" href="http://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    </head>
    <body class="yellow lighten-5">
        <header></header>

        <main class="container">
            @include('layouts.breadcrumb')

            @yield('main')
        </main>

        <footer class="orange lighten-2 page-footer">
            <div class="footer-copyright">
                <div class="container center-align">
                    <span>國立中正大學學生會 © 2015</span>

                    <a class="grey-text text-lighten-3 tooltipped"
                       href="https://www.facebook.com/NCCUSAbest"
                       target="_blank"
                       data-position="top"
                       data-tooltip="粉絲專頁"
                    >
                        <i class="fa fa-facebook-official fa-fw fa-lg"></i>
                    </a>

                    <a class="grey-text text-lighten-3 tooltipped"
                       href="mailto:ccusa2010@gmail.com"
                       data-position="top"
                       data-tooltip="電子郵件"
                    >
                        <i class="fa fa-envelope fa-fw fa-lg"></i>
                    </a>

                    <a class="grey-text text-lighten-3 tooltipped"
                       href="https://github.com/BePsvPT/CCUSA"
                       target="_blank"
                       data-position="top"
                       data-tooltip="Github"
                    >
                        <i class="fa fa-github-square fa-fw fa-lg"></i>
                    </a>

                    @if (Auth::guest())
                        <a class="grey-text text-lighten-3 tooltipped"
                           href="{{ route('sign-in') }}"
                           data-position="top"
                           data-tooltip="登入"
                        >
                            <i class="fa fa-user fa-fw fa-lg"></i>
                        </a>
                    @endif
                </div>
            </div>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/js/materialize.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.0.4/js.cookie.min.js" defer></script>
        <script src="{{ asset('assets/js/all.js') }}" defer></script>
    </body>
</html>
