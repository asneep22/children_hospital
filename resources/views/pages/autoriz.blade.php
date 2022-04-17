@extends('app.app')

@section('content')

<div class="container m-auto">
  <form class="d-flex flex-column w-25 m-auto" action="{{ Route('TryAuth') }}" method="post">
    @csrf

    <div class="mb-3">
      <label for="login">Логин</label>
      <input type="text" id="login" name="login" class="form-control">
    </div>

    <div class="mb-3">
      <label for="password">Пароль</label>
      <input type="password" id="password" name="password" class="form-control">
    </div>
    

    <button type="submit" class="btn btn-success m-auto mr-0">Авторизоваться</button>
  </form>
</div>

@endsection
