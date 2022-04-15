<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link href="{{asset(URL::asset('css/app.css'))}}" rel="stylesheet" />

</head>

<body class="d-flex flex-column min-vh-100">
  @include('inc.header')
  <div class="container">
    <div class="w-50 m-auto">
      @include('flash::message')
      @include('inc.anyErrors')
    </div>
  </div>
  @yield('content')
  @include('inc.footer')
  <script src="{{asset(URL::asset('js/app.js'))}}"></script>

</body>

</html>