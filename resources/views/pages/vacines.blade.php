@extends('app.app')

@section('content')
<div class="container">
  <div class="d-flex flex-column m-auto w-50">

    <form class="w-100 d-flex mb-3 m-auto" action="{{Route('AddVacine')}}" method="post">
      @csrf
      <input type="text" id="vacine" name="vacine" class="form-control @error('vacine') bordered border-danger   @enderror" placeholder="Вакцина">
      <button type="submit" name="button" class="btn btn-success pl-1">Добавить</button>
    </form>

    <div class="table-responsive w-100 m-auto">
      <table class="table table-sm table-hover table-bordered">
        <thead class="align-middle">
          <tr class="">
            <th scope="col">id</th>
            <th scope="col">Вакцина</th>
            <th scope="col">Действия</th>
          </tr>
        </thead>
        <tbody class="align-middle p-0">
          @foreach($vacines as $vacine)
          <tr>
            <td colspan="" class="col-1">{{$vacine->id}}</td>
            <td colspan="" class="col-11">{{$vacine->pname}}</td>
            <td class="col-1">
              <div class="btn-group" role="group">
              <x-modal modalId="Upd{{$vacine->id}}" modalTitle="Обновить '{{$vacine->pname}}' " btnClass="btn-success py-1" btnText="🖉">
                <form action="{{Route('UpdateVacine', $vacine->id)}}" method="post">
                  @csrf
                  <label for="vacine">Вакцина: "{{$vacine->pname}}" </label>
                  <input type="text" class="form-control" id="vacine" name="vacine" value="">
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                  </div>
                </form>
              </x-modal>

              <x-modal modalId="deleteVac{{$vacine->id}}" modalTitle="Удалить" btnClass="btn-danger py-1" btnText="X">
                <p class="text-center">Вы действительно хотитие удалить запись вакцины: "<b>{{$vacine->pname}}</b>?"</p>
                <div class="modal-footer p-0 mt-2">
                  <a href="{{Route('DeleteVacine', $vacine->id)}}" class="btn btn-danger">Удалить</a>
                  <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Закрыть</button>
                </div>
              </x-modal>

              </div>

            </td>

          </tr>
          @endforeach
        </tbody>
      </table>
      {{$vacines->withQueryString()->links()}}
    </div>
  </div>
</div>

@endsection
