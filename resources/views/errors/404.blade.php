<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="msapplication-tap-highlight" content="no">
        <title>404 | It seems that this page doesn’t exist | JL Token</title>
        <link rel="icon" href="{{ asset('assets/favicon.ico') }}">
        <link href="{{ asset('assets/css/materialize.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
        <link href="{{ asset('assets/css/style.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
        <style>
            html, body{height:100%} html{display:table;margin:auto} body{display:table-cell;vertical-align:middle}
        </style>
    </head>
    <body class="teal">
        <div id="loader-wrapper">
            <div id="loader"></div>
            <div class="loader-section section-left"></div>
            <div class="loader-section section-right"></div>
        </div>
        <div id="error-page">
            <div class="row">
                <div class="col s12">
                    <div class="browser-window">
                        <div class="content">
                            <div class="row">
                                <div id="site-layout-example-top" class="col s12">
                                    <p class="flat-text-logo center white-text caption-uppercase" style="margin-top:12px">Sorry but we couldn’t find this page :(</p>
                                </div>
                                <div id="site-layout-example-right" class="col s12 m12 l12 cyan darken-1">
                                    <div class="row center">
                                        <h1 class="text-long-shadow col s12 cyan darken-1" style="margin-bottom:0;margin-top:0;text-shadow:none">404</h1>
                                    </div>
                                    <div class="row center">
                                        <p class="center white-text col s12" style="margin-top:0">It seems that this page doesn’t exist.</p>
                                        <p class="center s12" style="margin-top:0">
                                            <a href="{{ route('main') }}" class="btn waves-effect waves-light teal darken-2">Home</a>
                                        </p>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{{ asset('assets/js/plugins/jquery-1.11.2.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/materialize.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/js/plugins.min.js') }}"></script>
    </body>
</html>
