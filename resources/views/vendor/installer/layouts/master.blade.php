<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>JL Token Installation</title>
    <link rel="icon" href="{{ asset('assets/favicon.ico') }}" sizes="16x16">
    <link href="{{ asset('assets/installer/css/style.min.css') }}" rel="stylesheet"/>
  </head>
  <body>
    <div class="master">
      <div class="box">
        <div class="header">
            <h1 class="header__title">@yield('title')</h1>
        </div>
        <ul class="step">
          <li class="step__divider"></li>
          <li class="step__item {{ isActive('LaravelInstaller::final') }}"><i class="step__icon database"></i></li>
          <li class="step__divider"></li>
          <li class="step__item {{ isActive('LaravelInstaller::permissions') }}"><i class="step__icon permissions"></i></li>
          <li class="step__divider"></li>
          <li class="step__item {{ isActive('LaravelInstaller::requirements') }}"><i class="step__icon requirements"></i></li>
          <li class="step__divider"></li>
          <li class="step__item {{ isActive('LaravelInstaller::environment') }}"><i class="step__icon update"></i></li>
          <li class="step__divider"></li>
          <li class="step__item {{ isActive('LaravelInstaller::welcome') }}"><i class="step__icon welcome"></i></li>
          <li class="step__divider"></li>
        </ul>
        <div class="main">
          @yield('container')
        </div>
      </div>
    </div>
  </body>
</html>
