<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/css/materialize.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    </head>
    <body>
        <header></header>

        <main class="container">
            @yield('main')
        </main>

        <footer class="indigo darken-3 page-footer">
            <div class="footer-copyright">
                <div class="container center-align">
                    <span>國立中正大學學生會 © 2015</span>

                    <a class="grey-text text-lighten-3 tooltipped"
                       href="https://www.facebook.com/NCCUSAbest"
                       target="_blank"
                       data-position="top"
                       data-tooltip="粉絲專頁"
                    >
                        <i class="fa fa-facebook-official fa-fw fa-2x"></i>
                    </a>

                    <a class="grey-text text-lighten-3 tooltipped"
                       href="mailto:ccusa2010@gmail.com"
                       data-position="top"
                       data-tooltip="電子郵件"
                    >
                        <i class="fa fa-envelope fa-fw fa-2x"></i>
                    </a>
                </div>
            </div>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/js/materialize.min.js" defer></script>
    </body>
</html>
