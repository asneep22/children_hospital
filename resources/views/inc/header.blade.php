<div class="container-fluid">
  <header class=" py-3">
    <ul class="nav nav-pills d-flex float-end">
      @guest('web')
      Вы не авторизованы
      @endguest

      @auth('web')
      <li class="nav-item"><a href="{{Route('PacientsPage')}}" class="nav-link" aria-current="page">Пациенты</a></li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Справочники
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li class="nav-item"><a href="{{Route('UchastkiPage')}}" class="nav-link">Участки</a></li>
          <li class="nav-item"><a href="{{Route('RoddomsPage')}}" class="nav-link">Родильные дома</a></li>
          <li class="nav-item"><a href="{{Route('StacionarsPage')}}" class="nav-link">Стационары</a></li>
          <li class="nav-item"><a href="{{Route('BolezniPage')}}" class="nav-link">Болезни</a></li>
          <li class="nav-item"><a href="{{Route('VacinesPage')}}" class="nav-link">Вакцины</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Отчеты
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#reportModal">Анализ заболеваемости новорожденных</a></li>

          <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#reportModal1">Отчет по перинатальной патологии</a></li>
        </ul>
      </li>

      <li class="nav-item"><a href="{{Route('Logout')}}" class="nav-link text-danger">Выход</a></li>


      @endauth
    </ul>
  </header>
</div>