<!DOCTYPE html>
<html lang="{{ str_replace('_', '_', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ scrf_token() }}">

    <title>@yield('titile', 'LaraBBS') - Laravel 进阶教程</title>

    <!-- Stytle -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  </head>

  <body>
    <div id='app' class="{{ route_class() }}-page">
      @include('layouts._header')

      <div class="container">
        @include('shared._messages')
        @yield('content')
      </div>

      @include('layouts._footer')
    </div>

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>
