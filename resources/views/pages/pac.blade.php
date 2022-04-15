@extends('app.app')

@section('content')

<div class="container">
  <div class="d-flex flex-wrap">
    <div class="col-3 pr-5">
      <div class="d-flex justify-content-between w-0 mb-1">
        <x-modal modalId="addPacient" modalTitle="Редактировать" btnClass="btn-success btn-sm my-auto mt-0 ml-0" btnText="🖉">
          <form class="" action="{{Route('UpdatePacient', $pacient->id)}}" method="post">
            @csrf
            <div class="mb-3">
              <label for="lastname">Фамилия</label>
              <input type="text" id="lastname" name="lastname" class="form-control" value="{{$pacient->lastname}}">
            </div>
            <div class="mb-3">
              <label for="pname">Имя</label>
              <input type="text" id="pname" name="pname" class="form-control" value="{{$pacient->pname}}">
            </div>
            <div class="mb-3">
              <label for="surname">Отчество</label>
              <input type="text" id="surname" name="surname" class="form-control" value="{{$pacient->surname}}">
            </div>
            <div class="mb-3">
              <label for="birthday">Дата рождения</label>
              <input type="date" id="birthday" name="birthday" class="form-control" value="{{$pacient->birthday->format('Y-m-d')}}">
            </div>
            <div class="mb-3">
              <label for="uchastok_id">Участок</label>
              <select class="js-select" name="uchastok_id">
                @foreach($uchastoks as $uchastok)
                <option value="{{$uchastok->id}}" {{$uchastok->id == $pacient->uchastok_id ? 'selected':''}}>{{$uchastok->pname}}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="roddom_id">Роддом</label>
              <select class="js-select" name="roddom_id">
                @foreach($roddoms as $roddom)
                <option value="{{$roddom->id}}" {{$roddom->id == $pacient->roddom_id ? 'selected':''}}>{{$roddom->pname}}</option>
                @endforeach
              </select>
            </div>
            <div class="d-flex mb-3">
              <div class="w-50">
                <label for="rost">Рост</label>
                <input type="text" id="rost" name="rost" class="form-control" value="{{$pacient->rost}}">
              </div>
              <div class="mx-2 w-50">
                <label for="ves">Вес</label>
                <input type="text" id="ves" name="ves" class="form-control" value="{{$pacient->ves}}">
              </div>
              <div class="mx-2 w-50">
                <label for="gestaci">Неделя рождения</label>
                <input type="text" id="gestaci" name="gestaci" class="form-control" value="{{$pacient->gestaci}}">
              </div>
            </div>

            <div class="mb-3">
              <label for="recommend">Рекомендации</label>
              <textarea id="recommend" rows="3" name="recommend" class="form-control">{{$pacient->recommend}}</textarea>
            </div>

            <div class="modal-footer p-0">
              <button type="submit" class="btn btn-success">Сохранить</button>
              <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Закрыть</button>
            </div>


          </form>
        </x-modal>
        <h6 class="text-break text-center">{{$pacient->lastname.' '.$pacient->pname.' '.$pacient->surname}}</h6>
        <x-modal modalId="deletePacient" modalTitle="Удалить" btnClass="btn-danger btn-sm my-auto mt-0 ml-0" btnText="X">
          <p class="text-center">Вы действительно хотитие удалить запись пациента: "<b>{{$pacient->lastname}} {{$pacient->pname}} {{$pacient->surname}}</b>?"</p>
          <div class="modal-footer p-0 mt-2">
            <a href="{{Route('DeletePacient', $pacient->id)}}" class="btn btn-danger">Удалить</a>
            <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Закрыть</button>
          </div>
        </x-modal>
      </div>

      <form action="{{Route('saveAll', session()->get('pacient_id'))}}" method="post" class="row mb-3">
        @csrf
        <label for="bolezn">Болезни</label>
        <select class="js-select mb-3" name="bolezn[]" id="bolezn" multiple="multiple">
          @foreach($bolezni as $bolezn)
          <option value="{{$bolezn->pname}}" {{$bolezn->selected ? 'selected':''}}>{{$bolezn->pname}}</option>
          @endforeach
        </select>

        <label for="vacines">Вакцины</label>
        <select class="js-select" name="vacine[]" id="vacines" multiple="multiple">
          @foreach($vacines as $vacine)
          <option value="{{$vacine->pname}}" {{$vacine->selected ? 'selected':''}}>{{$vacine->pname}}</option>
          @endforeach
        </select>
        <hr class="mt-3">
        <div class="d-flex flex-column">
          <div class="form-check">
            <input type="hidden" name="skrinning" value="0">
            <input class="form-check-input" type="checkbox" name="skrinning" value="1" id="skrinning" {{$pacient->skrinning == 1 ? 'checked':''}}>
            <label class="form-check-label" for="skrinning">Скриннинг</label>
          </div>

          <div class="form-check">
            <input type="hidden" name="audio" value="0">
            <input class="form-check-input" type="checkbox" name="audio" value="1" id="audio" {{$pacient->audio == 1 ? 'checked':''}}>
            <label class="form-check-label" for="audio">Аудио</label>
          </div>

          <div class="form-check">
            <input type="hidden" name="vich" value="0">
            <input class="form-check-input" type="checkbox" name="vich" value="1" id="vich" {{$pacient->vich == 1 ? 'checked':''}}>
            <label class="form-check-label" for="vich">Вич</label>
          </div>

          <div class="form-check">
            <input type="hidden" name="gepatit" value="0">
            <input class="form-check-input" type="checkbox" name="gepatit" value="1" id="gepatit" {{$pacient->gepatit == 1 ? 'checked':''}}>
            <label class="form-check-label" for="gepatit">Гепатит</label>
          </div>

          <div class="form-check">
            <input type="hidden" name="recepient" value="0">
            <input class="form-check-input" type="checkbox" name="recepient" value="1" id="recepient" {{$pacient->recepient == 1 ? 'checked':''}}>
            <label class="form-check-label" for="recepient">Рецепиент крови</label>
          </div>

          <div class="form-check">
            <input type="hidden" name="gruppasvs" value="0">
            <input class="form-check-input" type="checkbox" name="gruppasvs" value="1" id="gruppasvs" {{$pacient->gruppasvs == 1 ? 'checked':''}}>
            <label class="form-check-label" for="svs">СВС</label>
          </div>
          <hr class="mt-2">

          <div class="form-check mb-3">
            <input type="hidden" name="pol" value="0">
            <input class="form-check-input" type="checkbox" name="pol" value="1" id="pol" {{$pacient->pol == 1 ? 'checked':''}}>
            <label class="form-check-label" for="pol">Пол(М)</label>
          </div>

        </div>
        <button type="submit" class="btn btn-success mt-1">Сохранить</button>
      </form>
    </div>

    <div class="col-9">

      <div class="d-flex">

        <div class="col-3">
          <x-modal modalId="addStacinoar" modalTitle="Добавить стационар" btnClass="btn-success w-100" btnText="Добавить стационар">
            <form class="" action="{{Route('addPacientToStacionar', $pacient->id)}}" method="post">
              @csrf
              <div class="mb-3">
                <label for="stacionar_id">Стационар</label>
                <select class="js-select" name="stacionar_id" id="stacionar_id">
                  @foreach($stacionars as $stacionar)
                  <option value="{{$stacionar->id}}">{{$stacionar->pname}}</option>
                  @endforeach
                </select>
              </div>

              <div class="mb-3">
                <label for="date_in">Дата поступления</label>
                <input type="date" id="date_in" name="date_in" class="form-control">
              </div>

              <div class="mb-3">
                <label for="date_ou">Дата выписки</label>
                <input type="date" id="date_ou" name="date_ou" class="form-control">
              </div>

              <div class="mb-3">
                <label for="dignoz">Диагноз</label>
                <input type="text" id="diagnoz" name="diagnoz" class="form-control">
              </div>

              <div class="form-check">
                <label for="form-check-label">Дома</label>
                <input type="hidden" name="inhome" value="0">
                <input type="checkbox" class="form-check-input" id="inhome" name="inhome" value="1">
              </div>
              <div class="modal-footer p-0">
                <button type="submit" name="pacients_id" class="btn btn-success">Сохранить</button>
                <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Закрыть</button>
              </div>
            </form>
          </x-modal>
        </div>

        <div class="col-7 px-2">
          <input type="text" name="" value="" class="form-control h-100" placeholder="Поиск по ключевому полю">
        </div>
        <div class="col-2">
          <button type="button" name="button" class="btn btn-success w-100 h-100">Поиск</button>
        </div>
      </div>

      <div class="table-responsive pt-3">
        <table class="table table-sm">
          <thead class="">
            <tr>
            </tr>
            <tr>
              <th scope="col">id</th>
              <th scope="col">Стационар</th>
              <th scope="col">Дата поступления</th>
              <th scope="col">Дата выписки</th>
              <th scope="col">Диагноз</th>
              <th scope="col">Дома</th>
              <th scope="col">Ред</th>
              <th scope="col">Удал</th>
            </tr>
          </thead>
          <tbody class="align-middle">
            @foreach($pacient->stacionars as $stacionari)
            <tr>
              <th scope="row">{{$stacionari->id}}</th>
              <td>{{$stacionari->stacionar->pname}}</td>
              <td>{{$stacionari->date_in->format('d.m.Y')}}</td>
              <td>{{$stacionari->date_ou->format('d.m.Y')}}</td>
              <td>{{$stacionari->diagnoz}}</td>
              <td>
                <input type="checkbox" class="form-check-input" {{$stacionari->inhome == 1 ? 'checked':''}} disabled>
              </td>

              <td class="text-start">
                <x-modal modalId="Upd{{$stacionari->id}}" modalTitle="Обновить" btnClass="btn-success py-1 px-2" btnText="🖉">
                  <form action="{{Route('updatePacientStacionar', $stacionari->id)}}" method="post">
                    @csrf
                    <div class="mb-3">
                      <label for="stacionar_id">Стационар</label>
                      <select class="js-select" name="stacionar_id" id="stacionar_id">
                        @foreach($stacionars as $stacionar)
                        <option value="{{$stacionar->id}}" {{$stacionar->id == $stacionari->stacionar_id ? 'selected':''}}>{{$stacionar->pname}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="date_in">Дата поступления</label>
                      <input type="date" id="date_in" name="date_in" class="form-control" value="{{$stacionari->date_in->format('Y-m-d')}}">
                    </div>
                    <div class="mb-3">
                      <label for="date_ou">Дата выписки</label>
                      <input type="date" id="date_ou" name="date_ou" class="form-control" value="{{$stacionari->date_ou->format('Y-m-d')}}">
                    </div>
                    <div class="mb-3">
                      <label for="dignoz">Диагноз</label>
                      <input type="text" id="diagnoz" name="diagnoz" class="form-control" value="{{$stacionari->diagnoz}}">
                    </div>
                    <div class="form-check">
                      <label for="form-check-label">Дома</label>
                      <input type="hidden" name="inhome" value="0">
                      <input type="checkbox" class="form-check-input" id="inhome" name="inhome" value="1" {{$stacionari->inhome == 1 ? 'checked':''}}>
                    </div>
                    <div class="modal-footer p-0">
                      <button type="submit" name="pacients_id" class="btn btn-success">Сохранить</button>
                      <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Закрыть</button>
                    </div>
                  </form>
                </x-modal>
              </td>
              <td>
                <x-modal modalId="deleteStac{{$stacionari->id}}" modalTitle="Удалить" btnClass="btn-danger py-1 px-2" btnText="X">
                  <p class="text-center">Вы действительно хотитие удалить запись стационара: "<b>{{$stacionari->stacionar->pname}}</b>?"</p>
                  <div class="modal-footer p-0 mt-2">
                    <a href="{{Route('deletePacientStacionar', $stacionari->id)}}" class="btn btn-danger">Удалить</a>
                    <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Закрыть</button>
                  </div>
                </x-modal>
              </td>
            </tr>
            @endforeach

          </tbody>
        </table></div>
      </div>

    </div>

  </div>

  @endsection
