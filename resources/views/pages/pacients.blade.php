@extends('app.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="table-responsive">
      <table class="table table-sm table-hover table-bordered">
        <thead class="align-start">
          <tr>
            <th colspan="5">
              <x-modal modalId="addPacient" modalTitle="Добавить пациента" btnClass="btn-success w-100" btnText="Добавить пациента">
                <form class="" action="{{Route('AddPacient')}}" method="post">
                  @csrf
                  <div class="mb-3">
                    <label for="lastname">Фамилия</label>
                    <input type="text" id="lastname" name="lastname" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="pname">Имя</label>
                    <input type="text" id="pname" name="pname" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="surname">Отчество</label>
                    <input type="text" id="surname" name="surname" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="birthday">Дата рождения</label>
                    <input type="date" id="birthday" name="birthday" class="form-control">
                  </div>
                  <div class="mb-3">
                    <label for="uchastok_id">Участок</label>
                    <select class="js-select" name="uchastok_id">
                      @foreach($uchastoks as $uchastok)
                      <option value="{{$uchastok->id}}">{{$uchastok->pname}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="mb-3">
                    <label for="roddom_id">Роддом</label>
                    <select class="js-select" name="roddom_id">
                      @foreach($roddoms as $roddom)
                      <option value="{{$roddom->id}}">{{$roddom->pname}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="d-flex mb-3">
                    <div class="w-50">
                      <label for="rost">Рост</label>
                      <input type="text" id="rost" name="rost" class="form-control">
                    </div>
                    <div class="mx-2 w-50">
                      <label for="ves">Вес</label>
                      <input type="text" id="ves" name="ves" class="form-control">
                    </div>
                    <div class="mx-2 w-50">
                      <label for="gestaci">Неделя рождения</label>
                      <input type="text" id="gestaci" name="gestaci" class="form-control">
                    </div>
                  </div>

                  <div class="mb-3">
                    <label for="date_add">Дата поступления</label>
                    <input type="date" name="date_add" class="form-control">
                  </div>

                  <div class="mb-3">
                    <label for="birthday">Рекомендации</label>
                    <textarea id="recommend" rows="3" name="recommend" class="form-control"></textarea>
                  </div>

                  <div class="modal-footer p-0">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                    <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Закрыть</button>
                  </div>


                </form>
              </x-modal>
            </th>


          </tr>

          <tr class="">
            <th scope="col">
              <a data-filter="id|{{$check[0] == 'id' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter" href="#">ID</a>
            </th>
            <th scope="col">

              <a data-filter="lastname|{{$check[0] == 'lastname' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter" href="#">Фамилия</a>

            </th>
            <th scope="col">

              <a data-filter="pname|{{$check[0] == 'pname' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter" href="#">Имя</a>

            </th>
            <th scope="col">

              <a data-filter="surname|{{$check[0] == 'surname' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter" href="#">Отчество</a>

            </th>
            <th scope="col">

              <a data-filter="birthday|{{$check[0] == 'birthday' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter" href="#">Дата рождения</a>

            </th>
            <th scope="col">
              <a class="btn-white w-100 btn">Участок</a>
            </th>
            <th scope="col">
              <a class="btn-white w-100 btn">Роддом</a>
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
            <th scope="col">
              <button class="btn-white w-100 btn">Рекомендации</button>
            </th>
          </tr>
          <tr>
            <th></th>
            <th colspan="3">
              <form action="{{Route('PacientsPage')}}" id="search" method="get">

                <div class="btn-group w-100">
                  <input type="search" placeholder="Поиск" class="form-control form-control-sm" name="search" value="{{isset($_GET['search']) ? $_GET['search']:''}}">
                  <input type="hidden" name="sort_field" value="{{isset($_GET['sort_field']) ? $_GET['sort_field']:''}}">
                  <input type="hidden" name="date_add" value="{{isset($_GET['date_add']) ? $_GET['date_add']:''}}">
                  <input type="hidden" name="birthday" value="{{isset($_GET['birthday']) ? $_GET['birthday']:''}}">
                  <input type="hidden" name="uchastok_id" value="{{isset($_GET['uchastok_id']) ? $_GET['uchastok_id']:''}}">
                  <button type="submit" class="btn btn-sm btn-success">Найти</button>
                </div>
              </form>
            </th>
            <th>
            <input type="text" class="form-control form-control-sm daterange" data-field="birthday" placeholder="Дата рождения" value="{{isset($_GET['birthday']) ? $_GET['birthday']:''}}" />
            </th>
            <th>
            <select class="form-select form-select-sm selectform" data-field="uchastok_id">
              <option value="">Выберите участок</option>
                      @foreach($uchastoks as $uchastok)
                      <option value="{{$uchastok->id}}" {{isset($_GET['uchastok_id']) ? ($_GET['uchastok_id'] == $uchastok->id?'selected':''):''}}>{{$uchastok->pname}}</option>
                      @endforeach
                    </select>
            </th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th><input type="text" class="form-control form-control-sm daterange" data-field="date_add" placeholder="Период" value="{{isset($_GET['date_add']) ? $_GET['date_add']:''}}" /></th>
            <th></th>
          </tr>
        </thead>
        <tbody class="align-middle">
          @foreach($pacients1 as $pacient)
          <tr class="position-relative">
            <th>
              <a href="{{Route('OnePacientPage', $pacient->id)}}" class="stretched-link text-decoration-none text-dark">{{$pacient->id}}</a></td>
            <td>{{$pacient->lastname}}</td>
            <td>{{$pacient->pname}}</td>
            <td>{{$pacient->surname}}</td>
            <td>{{$pacient->birthday->format('d.m.Y')}}</td>
            <td>{{$pacient->uchastok->pname}}</td>
            <td>{{$pacient->roddom->pname}}</td>
            <td>{{$pacient->rost}}</td>
            <td>{{$pacient->ves}}</td>
            <td>{{$pacient->pol}}</td>
            <td>{{$pacient->gestaci}}</td>
            <td>{{$pacient->date_add->format('d.m.Y')}}</td>
            <td>{{$pacient->recommend}}</td>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
  {{$pacients1->withQueryString()->links()}}

</div>

@endsection
