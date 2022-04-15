@extends('app.app')

@section('content')
<div class="container">
  <div class="d-flex flex-column m-auto w-50">

    <form class="w-100 d-flex mb-3 m-auto" action="{{Route('AddUchastok')}}" method="post">
      @csrf
      <input type="text" id="uchastok" name="uchastok" class="form-control @error('uchastok') bordered border-danger   @enderror" placeholder="Участок">
      <button type="submit" name="button" class="btn btn-success pl-1">Добавить</button>
    </form>

    <div class="table-responsive w-100 m-auto">
      <table class="table table-sm table-hover table-bordered">
        <thead class="align-middle">
          <tr class="">
            <th scope="col">id</th>
            <th scope="col">Участок</th>
            <th scope="col">Действия</th>
          </tr>
        </thead>
        <tbody class="align-middle">
          @foreach($uchastki as $uchastok)
          <tr>
            <td colspan="" class="col-1">{{$uchastok->id}}</td>
            <td colspan="" class="col-11">{{$uchastok->pname}}</td>
            <td>
              <div class="btn-group">
              <x-modal modalId="Upd{{$uchastok->id}}" modalTitle="Обновить '{{$uchastok->pname}}' " btnClass="btn-success py-1" btnText="🖉">
                <form action="{{Route('UpdateUchastok', $uchastok->id)}}" method="post">
                  @csrf
                  <label for="uchastok">Участок</label>
                  <input type="text" class="form-control" id="uchastok" name="uchastok" value="">
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                  </div>
                </form>
              </x-modal>

              <x-modal modalId="deleteUchast{{$uchastok->id}}" modalTitle="Удалить" btnClass="btn-danger py-1" btnText="X">
                <p class="text-center">Вы действительно хотитие удалить запись участка: "<b>{{$uchastok->pname}}</b>?"</p>
                <div class="modal-footer p-0 mt-2">
                  <a href="{{Route('DeleteUchastok', $uchastok->id)}}" class="btn btn-danger">Удалить</a>
                  <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Закрыть</button>
                </div>
              </x-modal>
            </td>


            </div>
          </tr>
          @endforeach

        </tbody>
      </table>
      {{$uchastki->withQueryString()->links()}}
    </div>
  </div>
</div>

@endsection
