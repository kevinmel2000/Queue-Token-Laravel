<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <title>@yield('title') | JL Token</title>
        <link rel="icon" href="{{ asset('assets/favicon.ico') }}">
        <link href="{{ asset('assets/css/materialize.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
        @yield('css')
        <link href="{{ asset('assets/css/style.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
    </head>

    <body>
        <div id="loader-wrapper">
            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>

        <header id="header" class="page-topbar">
            <div class="navbar-fixed">
                <nav class="navbar-color">
                    <div class="nav-wrapper">
                        <ul class="left">
                            <li><h1 class="logo-wrapper"><a href="{{ route('dashboard') }}" class="brand-logo darken-1"><img src="{{ asset('assets/images/jltoken-logo.png') }}" alt="materialize logo"></a><span class="logo-text">JL Token</span></h1></li>
                        </ul>
                        <ul class="right hide-on-med-and-down">
                            <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a></li>
                        </ul>
                        <ul class="right">
                            <span class="truncate" style="margin-right:20px;font-size:20px">{{ $settings->name }}</span>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <div id="main" style="padding:15px;padding-bottom:0">
            <div class="wrapper">
                <section id="content">
                    @yield('content')
                </section>
            </div>
        </div>

        <footer class="page-footer" style="padding:0;margin-top:0">
            <div class="footer-copyright">
                <div class="container">
                    <span>Powered by <a class="grey-text text-lighten-3" href="http://www.justlabtech.com" target="_blank">Justlab Technologies</a> All rights reserved.</span>
                    <span class="right"> <span class="grey-text text-lighten-3">Version</span> 2.1.1</span>
                </div>
            </div>
        </footer>
        @yield('print')
        <script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-1.11.2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/materialize.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/plugins.min.js') }}"></script>
        @yield('script')
        @include('common.messages')
    </body>
</html>
