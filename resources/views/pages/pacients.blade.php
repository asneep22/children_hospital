@extends('app.app')

@section('content')

<div class="container-fluid mt-3">
  <div class="row">
    <div class="table-responsive">
      <table class="table table-sm table-bordered">
        <thead>
          <tr class="">
            <th scope="col">
              <a data-filter="id|{{$check[0] == 'id' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter" href="#">ID</a>
            </th>
            <th scope="col">

              <a data-filter="lastname|{{$check[0] == 'lastname' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter" href="#">Фамилия Имя Отчество</a>

            </th>

            <th scope="col">

              <a data-filter="birthday|{{$check[0] == 'birthday' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter" href="#">Дата рождения</a>

            </th>
            <th scope="col">
              <span>Участок</span>
            </th>
            <th scope="col">
              <span>Роддом</span>
            </th>
            <th scope="col">

              <a data-filter="rost|{{$check[0] == 'rost' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter" href="#">Рост</a>

            </th>
            <th scope="col">

              <a data-filter="ves|{{$check[0] == 'ves' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter" href="#">Вес</a>

            </th>
            <th scope="col">

              <a data-filter="pol|{{$check[0] == 'pol' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter" href="#">Пол</a>

            </th>
            <th scope="col">

              <a data-filter="gestaci|{{$check[0] == 'gestaci' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter" href="#">Неделя рождения</a>

            </th>
            <th scope="col">

              <a type="submit" data-filter="date_add|{{$check[0] == 'date_add' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter" href="#">Дата поступления</a>


            </th>
          </tr>
          <tr>
            <th>
              <x-modal modalId="addPacient" modalTitle="Добавить пациента" btnClass="btn-success btn-sm w-100" btnText="+">
                <form class="" action="{{Route('AddPacient')}}" method="post">
                  @csrf
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
                        <input type="date" id="birthday" required name="birthday" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="uchastok_id">Участок</label>
                        <select class="js-select" required name="uchastok_id">
                          @foreach($uchastoks as $uchastok)
                          <option value="{{$uchastok->id}}">{{$uchastok->pname}}</option>
                          @endforeach

                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="mb-3">
                        <label for="roddom_id">Роддом</label>
                        <select class="js-select" required name="roddom_id">
                          @foreach($roddoms as $roddom)
                          <option value="{{$roddom->id}}">{{$roddom->pname}}</option>
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
                        <input type="date" name="date_add" id="date_add" required class="form-control">
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
                    <label for="recommend">Рекомендации</label>
                    <textarea id="recommend" rows="3" name="recommend" class="form-control"></textarea>
                  </div>

                  <div class="modal-footer p-0">
                    <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-success">Сохранить</button>

                  </div>


                </form>
              </x-modal>
            </th>
            <th>
              <form action="{{Route('PacientsPage')}}" id="search" method="get">

                <div class="btn-group w-100">
                  <input type="search" placeholder="Поиск" class="form-control form-control-sm" name="search" value="{{isset($_GET['search']) ? $_GET['search']:''}}">
                  <input type="hidden" name="sort_field" value="{{isset($_GET['sort_field']) ? $_GET['sort_field']:''}}">
                  <input type="hidden" name="date_add" value="{{isset($_GET['date_add']) ? $_GET['date_add']:''}}">
                  <input type="hidden" name="birthday" value="{{isset($_GET['birthday']) ? $_GET['birthday']:''}}">
                  <input type="hidden" name="uchastok_id" value="{{isset($_GET['uchastok_id']) ? $_GET['uchastok_id']:''}}">
                  <input type="hidden" name="roddom_id" value="{{isset($_GET['roddom_id']) ? $_GET['roddom_id']:''}}">
                  <input type="hidden" name="pol" value="{{isset($_GET['pol']) ? $_GET['pol']:''}}">
                  <input type="hidden" name="bolezn" value="{{isset($_GET['bolezn']) ? $_GET['bolezn']:''}}">
                  <button type="submit" class="btn btn-sm btn-success">Найти</button>
                </div>
              </form>
            </th>
            <th>
              <input type="text" class="form-control form-control-sm dateranger" data-field="birthday" placeholder="Дата рождения" value="{{isset($_GET['birthday']) ? $_GET['birthday']:''}}" />
            </th>
            <th>
              <select class="form-select form-select-sm selectform" data-field="uchastok_id">
                <option value="">Выберите участок</option>
                @foreach($uchastoks as $uchastok)
                <option value="{{$uchastok->id}}" {{isset($_GET['uchastok_id'])?( $_GET['uchastok_id'] == $uchastok->id?'selected':''):""}}>{{$uchastok->pname}}</option>
                @endforeach
              </select>
            </th>
            <th>
              <select class="form-select form-select-sm selectform" data-field="roddom_id">
                <option value="">Выберите роддом</option>
                @foreach($roddoms as $roddom)
                <option value="{{$roddom->id}}" {{isset($_GET['roddom_id'])?( $_GET['roddom_id'] == $roddom->id?'selected':''):""}}>{{$roddom->pname}}</option>
                @endforeach
              </select>
            </th>
            <th></th>
            <th></th>
            <th>
              <select class="form-select form-select-sm selectform" data-field="pol">
                <option value="">Пол</option>
                <option value="1" {{isset($_GET['pol'])?( $_GET['pol'] == 1?'selected':''):""}}>Муж</option>
                <option value="2" {{isset($_GET['pol'])?( $_GET['pol'] == 2?'selected':''):""}}>Жен</option>
              </select>
            </th>
            <th>
            <select class="form-select form-select-sm selectform" data-field="bolezn">
                <option value="">Укажите болезнь</option>
                @foreach($bolezns as $bolezn)
                <option value="{{$bolezn->id}}" {{isset($_GET['bolezn'])?( $_GET['bolezn'] == $bolezn->id?'selected':''):""}}>{{$bolezn->pname}}</option>
                @endforeach
              </select>
            </th>
            <th><input type="text" class="form-control form-control-sm dateranger" data-field="date_add" placeholder="Период" value="{{isset($_GET['date_add']) ? $_GET['date_add']:''}}" /></th>

          </tr>
        </thead>
        <tbody>
          @foreach($pacients1 as $pacient)
          <tr class="p-0 m-0" role="button" data-bs-toggle="collapse" data-bs-target="#accordion{{$pacient->id}}" aria-expanded="false" class="clickable">
            <th>
              <a href="{{Route('OnePacientPage', $pacient->id)}}" class="forlink">{{$pacient->id}}</a></td>
            <td>{{$pacient->lastname}} {{$pacient->pname}} {{$pacient->surname}}</td>
            <td class="text-center">{{$pacient->birthday->format('d.m.Y')}}</td>
            <td>{{$pacient->uchastok->pname}}</td>
            <td>{{$pacient->roddom->pname}}</td>
            <td>{{$pacient->rost}}</td>
            <td>{{$pacient->ves}}</td>
            <td class="text-center"><input class="form-check-input" type="checkbox" {{$pacient->pol == 1?'checked':''}} disabled>

            </td>
            <td>{{$pacient->gestaci}}</td>
            <td>{{$pacient->date_add->format('d.m.Y')}}
            </td>
            </td>
          </tr>
          <tr class="p-0 m-0 collapse border border-danger" data-id="{{$pacient->id}}" id="accordion{{$pacient->id}}">
            <td colspan="12" class="p-0 m-0">
              <div class="dropdown">
                <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                  Экспорт
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><button class="dropdown-item exportword" data-name="{{$pacient->lastname}} {{$pacient->pname}} {{$pacient->surname}}" data-id="{{$pacient->id}}">Экспорт в Word</button></li>
                </ul>
              </div>
              <div id="lk{{$pacient->id}}">
                <h2 class="text-center">Личная карточка пациента</h2>
                <div class="row">
                  <div class="col-md-4">
                    <div class="table-responsive">
                      <table class="table table-sm">
                        <tr>
                          <th>Фамилия</th>
                          <td>{{$pacient->lastname}}</td>
                        </tr>
                        <tr>
                          <th>Имя</th>
                          <td>{{$pacient->pname}}</td>
                        </tr>
                        <tr>
                          <th>Отчество</th>
                          <td>{{$pacient->surname}}</td>
                        </tr>
                        <tr>
                          <th>Дата рождения</th>
                          <td>{{$pacient->birthday->format('d.m.Y')}}</td>
                        </tr>
                        <tr>
                          <th>Адрес</th>
                          <td>{{$pacient->address}}</td>
                        </tr>
                      </table>

                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="table-responsive">



                      <table class="table table-sm">
                        <tr>
                          <th>Участок</th>
                          <td>{{$pacient->uchastok->pname}}</td>
                        </tr>
                        <tr>
                          <th>Роддом</th>
                          <td>{{$pacient->roddom->pname}}</td>
                        </tr>
                        <tr>
                          <th>Рост</th>
                          <td>{{$pacient->rost}}</td>
                        </tr>
                        <tr>
                          <th>Вес</th>
                          <td>{{$pacient->ves}}</td>
                        </tr>
                      </table>


                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="table-responsive">
                      <table class="table table-sm">
                        <tr>
                          <th>Пол</th>
                          <td>{{$pacient->pol == 1?'Мальчик':'Девочка'}}</td>
                        </tr>
                        <tr>
                          <th>Срок гестации</th>
                          <td>{{$pacient->gestaci}}</td>
                        </tr>
                        <tr>
                          <th>Дата добавления</th>
                          <td>{{$pacient->date_add->format('d.m.Y')}}</td>
                        </tr>
                        <tr>
                          <th>Рекомендации</th>
                          <td>{{$pacient->recommend}}</td>
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

{{$pacients1->withQueryString()->links()}}

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
@endsection