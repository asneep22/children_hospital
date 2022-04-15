<div class="container m-auto mb-0">
  <footer class=" py-3">
    <ul class="nav nav-pills d-flex justify-content-center">
      @guest('web')
        Вы не авторизованы
      @endguest

      @auth('web')
        Вы авторизованы
      @endauth
    </ul>
  </footer>
</div>
