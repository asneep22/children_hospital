@extends('app.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="table-responsive">
      <table class="table table-sm table-hover table-bordered">
        <thead>
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
            <th colspan="3">
              <form action="{{Route('PacientsPage')}}" id="search" method="get">

                <div class="btn-group w-100">
                  <input type="search" placeholder="Поиск" class="form-control form-control-sm" name="search" value="{{isset($_GET['search']) ? $_GET['search']:''}}">
                  <input type="hidden" name="sort_field" value="{{isset($_GET['sort_field']) ? $_GET['sort_field']:''}}">
                  <input type="hidden" name="date_add" value="{{isset($_GET['date_add']) ? $_GET['date_add']:''}}">
                  <input type="hidden" name="birthday" value="{{isset($_GET['birthday']) ? $_GET['birthday']:''}}">
                  <input type="hidden" name="uchastok_id" value="{{isset($_GET['uchastok_id']) ? $_GET['uchastok_id']:''}}">
                  <input type="hidden" name="roddom_id" value="{{isset($_GET['roddom_id']) ? $_GET['roddom_id']:''}}">
                  <input type="hidden" name="pol" value="{{isset($_GET['pol']) ? $_GET['pol']:''}}">
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
            <th></th>
            <th><input type="text" class="form-control form-control-sm daterange" data-field="date_add" placeholder="Период" value="{{isset($_GET['date_add']) ? $_GET['date_add']:''}}" /></th>
          
          </tr>
        </thead>
        <tbody>
          @foreach($pacients1 as $pacient)
          <tr class="p-0 m-0" role="button" data-bs-toggle="collapse" data-bs-target="#accordion{{$pacient->id}}"  aria-expanded="false" class="clickable">
            <th>
              <a href="{{Route('OnePacientPage', $pacient->id)}}" class="forlink">{{$pacient->id}}</a></td>
            <td>{{$pacient->lastname}}</td>
            <td>{{$pacient->pname}}</td>
            <td>{{$pacient->surname}}</td>
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
          <tr class="p-0 m-0 collapse" data-id="{{$pacient->id}}" id="accordion{{$pacient->id}}">
        <td colspan="12" class="p-0 m-0">
        <div class="text-center"><div class="lds-heart"><div></div></div></div>
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