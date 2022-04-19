@extends('app.app')

@section('content')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="table-responsive">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr class="">
                            <th scope="col">
                                <a data-filter="id|{{ $check[0] == 'id' ? ($check[1] == 'desc' ? 'asc' : 'desc') : 'asc' }}"
                                    class="filter" href="#">ID</a>
                            </th>
                            <th scope="col">

                                <a data-filter="lastname|{{ $check[0] == 'lastname' ? ($check[1] == 'desc' ? 'asc' : 'desc') : 'asc' }}"
                                    class="filter" href="#">Фамилия Имя Отчество</a>

                            </th>

                            <th scope="col">

                                <a data-filter="birthday|{{ $check[0] == 'birthday' ? ($check[1] == 'desc' ? 'asc' : 'desc') : 'asc' }}"
                                    class="filter" href="#">Дата рождения</a>

                            </th>
                            <th scope="col">
                                <span>Участок</span>
                            </th>
                            <th scope="col">
                                <span>Роддом</span>
                            </th>
                            <th scope="col">

                                <a data-filter="rost|{{ $check[0] == 'rost' ? ($check[1] == 'desc' ? 'asc' : 'desc') : 'asc' }}"
                                    class="filter" href="#">Рост</a>

                            </th>
                            <th scope="col">

                                <a data-filter="ves|{{ $check[0] == 'ves' ? ($check[1] == 'desc' ? 'asc' : 'desc') : 'asc' }}"
                                    class="filter" href="#">Вес</a>

                            </th>
                            <th scope="col">

                                <a data-filter="pol|{{ $check[0] == 'pol' ? ($check[1] == 'desc' ? 'asc' : 'desc') : 'asc' }}"
                                    class="filter" href="#">Пол</a>

                            </th>
                            <th scope="col">

                                <a data-filter="gestaci|{{ $check[0] == 'gestaci' ? ($check[1] == 'desc' ? 'asc' : 'desc') : 'asc' }}"
                                    class="filter" href="#">Неделя рождения</a>

                            </th>
                            <th scope="col">

                                <a type="submit"
                                    data-filter="date_add|{{ $check[0] == 'date_add' ? ($check[1] == 'desc' ? 'asc' : 'desc') : 'asc' }}"
                                    class="filter" href="#">Дата поступления</a>


                            </th>
                        </tr>
                        <tr>
                            <th>
                                <x-modal modalId="addPacient" modalTitle="Добавить пациента"
                                    btnClass="btn-success btn-sm w-100" btnText="+">
                                    <form class="" action="{{ Route('AddPacient') }}" method="post">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                                    data-bs-target="#home" type="button" role="tab" aria-controls="home"
                                                    aria-selected="true">Основные сведения</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                                    data-bs-target="#profile" type="button" role="tab"
                                                    aria-controls="profile" aria-selected="false">Периоды болезни</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                                    data-bs-target="#contact" type="button" role="tab"
                                                    aria-controls="contact" aria-selected="false">Прививки</button>
                                            </li>
                                        </ul>

                                        @csrf
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="home" role="tabpanel"
                                                aria-labelledby="home-tab">

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="lastname">Фамилия</label>
                                                            <input type="text" id="lastname" required name="lastname"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="pname">Имя</label>
                                                            <input type="text" id="pname" required name="pname"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="surname">Отчество</label>
                                                            <input type="text" id="surname" required name="surname"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="birthday">Дата рождения</label>
                                                            <input type="date" id="birthday" required name="birthday"
                                                                class="form-control" value="{{Carbon\Carbon::now()->format('Y-m-d')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="uchastok_id">Участок</label>
                                                            <select class="js-select" required name="uchastok_id">
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
                                                            <select class="js-select" required name="roddom_id">
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
                                                            <input type="number" id="rost" required name="rost"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="ves">Вес</label>
                                                            <input type="number" id="ves" step="0.1" required name="ves"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="gestaci">Неделя рождения</label>
                                                            <input type="number" id="gestaci" step="0.1" required
                                                                name="gestaci" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label for="date_add">Дата поступления</label>
                                                            <input type="date" name="date_add" id="date_add"  value="{{Carbon\Carbon::now()->format('Y-m-d')}}" required
                                                                class="form-control">
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
                                                            <input type="text" name="address" id="address"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="recommend">Рекомендации</label>
                                                    <textarea id="recommend" rows="3" name="recommend" class="form-control"></textarea>
                                                </div>





                                            </div>
                                            <div class="tab-pane fade" id="profile" role="tabpanel"
                                                aria-labelledby="profile-tab">

                                                <button class="btn btn-success my-2" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseFormAdd" aria-expanded="false"
                                                    aria-controls="collapseFormAdd">+</button>

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
                                                            <select class="js-select3 w-100" name="pac_stacionar_id"
                                                                id="pac_stacionar_id">
                                                                <option value=""></option>
                                                                @foreach ($stacionars as $stacionar)
                                                                    <option value="{{ $stacionar->pname }}">
                                                                        {{ $stacionar->pname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                      </div>

                                                    <div class="mb-2">
                                                        <label for="pac_diagnoz">Диагноз</label>
                                                        <select class="js-select3 w-100" name="diagnoz[]" multiple
                                                            id="pac_diagnoz">
                                                            @foreach ($bolezns as $bolezn)
                                                                <option value="{{ $bolezn->pname }}">{{ $bolezn->pname }}
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
                                                            <input type="date" id="pac_date_in" name="date_in"
                                                                class="form-control">
                                                        </div>
                                                        <div class="col-md-6"><label for="pac_date_ou">Дата
                                                                выписки</label>
                                                            <input type="date" id="pac_date_ou" name="date_ou"
                                                                class="form-control">
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
                                            <div class="tab-pane fade" id="contact" role="tabpanel"
                                                aria-labelledby="contact-tab">
                                                <div class="form-group">

                                                
                                                <label for="vacines">Вакцины</label>
                                                <select class="js-select2 w-100" name="vacine[]" id="vacines"
                                                    multiple="multiple">
                                                    @foreach ($vacines as $vacine)
                                                        <option value="{{ $vacine->pname }}"
                                                            {{ $vacine->selected ? 'selected' : '' }}>
                                                            {{ $vacine->pname }}
                                                        </option>
                                                    @endforeach
                                                </select>

                                              </div>
                                                <div class="form-check">
                                                  <input type="hidden" name="audio" value="0">
                                                  <input class="form-check-input" type="checkbox" name="audio" value="1" id="audio" >
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
                                                <div class="form-check">
                                                  <input type="hidden" name="skrininng" value="0">
                                                  <input class="form-check-input" type="checkbox" name="skrininng" value="1" id="skrininng">
                                                  <label class="form-check-label" for="skrininng">Скриннинг</label>
                                                </div>
                                      
                                                <div class="form-check">
                                                  <input type="hidden" name="gruppasvs" value="0">
                                                  <input class="form-check-input" type="checkbox" name="gruppasvs" value="1" id="gruppasvs">
                                                  <label class="form-check-label" for="gruppasvs">СВС</label>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="modal-footer p-0">
                                            <button type="button" class="btn btn-secondary m-0"
                                                data-bs-dismiss="modal">Закрыть</button>
                                            <button type="submit" class="btn btn-success">Сохранить</button>

                                        </div>
                                    </form>
                                </x-modal>
                            </th>
                            <th>
                                <form action="{{ Route('PacientsPage') }}" id="search" method="get">

                                    <div class="btn-group w-100">
                                        <input type="search" placeholder="Поиск" class="form-control form-control-sm"
                                            name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}">
                                        <input type="hidden" name="sort_field"
                                            value="{{ isset($_GET['sort_field']) ? $_GET['sort_field'] : '' }}">
                                        <input type="hidden" name="date_add"
                                            value="{{ isset($_GET['date_add']) ? $_GET['date_add'] : '' }}">
                                        <input type="hidden" name="birthday"
                                            value="{{ isset($_GET['birthday']) ? $_GET['birthday'] : '' }}">
                                        <input type="hidden" name="uchastok_id"
                                            value="{{ isset($_GET['uchastok_id']) ? $_GET['uchastok_id'] : '' }}">
                                        <input type="hidden" name="roddom_id"
                                            value="{{ isset($_GET['roddom_id']) ? $_GET['roddom_id'] : '' }}">
                                        <input type="hidden" name="pol"
                                            value="{{ isset($_GET['pol']) ? $_GET['pol'] : '' }}">
                                        <input type="hidden" name="bolezn"
                                            value="{{ isset($_GET['bolezn']) ? $_GET['bolezn'] : '' }}">
                                        <button type="submit" class="btn btn-sm btn-success">Найти</button>
                                    </div>
                                </form>
                            </th>
                            <th>
                                <input type="text" class="form-control form-control-sm dateranger" data-field="birthday"
                                    placeholder="Дата рождения"
                                    value="{{ isset($_GET['birthday']) ? $_GET['birthday'] : '' }}" />
                            </th>
                            <th>
                                <select class="form-select form-select-sm selectform" data-field="uchastok_id">
                                    <option value="">Выберите участок</option>
                                    @foreach ($uchastoks as $uchastok)
                                        <option value="{{ $uchastok->id }}"
                                            {{ isset($_GET['uchastok_id']) ? ($_GET['uchastok_id'] == $uchastok->id ? 'selected' : '') : '' }}>
                                            {{ $uchastok->pname }}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th>
                                <select class="form-select form-select-sm selectform" data-field="roddom_id">
                                    <option value="">Выберите роддом</option>
                                    @foreach ($roddoms as $roddom)
                                        <option value="{{ $roddom->id }}"
                                            {{ isset($_GET['roddom_id']) ? ($_GET['roddom_id'] == $roddom->id ? 'selected' : '') : '' }}>
                                            {{ $roddom->pname }}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th></th>
                            <th></th>
                            <th>
                                <select class="form-select form-select-sm selectform" data-field="pol">
                                    <option value="">Пол</option>
                                    <option value="1"
                                        {{ isset($_GET['pol']) ? ($_GET['pol'] == 1 ? 'selected' : '') : '' }}>Муж
                                    </option>
                                    <option value="2"
                                        {{ isset($_GET['pol']) ? ($_GET['pol'] == 2 ? 'selected' : '') : '' }}>Жен
                                    </option>
                                </select>
                            </th>
                            <th>
                                <select class="form-select form-select-sm selectform" data-field="bolezn">
                                    <option value="">Укажите болезнь</option>
                                    @foreach ($bolezns as $bolezn)
                                        <option value="{{ $bolezn->id }}"
                                            {{ isset($_GET['bolezn']) ? ($_GET['bolezn'] == $bolezn->id ? 'selected' : '') : '' }}>
                                            {{ $bolezn->pname }}</option>
                                    @endforeach
                                </select>
                            </th>
                            <th><input type="text" class="form-control form-control-sm dateranger" data-field="date_add"
                                    placeholder="Период"
                                    value="{{ isset($_GET['date_add']) ? $_GET['date_add'] : '' }}" />
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pacients1 as $pacient)
                            <tr class="p-0 m-0" role="button" data-bs-toggle="collapse"
                                data-bs-target="#accordion{{ $pacient->id }}" aria-expanded="false"
                                class="clickable">
                                <th>{{ $pacient->id }}</td>
                                <td>{{ $pacient->lastname }} {{ $pacient->pname }} {{ $pacient->surname }}</td>
                                <td class="text-center">{{ $pacient->birthday->format('d.m.Y') }}</td>
                                <td>{{ $pacient->uchastok->pname }}</td>
                                <td>{{ $pacient->roddom->pname }}</td>
                                <td>{{ $pacient->rost }}</td>
                                <td>{{ $pacient->ves }}</td>
                                <td class="text-center"><input class="form-check-input" type="checkbox"
                                        {{ $pacient->pol == 1 ? 'checked' : '' }} disabled>

                                </td>
                                <td>{{ $pacient->gestaci }}</td>
                                <td>{{ $pacient->date_add->format('d.m.Y') }}
                                </td>
                                </td>
                            </tr>
                            <tr class="p-0 m-0 collapse pacient border border-danger" data-id="{{ $pacient->id }}"
                                id="accordion{{ $pacient->id }}">
                                <td colspan="12" class="p-0 m-0">
                                    <div class="dropdown">
                                        <button class="btn btn-warning dropdown-toggle" type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Операции
                                        </button>
                                        
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li><button class="dropdown-item exportword"
                                                    data-name="{{ $pacient->lastname }} {{ $pacient->pname }} {{ $pacient->surname }}"
                                                    data-id="{{ $pacient->id }}">Экспорт в Word</button></li>
                                            <li><button class="dropdown-item exportword"
                                                    data-name="{{ $pacient->lastname }} {{ $pacient->pname }} {{ $pacient->surname }}"
                                                    data-id="{{ $pacient->id }}">Редактировать</button></li>
                                            <li><a href="{{Route('DeletePacient', $pacient->id)}}" class="dropdown-item deletepacient"                                                    
                                                    >Удалить</a></li>
                                        </ul>
                                    </div>
                                    <div id="lk{{ $pacient->id }}">
                                        <h2 class="text-center">Личная карточка пациента</h2>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="table-responsive">
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <th>Фамилия</th>
                                                            <td>{{ $pacient->lastname }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Имя</th>
                                                            <td>{{ $pacient->pname }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Отчество</th>
                                                            <td>{{ $pacient->surname }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Дата рождения</th>
                                                            <td>{{ $pacient->birthday->format('d.m.Y') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Адрес</th>
                                                            <td>{{ $pacient->address }}</td>
                                                        </tr>
                                                    </table>

                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="table-responsive">



                                                    <table class="table table-sm">
                                                        <tr>
                                                            <th>Участок</th>
                                                            <td>{{ $pacient->uchastok->pname }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Роддом</th>
                                                            <td>{{ $pacient->roddom->pname }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Рост</th>
                                                            <td>{{ $pacient->rost }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Вес</th>
                                                            <td>{{ $pacient->ves }}</td>
                                                        </tr>
                                                    </table>


                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="table-responsive">
                                                    <table class="table table-sm">
                                                        <tr>
                                                            <th>Пол</th>
                                                            <td>{{ $pacient->pol == 1 ? 'Мальчик' : 'Девочка' }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Срок гестации</th>
                                                            <td>{{ $pacient->gestaci }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Дата добавления</th>
                                                            <td>{{ $pacient->date_add->format('d.m.Y') }}</td>
                                                        </tr>
                                                        <tr>
                                                            <th>Рекомендации</th>
                                                            <td>{{ $pacient->recommend }}</td>
                                                        </tr>
                                                    </table>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="preload">
                                            <div class="text-center">
                                                <div class="lds-heart">
                                                    <div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
            </div>
            </td>
            </tr>
            @endforeach
            </tbody>
            </table>




        </div>

        {{ $pacients1->withQueryString()->links() }}

    </div>
    <div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportModalLabel">Отчет</h5>
                        <button type="button" class="btn-close" id="closewin" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" required class="form-control daterangerreport" placeholder="Период" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="reportModal1" tabindex="-1" aria-labelledby="reportModalLabel1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportModalLabel1">Отчет</h5>
                        <button type="button" class="btn-close" id="closewin1" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" required class="form-control daterangerreport1" placeholder="Период" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="policlinicModal" tabindex="-1" aria-labelledby="reportPoliclinic" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" id="formsavepoliclinic" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="reportPoliclinic">Сведения о поликлинике</h5>
                        <button type="button" class="btn-close" id="closewin2" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="pnamep">Название</label>
                            <input type="text" id="pnamep" name="pname" required class="form-control"
                                value="{{ $policlinic->pname }}" />
                        </div>
                        <div class="form-group">
                            <label for="addressp">Адрес</label>
                            <input type="text" id="addressp" name="address" required class="form-control"
                                value="{{ $policlinic->address }}" />
                        </div>
                        <div class="form-group">
                            <label for="zavedname">Заведующий</label>
                            <input type="text" id="zavedname" name="zavedname" required class="form-control"
                                value="{{ $policlinic->zavedname }}" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="roddomModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Родильные дома</h5>
                    <button type="button" class="btn-close" id="closewin3" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @foreach ($roddoms as $rod)
                        <form action="" class="roddomSuccess" data-name="saveroddom">
                            <div class="row">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="pname" value="{{ $rod->pname }}"
                                        required>
                                    <input type="hidden" name="id" value="{{ $rod->id }}">
                                    <button type="submit" class="btn btn-success btn-sm"><span
                                            class="material-icons-two-tone float-start">save</span> </button>
                                    <button type="button" class="btn btn-danger btn-sm deletespr"
                                        data-name="roddomdelete"><span
                                            class="material-icons-two-tone float-start">delete_sweep</span> </button>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="uchastokModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Участки</h5>
                    <button type="button" class="btn-close" id="closewin4" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @foreach ($uchastoks as $rod)
                        <form action="" class="uchastokSuccess" data-name="saveuchastok">
                            <div class="row">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="pname" value="{{ $rod->pname }}"
                                        required>
                                    <input type="hidden" name="id" value="{{ $rod->id }}">
                                    <button type="submit" class="btn btn-success btn-sm"><span
                                            class="material-icons-two-tone float-start">save</span> </button>
                                    <button type="button" class="btn btn-danger btn-sm deletespr"
                                        data-name="uchastokdelete"><span
                                            class="material-icons-two-tone float-start">delete_sweep</span> </button>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="stacionarModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Стационары</h5>
                    <button type="button" class="btn-close" id="closewin5" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @foreach ($stacionars as $rod)
                        <form action="" class="stacionarSuccess" data-name="savestacionar">
                            <div class="row">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="pname" value="{{ $rod->pname }}"
                                        required>
                                    <input type="hidden" name="id" value="{{ $rod->id }}">
                                    <button type="submit" class="btn btn-success btn-sm"><span
                                            class="material-icons-two-tone float-start">save</span> </button>
                                    <button type="button" class="btn btn-danger btn-sm deletespr"
                                        data-name="stacionardelete"><span
                                            class="material-icons-two-tone float-start">delete_sweep</span> </button>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="vacineModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Вакцины</h5>
                    <button type="button" class="btn-close" id="closewin6" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    @foreach ($vacines as $rod)
                        <form action="" class="vacineSuccess" data-name="savevacine">
                            <div class="row">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="pname" value="{{ $rod->pname }}"
                                        required>
                                    <input type="hidden" name="id" value="{{ $rod->id }}">
                                    <button type="submit" class="btn btn-success btn-sm"><span
                                            class="material-icons-two-tone float-start">save</span> </button>
                                    <button type="button" class="btn btn-danger btn-sm deletespr"
                                        data-name="vacinedelete"><span
                                            class="material-icons-two-tone float-start">delete_sweep</span> </button>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="boleznModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Болезни</h5>
                    <button type="button" class="btn-close" id="closewin7" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input class="form-check-input mt-0" type="checkbox" value="" checked disabled> - Q

                    @foreach ($bolezns as $rod)
                        <form action="" class="boleznSuccess" data-name="savebolezn">
                            <div class="row">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" name="pname" value="{{ $rod->pname }}"
                                        required>
                                    <div class="input-group-text">
                                        <input class="form-check-input mt-0" name="q" type="checkbox" value="1"
                                            {{ $rod->q ? 'checked' : '' }}>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $rod->id }}">
                                    <button type="submit" class="btn btn-success btn-sm"><span
                                            class="material-icons-two-tone float-start">save</span> </button>
                                    <button type="button" class="btn btn-danger btn-sm deletespr"
                                        data-name="bolezndelete"><span
                                            class="material-icons-two-tone float-start">delete_sweep</span> </button>
                                </div>
                            </div>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
