<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <meta property="og:title" content="國立中正大學學生會">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ route('home') }}">
        <meta property="og:image" content="{{ asset('assets/media/images/general/logo/ccusa.png') }}">
        <meta property="og:locale" content="zh_TW">
        <title>國立中正大學學生會</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/css/materialize.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    </head>
    <body class="yellow lighten-5">
        <header class="container">
            @include('layouts.breadcrumb')
        </header>

        <main class="container">
            @yield('main')
        </main>

        <footer class="orange lighten-2 page-footer">
            <div class="container">
                <div class="row">
                    <div class="col s12 m12 l6">
                        <h5 class="white-text">For you, for us</h5>
                        <p class="grey-text text-lighten-4">國 立 中 正 大 學 學 生 會 © 2015</p>
                    </div>
                    <div class="col s6 l3">
                        <h5 class="white-text">意見回饋</h5>
                        <ul>
                            <li>
                                <a class="grey-text text-lighten-3" href="https://goo.gl/forms/PVPmjX8mwF" target="_blank">
                                    <span><i class="fa fa-check-square fa-fw fa-lg"></i> 網站</span>
                                </a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="https://docs.google.com/forms/d/1j4rGF-bax4LyIlaXgjkKbje3MVHX13HDDp2ITEpphWI/viewform" target="_blank">
                                    <span><i class="fa fa-check-square fa-fw fa-lg"></i> 會刊</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col s6 l3">
                        <h5 class="white-text">相關連結</h5>
                        <ul>
                            <li>
                                <a class="grey-text text-lighten-3" href="https://www.facebook.com/NCCUSAbest" target="_blank">
                                    <span><i class="fa fa-facebook-official fa-fw fa-lg"></i> 粉絲專頁</span>
                                </a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="mailto:ccusa2010@gmail.com">
                                    <span><i class="fa fa-envelope fa-fw fa-lg"></i> 信箱</span>
                                </a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="https://github.com/BePsvPT/CCUSA" target="_blank">
                                    <span><i class="fa fa-github-square fa-fw fa-lg"></i> 原始碼</span>
                                </a>
                            </li>
                            <li>
                                <a class="grey-text text-lighten-3" href="{{ route('sign-in') }}">
                                    <span><i class="fa fa-user fa-fw fa-lg"></i> 網站登入</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/js/materialize.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/2.0.4/js.cookie.min.js" defer></script>
        <script src="{{ asset('assets/js/all.js') }}" defer></script>
    </body>
</html>
