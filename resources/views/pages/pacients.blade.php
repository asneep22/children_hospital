@extends('app.app')

@section('content')

<div class="container-fluid">
  <div class="d-flex flex-column m-auto justify-content-end">
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
                    <input type="text" name="date_add">
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

            <form action="{{Route('PacientsPage')}}" method="get" id="daterange">
              <th colspan="5">
                <input type="hidden" name="sort_field" value="">
                <input type="text" name="daterange" class="form-control" placeholder="Период" value="{{$_GET['daterange']??''}}" />
              </th>

              <th colspan="2">
                <div class="btn-group w-100">
                  <input type="search" placeholder="Поиск" class="form-control" name="search" value="{{isset($_GET['search']) ? $_GET['search']:''}}">
                  <button type="submit" class="btn btn-success">Найти</button>
                </div>
              </th>
              <th colspan="">
              </th>
            </form>
          </tr>

          <tr class="">
            <th scope="col">
              <button data-filter="id|{{$check[0] == 'id' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter btn-white w-100 btn">ID</button>
            </th>
            <th scope="col">

              <button data-filter="lastname|{{$check[0] == 'lastname' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter btn-white w-100 btn">Фамилия</button>

            </th>
            <th scope="col">

              <button data-filter="pname|{{$check[0] == 'pname' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter btn-white w-100 btn">Имя</button>

            </th>
            <th scope="col">

              <button data-filter="surname|{{$check[0] == 'surname' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter btn-white w-100 btn">Отчество</button>

            </th>
            <th scope="col">

              <button data-filter="birthday|{{$check[0] == 'birthday' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter btn-white w-100 btn">Дата рождения</button>

            </th>
            <th scope="col">
              <button class="btn-white w-100 btn">Участок</button>
            </th>
            <th scope="col">
              <button class="btn-white w-100 btn">Роддом</button>
            </th>
            <th scope="col">

              <button name="sort_field" data-filter="rost|{{$check[0] == 'rost' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter btn-white w-100 btn">Рост</button>

            </th>
            <th scope="col">

              <button  data-filter="ves|{{$check[0] == 'ves' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter btn-white w-100 btn">Вес</button>

            </th>
            <th scope="col">

              <button data-filter="gestaci|{{$check[0] == 'gestaci' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter btn-white w-100 btn">Неделя рождения</button>

            </th>
            <th scope="col">

              <button type="submit" data-filter="gestaci|{{$check[0] == 'gestaci' ? ($check[1] == 'desc' ? 'asc':'desc') : 'asc'}}" class="filter btn-white w-100 btn">Дата поступления</button>

            </th>
            <th scope="col">
              <button class="btn-white w-100 btn">Рекомендации</button>
            </th>
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
            <td>{{$pacient->gestaci}}</td>
            <td>{{$pacient->date_add->format('d.m.Y')}}</td>
            <td>{{$pacient->recommend}}</td>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{$pacients1->withQueryString()->links()}}
  </div>
</div>

@endsection