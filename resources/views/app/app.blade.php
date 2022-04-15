<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <link href="{{asset(URL::asset('css/select2.min.css'))}}" rel="stylesheet" />
  <link href="{{asset(URL::asset('css/app.css'))}}" rel="stylesheet" />
  
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
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



  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <script src="{{asset(URL::asset('js/jquery-1.11.1.js'))}}"></script>
  <script src="{{asset(URL::asset('js/select2.min.js'))}}"></script>
  <script src="{{asset(URL::asset('js/i18n/ru.js'))}}"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <script src="{{asset(URL::asset('js/script.js'))}}"></script>
</body>

</html>