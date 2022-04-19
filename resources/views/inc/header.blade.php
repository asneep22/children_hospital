<nav class="navbar navbar-expand-lg navbar-light"  style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
        @guest('web')
        Вы не авторизованы
        @endguest

        @auth('web')
        <li class="nav-item"><a href="{{Route('PacientsPage')}}" class="nav-link" aria-current="page"><span class="material-icons-two-tone float-start">supervised_user_circle</span>Пациенты</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          
<span class="material-icons-two-tone float-start">document_scanner</span> 
<span>Справочники</span>
 
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#uchastokModal">Участки</a></li>
            <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#roddomModal">Родильные дома</a></li>
            <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#stacionarModal">Стационары</a></li>
            <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#boleznModal">Болезни</a></li>
            <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#vacineModal">Вакцины</a></li>
            <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#policlinicModal">Поликлиника</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <span class="material-icons-two-tone float-start">auto_stories</span>Отчеты
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#reportModal">Анализ заболеваемости новорожденных</a></li>

            <li class="nav-item"><a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#reportModal1">Отчет по перинатальной патологии</a></li>
          </ul>
        </li>

        <li class="nav-item"><a href="{{Route('Logout')}}" class="nav-link text-danger"><span class="material-icons-two-tone float-start">sensor_door</span> Выход</a></li>


        @endauth
      </ul>
    </div>
</nav>