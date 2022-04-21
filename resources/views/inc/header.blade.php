@auth('web')
<nav class="navbar navbar-expand-lg navbar-light"  style="background-color: #e3f2fd;">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


       
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
        
        <li class="nav-item">
        <x-modal modalId="addPacient" modalTitle="Добавить пациента" btnClass="nav-link" btnText="Добавить пациента">
                                <form class="" action="{{ Route('AddPacient') }}" method="post">
                                    <input type="hidden" name="userid" id="userid" value="">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Основные сведения</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Периоды болезни</button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Прививки</button>
                                        </li>
                                    </ul>

                                    @csrf
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="lastname">Фамилия</label>
                                                        <input type="text" id="lastname" required name="lastname" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="pname">Имя</label>
                                                        <input type="text" id="pname" required name="pname" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="surname">Отчество</label>
                                                        <input type="text" id="surname" required name="surname" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="birthday">Дата рождения</label>
                                                        <input type="date" id="birthday" required name="birthday" class="form-control" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="uchastok_id">Участок</label>
                                                        <select class="js-select" required name="uchastok_id" id="uchastok_id">
                                                            @foreach ($uchastoks as $uchastok)
                                                            <option value="{{ $uchastok->id }}">
                                                                {{ $uchastok->pname }}
                                                            </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="roddom_id">Роддом</label>
                                                        <select class="js-select" required name="roddom_id" id="roddom_id">
                                                            @foreach ($roddoms as $roddom)
                                                            <option value="{{ $roddom->id }}">
                                                                {{ $roddom->pname }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="rost">Рост</label>
                                                        <input type="number" id="rost" required name="rost" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="ves">Вес</label>
                                                        <input type="number" id="ves" step="0.1" required name="ves" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="gestaci">Неделя рождения</label>
                                                        <input type="number" id="gestaci" step="0.1" required name="gestaci" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="date_add">Дата поступления</label>
                                                        <input type="date" name="date_add" id="date_add" value="{{ Carbon\Carbon::now()->format('Y-m-d') }}" required class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="pol">Пол</label>
                                                    <select name="pol" id="pol" class="form-select">
                                                        <option value="1">Мальчик</option>
                                                        <option value="0">Девочка</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="mb-3">
                                                        <label for="address">Адрес</label>
                                                        <input type="text" name="address" id="address" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="recommend">Комментарий</label>
                                                <textarea id="recommend" rows="3" name="recommend" class="form-control"></textarea>
                                            </div>





                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                            <button class="btn btn-success my-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFormAdd" aria-expanded="false" aria-controls="collapseFormAdd">+</button>

                                            <div class="card card-body collapse" id="collapseFormAdd">
                                                <div class="row">

                                                    <div class="col-md-6">
                                                        <label for="vid">Местонахождение</label>
                                                        <select name="vid" id="vid" class="form-select">
                                                            <option value="Роддом">Роддом</option>
                                                            <option value="Стационар">Стационар</option>
                                                            <option value="На дому">На дому</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="pac_stacionar_id">Стационар</label>
                                                        <select class="js-select3 w-100" name="pac_stacionar_id" id="pac_stacionar_id">
                                                            <option value=""></option>
                                                            @foreach ($stacionars as $stacionar)
                                                            <option value="{{ $stacionar->pname }}">
                                                                {{ $stacionar->pname }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>

                                                <div class="mb-2">
                                                    <label for="pac_diagnoz">Диагноз</label>
                                                    <select class="js-select3 w-100" name="diagnoz[]" multiple id="pac_diagnoz">
                                                        @foreach ($bolezns as $bolezn)
                                                        <option value="{{ $bolezn->pname }}">
                                                            {{ $bolezn->pname }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-2">
                                                    <label for="pac_recommends">Рекомендации</label>
                                                    <textarea id="pac_recommends" rows="2" name="recommend" class="form-control"></textarea>
                                                </div>
                                                <div class="row mb-2">
                                                    <div class="col-md-6"> <label for="pac_date_in">Дата
                                                            поступления</label>
                                                        <input type="date" id="pac_date_in" name="date_in" class="form-control">
                                                    </div>
                                                    <div class="col-md-6"><label for="pac_date_ou">Дата
                                                            выписки</label>
                                                        <input type="date" id="pac_date_ou" name="date_ou" class="form-control">
                                                    </div>
                                                </div>
                                                <button type="button" class="btn btn-success" id="successaddperiod">Добавить</button>
                                            </div>
                                            <div id="tableforperiod">
                                                <div id="inp">

                                                </div>
                                                <table class="table table-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>Местонахождение</th>
                                                            <th>Стационар</th>
                                                            <th>Периоды болезни</th>
                                                            <th>Диагнозы</th>
                                                            <th>Рекомендации</th>
                                                            <th></th>
                                                        </tr>

                                                    </thead>
                                                    <tbody>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                            <div class="form-group">


                                                <label for="vacines">Вакцины</label>
                                                <select class="js-select2 w-100" name="vacine[]" id="vacines" multiple="multiple">
                                                    @foreach ($vacines as $vacine)
                                                    <option value="{{ $vacine->pname }}" {{ $vacine->selected ? 'selected' : '' }}>
                                                        {{ $vacine->pname }}
                                                    </option>
                                                    @endforeach
                                                </select>

                                            </div>
                                            <div class="form-check">
                                                <input type="hidden" name="gepatitb" value="0">
                                                <input class="form-check-input" type="checkbox" name="gepatitb" value="1" id="gepatitb">
                                                <label class="form-check-label" for="gepatitb">Гепатит B</label>
                                            </div>
                                            <div class="form-check">
                                                <input type="hidden" name="bcjm" value="0">
                                                <input class="form-check-input" type="checkbox" name="bcjm" value="1" id="bcjm">
                                                <label class="form-check-label" for="bcjm">БЦЖ-М</label>
                                            </div>
                                            <hr>
                                            <div>
                                                <label class="form-check-label" for="skrinning">Скриннинг</label>
                                                <select name="skrinning" class="form-select" id="skrinning">
                                                    <option value=""></option>
                                                    <option value="roddom">В роддоме</option>
                                                    <option value="policlinic">В поликлинике</option>
                                                </select>


                                            </div>
                                            <div class="form-check">
                                                <input type="hidden" name="audio" value="0">
                                                <input class="form-check-input" type="checkbox" name="audio" value="1" id="audio">
                                                <label class="form-check-label" for="audio">Аудио</label>
                                            </div>

                                            <div class="form-check">
                                                <input type="hidden" name="vich" value="0">
                                                <input class="form-check-input" type="checkbox" name="vich" value="1" id="vich">
                                                <label class="form-check-label" for="vich">Вич</label>
                                            </div>

                                            <div class="form-check">
                                                <input type="hidden" name="gepatit" value="0">
                                                <input class="form-check-input" type="checkbox" name="gepatit" value="1" id="gepatit">
                                                <label class="form-check-label" for="gepatit">Гепатит</label>
                                            </div>

                                            <div class="form-check">
                                                <input type="hidden" name="recepient" value="0">
                                                <input class="form-check-input" type="checkbox" name="recepient" value="1" id="recepient">
                                                <label class="form-check-label" for="recepient">Рецепиент крови</label>
                                            </div>
                                            <div>


                                                <div class="form-check">
                                                    <input type="hidden" name="gruppasvs" value="0">
                                                    <input class="form-check-input" type="checkbox" name="gruppasvs" value="1" id="gruppasvs">
                                                    <label class="form-check-label" for="gruppasvs">СВС</label>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="modal-footer p-0">
                                            <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Закрыть</button>
                                            <button type="submit" class="btn btn-success">Сохранить</button>

                                        </div>
                                </form>
                            </x-modal>
        </li>
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


        
      </ul>
      
      
    </div>
    
    <form class="d-flex">
    <button type="button" class="btn btn-demo" data-bs-toggle="modal" data-bs-target="#myModal2">
    <span class="material-icons-two-tone float-start">filter_alt</span> Фильтры
		</button>
    </form>
</nav>
@endauth