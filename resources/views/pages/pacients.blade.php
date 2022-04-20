@extends('app.app')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="table-responsive">
            <table class="table table-sm table-bordered">
                <thead>
                    <tr class="">
                        <th scope="col">
                            <a data-filter="id|{{ $check[0] == 'id' ? ($check[1] == 'desc' ? 'asc' : 'desc') : 'asc' }}" class="filter" href="#">ID</a>
                        </th>
                        <th scope="col">

                            <a data-filter="lastname|{{ $check[0] == 'lastname' ? ($check[1] == 'desc' ? 'asc' : 'desc') : 'asc' }}" class="filter" href="#">Фамилия Имя Отчество</a>

                        </th>

                        <th scope="col">

                            <a data-filter="birthday|{{ $check[0] == 'birthday' ? ($check[1] == 'desc' ? 'asc' : 'desc') : 'asc' }}" class="filter" href="#">Дата рождения</a>

                        </th>
                        <th scope="col">
                            <span>Участок</span>
                        </th>
                        <th scope="col">
                            <span>Роддом</span>
                        </th>
                        <th scope="col">

                            <a data-filter="rost|{{ $check[0] == 'rost' ? ($check[1] == 'desc' ? 'asc' : 'desc') : 'asc' }}" class="filter" href="#">Рост</a>

                        </th>
                        <th scope="col">

                            <a data-filter="ves|{{ $check[0] == 'ves' ? ($check[1] == 'desc' ? 'asc' : 'desc') : 'asc' }}" class="filter" href="#">Вес</a>

                        </th>
                        <th scope="col">

                            <a data-filter="pol|{{ $check[0] == 'pol' ? ($check[1] == 'desc' ? 'asc' : 'desc') : 'asc' }}" class="filter" href="#">Пол</a>

                        </th>
                        <th scope="col">

                            <a data-filter="gestaci|{{ $check[0] == 'gestaci' ? ($check[1] == 'desc' ? 'asc' : 'desc') : 'asc' }}" class="filter" href="#">Неделя рождения</a>

                        </th>
                        <th scope="col">

                            <a type="submit" data-filter="date_add|{{ $check[0] == 'date_add' ? ($check[1] == 'desc' ? 'asc' : 'desc') : 'asc' }}" class="filter" href="#">Дата поступления</a>


                        </th>
                    </tr>

                </thead>
                <tbody>
                    @foreach ($pacients1 as $pacient)
                    <tr class="p-0 m-0" role="button" data-bs-toggle="collapse" data-bs-target="#accordion{{ $pacient->id }}" aria-expanded="false" class="clickable">
                        <th>{{ $pacient->id }}</td>
                        <td>{{ $pacient->lastname }} {{ $pacient->pname }} {{ $pacient->surname }}</td>
                        <td class="text-center">{{ $pacient->birthday->format('d.m.Y') }}</td>
                        <td>{{ $pacient->uchastok->pname }}</td>
                        <td>{{ $pacient->roddom->pname }}</td>
                        <td>{{ $pacient->rost }}</td>
                        <td>{{ $pacient->ves }}</td>
                        <td class="text-center"><input class="form-check-input" type="checkbox" {{ $pacient->pol == 1 ? 'checked' : '' }} disabled>

                        </td>
                        <td>{{ $pacient->gestaci }}</td>
                        <td>{{ $pacient->date_add->format('d.m.Y') }}
                        </td>
                        </td>
                    </tr>
                    <tr class="p-0 m-0 collapse pacient border border-danger" data-id="{{ $pacient->id }}" id="accordion{{ $pacient->id }}">
                        <td colspan="12" class="p-0 m-0">
                            <div class="dropdown">
                                <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Операции
                                </button>

                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><button class="dropdown-item exportword" data-name="{{ $pacient->lastname }} {{ $pacient->pname }} {{ $pacient->surname }}" data-id="{{ $pacient->id }}">Экспорт в Word</button></li>
                                    <li>
                                        <button type="button" class="dropdown-item editpacient" data-bs-toggle="modal" data-id="{{ $pacient->id }}" data-bs-target="#addPacient">
                                            Редактировать</button>
                                    </li>
                                    <li><a href="{{ Route('DeletePacient', $pacient->id) }}" class="dropdown-item deletepacient">Удалить</a></li>
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
                                                    <th>Гепатит Б</th>
                                                    <td>{{ $pacient->gepatitb?'Да':'Нет'  }}</td>
                                                </tr>
                                                <tr>
                                                    <th>БЦЖ-М</th>
                                                    <td>{{ $pacient->bcjm?'Да':'Нет' }}</td>
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
                                                    <th>Вес</th>
                                                    <td>{{ $pacient->ves }}</td>
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
    <div class="container">
        <div class="alert alert-primary" role="alert">
            Всего пациентов: <strong>{{$pacients1->total()}}</strong>
        </div>

    </div>

    {{ $pacients1->withQueryString()->links() }}

</div>
<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="reportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post">
                <div class="modal-header">
                    <h5 class="modal-title" id="reportModalLabel">Отчет</h5>
                    <button type="button" class="btn-close" id="closewin" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <button type="button" class="btn-close" id="closewin1" data-bs-dismiss="modal" aria-label="Close"></button>
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
                    <button type="button" class="btn-close" id="closewin2" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pnamep">Название</label>
                        <input type="text" id="pnamep" name="pname" required class="form-control" value="{{ $policlinic->pname }}" />
                    </div>
                    <div class="form-group">
                        <label for="addressp">Адрес</label>
                        <input type="text" id="addressp" name="address" required class="form-control" value="{{ $policlinic->address }}" />
                    </div>
                    <div class="form-group">
                        <label for="zavedname">Заведующий</label>
                        <input type="text" id="zavedname" name="zavedname" required class="form-control" value="{{ $policlinic->zavedname }}" />
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
                <button type="button" class="btn-close" id="closewin3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @foreach ($roddoms as $rod)
                <form action="" class="roddomSuccess" data-name="saveroddom">
                    <div class="row">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="pname" value="{{ $rod->pname }}" required>
                            <input type="hidden" name="id" value="{{ $rod->id }}">
                            <button type="submit" class="btn btn-success btn-sm"><span class="material-icons-two-tone float-start">save</span> </button>
                            <button type="button" class="btn btn-danger btn-sm deletespr" data-name="roddomdelete"><span class="material-icons-two-tone float-start">delete_sweep</span> </button>
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
                <button type="button" class="btn-close" id="closewin4" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @foreach ($uchastoks as $rod)
                <form action="" class="uchastokSuccess" data-name="saveuchastok">
                    <div class="row">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="pname" value="{{ $rod->pname }}" required>
                            <input type="hidden" name="id" value="{{ $rod->id }}">
                            <button type="submit" class="btn btn-success btn-sm"><span class="material-icons-two-tone float-start">save</span> </button>
                            <button type="button" class="btn btn-danger btn-sm deletespr" data-name="uchastokdelete"><span class="material-icons-two-tone float-start">delete_sweep</span> </button>
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
                <button type="button" class="btn-close" id="closewin5" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @foreach ($stacionars as $rod)
                <form action="" class="stacionarSuccess" data-name="savestacionar">
                    <div class="row">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="pname" value="{{ $rod->pname }}" required>
                            <input type="hidden" name="id" value="{{ $rod->id }}">
                            <button type="submit" class="btn btn-success btn-sm"><span class="material-icons-two-tone float-start">save</span> </button>
                            <button type="button" class="btn btn-danger btn-sm deletespr" data-name="stacionardelete"><span class="material-icons-two-tone float-start">delete_sweep</span> </button>
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
                <button type="button" class="btn-close" id="closewin6" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                @foreach ($vacines as $rod)
                <form action="" class="vacineSuccess" data-name="savevacine">
                    <div class="row">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="pname" value="{{ $rod->pname }}" required>
                            <input type="hidden" name="id" value="{{ $rod->id }}">
                            <button type="submit" class="btn btn-success btn-sm"><span class="material-icons-two-tone float-start">save</span> </button>
                            <button type="button" class="btn btn-danger btn-sm deletespr" data-name="vacinedelete"><span class="material-icons-two-tone float-start">delete_sweep</span> </button>
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
                <button type="button" class="btn-close" id="closewin7" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input class="form-check-input mt-0" type="checkbox" value="" checked disabled> - Q

                @foreach ($bolezns as $rod)
                <form action="" class="boleznSuccess" data-name="savebolezn">
                    <div class="row">
                        <div class="input-group mb-2">
                            <input type="text" class="form-control" name="pname" value="{{ $rod->pname }}" required>
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" name="q" type="checkbox" value="1" {{ $rod->q ? 'checked' : '' }}>
                            </div>
                            <input type="hidden" name="id" value="{{ $rod->id }}">
                            <button type="submit" class="btn btn-success btn-sm"><span class="material-icons-two-tone float-start">save</span> </button>
                            <button type="button" class="btn btn-danger btn-sm deletespr" data-name="bolezndelete"><span class="material-icons-two-tone float-start">delete_sweep</span> </button>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="modal right fade" id="myModal2" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" id="reset" class="btn btn-success btn-sm mb-3 w-100 text-white">Сбросить все фильтры</button>

                <form action="{{ Route('PacientsPage') }}" id="search" method="get">
                    <div class="btn-group w-100">
                        <input type="search" placeholder="Поиск по ФИО" class="form-control form-control-sm" name="search" value="{{ isset($_GET['search']) ? $_GET['search'] : '' }}">
                        <input type="hidden" name="sort_field" value="{{ isset($_GET['sort_field']) ? $_GET['sort_field'] : '' }}">
                        <input type="hidden" name="date_add" value="{{ isset($_GET['date_add']) ? $_GET['date_add'] : '' }}">
                        <input type="hidden" name="birthday" value="{{ isset($_GET['birthday']) ? $_GET['birthday'] : '' }}">
                        <input type="hidden" name="uchastok_id" value="{{ isset($_GET['uchastok_id']) ? $_GET['uchastok_id'] : '' }}">
                        <input type="hidden" name="roddom_id" value="{{ isset($_GET['roddom_id']) ? $_GET['roddom_id'] : '' }}">
                        <input type="hidden" name="pol" value="{{ isset($_GET['pol']) ? $_GET['pol'] : '' }}">
                        <input type="hidden" name="vich" value="{{ isset($_GET['vich']) ? $_GET['vich'] : '' }}">
                        <input type="hidden" name="bolezn" value="{{ isset($_GET['bolezn']) ? $_GET['bolezn'] : '' }}">
                        <input type="hidden" name="skrinning" value="{{ isset($_GET['skrinning']) ? $_GET['skrinning'] : '' }}">
                        <input type="hidden" name="gepatit" value="{{ isset($_GET['gepatit']) ? $_GET['gepatit'] : '' }}">
                        <input type="hidden" name="gruppasvs" value="{{ isset($_GET['gruppasvs']) ? $_GET['gruppasvs'] : '' }}">
                        <input type="hidden" name="recepient" value="{{ isset($_GET['recepient']) ? $_GET['recepient'] : '' }}">
                        <input type="hidden" name="ves" value="{{ isset($_GET['ves']) ? $_GET['ves'] : '' }}">
                        <input type="hidden" name="vacine" value="{{ isset($_GET['vacine']) ? $_GET['vacine'] : '' }}">
                        <button type="submit" class="btn btn-sm btn-success">Найти</button>
                    </div>
                </form>
                <label for="dr1" class="mt-2">Дата рождения</label>
                <input type="text" class="form-control form-control-sm dateranger" id="dr1" data-field="birthday" placeholder="Дата рождения" value="{{ isset($_GET['birthday']) ? $_GET['birthday'] : '' }}" />
                <div class="row">
                    <div class="col-md-6"><label for="dr2" class="mt-2">Участок</label>
                        <select class="form-select form-select-sm selectform" id="dr2" data-field="uchastok_id">
                            <option value="">Выберите участок</option>
                            @foreach ($uchastoks as $uchastok)
                            <option value="{{ $uchastok->id }}" {{ isset($_GET['uchastok_id']) ? ($_GET['uchastok_id'] == $uchastok->id ? 'selected' : '') : '' }}>
                                {{ $uchastok->pname }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6"><label for="dr3" class="mt-2">Роддом</label>
                        <select class="form-select form-select-sm selectform" id="dr3" data-field="roddom_id">
                            <option value="">Выберите роддом</option>
                            @foreach ($roddoms as $roddom)
                            <option value="{{ $roddom->id }}" {{ isset($_GET['roddom_id']) ? ($_GET['roddom_id'] == $roddom->id ? 'selected' : '') : '' }}>
                                {{ $roddom->pname }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6"><label for="dr4" class="mt-2">Пол</label>
                        <select class="form-select form-select-sm selectform" id="dr4" data-field="pol">
                            <option value="">Пол</option>
                            <option value="1" {{ isset($_GET['pol']) ? ($_GET['pol'] == 1 ? 'selected' : '') : '' }}>Муж
                            </option>
                            <option value="2" {{ isset($_GET['pol']) ? ($_GET['pol'] == 2 ? 'selected' : '') : '' }}>Жен
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6"><label for="dr7" class="mt-2">Скриннинг</label>
                        <select class="form-select form-select-sm selectform" id="dr7" data-field="skrinning">
                            <option value="">-</option>
                            <option value="roddom" {{ isset($_GET['skrinning']) ? ($_GET['skrinning'] == 'roddom' ? 'selected' : '') : '' }}>Роддом
                            </option>
                            <option value="policlinic" {{ isset($_GET['skrinning']) ? ($_GET['skrinning'] == 'policlinic' ? 'selected' : '') : '' }}>Поликлиника
                            </option>
                        </select>
                    </div>
                </div>



                <label for="dr5" class="mt-2">Заболевание</label>
                <select class="form-select form-select-sm selectform" id="dr5" data-field="bolezn">
                    <option value="">Укажите болезнь</option>
                    @foreach ($bolezns as $bolezn)
                    <option value="{{ $bolezn->id }}" {{ isset($_GET['bolezn']) ? ($_GET['bolezn'] == $bolezn->id ? 'selected' : '') : '' }}>
                        {{ $bolezn->pname }}
                    </option>
                    @endforeach
                </select>
                <label for="dr6" class="mt-2">Период</label>
                <input type="text" class="form-control form-control-sm dateranger" id="dr6" data-field="date_add" placeholder="Период" value="{{ isset($_GET['date_add']) ? $_GET['date_add'] : '' }}" />

                <div class="row">
                    <div class="col-md-6"><label for="dr8" class="mt-2">ВИЧ</label>
                        <select class="form-select form-select-sm selectform" id="dr8" data-field="vich">
                            <option value="">Нет
                            </option>
                            <option value="1" {{ isset($_GET['vich']) ? ($_GET['vich'] == 1 ? 'selected' : '') : '' }}>Да
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6"><label for="dr9" class="mt-2">Гепатит</label>
                        <select class="form-select form-select-sm selectform" id="dr9" data-field="gepatit">
                            <option value="">Нет
                            </option>
                            <option value="1" {{ isset($_GET['gepatit']) ? ($_GET['gepatit'] == 1 ? 'selected' : '') : '' }}>Да
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"><label for="dr10" class="mt-2">Рецепиент</label>
                        <select class="form-select form-select-sm selectform" id="dr10" data-field="recepient">
                            <option value="">Нет
                            </option>
                            <option value="1" {{ isset($_GET['recepient']) ? ($_GET['recepient'] == 1 ? 'selected' : '') : '' }}>Да
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6"><label for="dr11" class="mt-2">СВС</label>
                        <select class="form-select form-select-sm selectform" id="dr11" data-field="gruppasvs">
                            <option value="">Нет
                            </option>
                            <option value="1" {{ isset($_GET['gruppasvs']) ? ($_GET['gruppasvs'] == 1 ? 'selected' : '') : '' }}>Да
                            </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <label for="dr11" class="mt-2">Вес</label>
                        <select class="form-select form-select-sm selectform" id="dr11" data-field="ves">
                            <option value=""></option>
                            <option value="1" {{ isset($_GET['ves']) ? ($_GET['ves'] == 1 ? 'selected' : '') : '' }}>НМТ
                            </option>
                            <option value="2" {{ isset($_GET['ves']) ? ($_GET['ves'] == 2 ? 'selected' : '') : '' }}>ОНМТ
                            </option>
                            <option value="3" {{ isset($_GET['ves']) ? ($_GET['ves'] == 3 ? 'selected' : '') : '' }}>ЭНМТ
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6">
                    <label for="dr12" class="mt-2">Прививки</label>
                        <select class="form-select form-select-sm selectform" id="dr12" data-field="vacine">
                            <option value=""></option>
                            <option value="1" {{ isset($_GET['vacine']) ? ($_GET['vacine'] == 1 ? 'selected' : '') : '' }}>Без прививок
                            </option>
                            <option value="2" {{ isset($_GET['vacine']) ? ($_GET['vacine'] == 2 ? 'selected' : '') : '' }}>Без БЦЖ-М
                            </option>
                            <option value="3" {{ isset($_GET['vacine']) ? ($_GET['vacine'] == 3 ? 'selected' : '') : '' }}>Без Гепатита Б
                            </option>
                            <option value="4" {{ isset($_GET['vacine']) ? ($_GET['vacine'] == 4 ? 'selected' : '') : '' }}>Все прививки
                            </option>
                        </select>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>


@endsection