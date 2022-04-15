@extends('app.app')

@section('content')
<div class="container">
  <div class="d-flex flex-column m-auto justify-content-end w-50">

    <form class="w-100 d-flex mb-3 m-auto" action="{{Route('AddStacionar')}}" method="post">
      @csrf
      <input type="text" id="stacionar" name="stacionar" class="form-control @error('stacionar') bordered border-danger   @enderror" placeholder="Стационар">
      <button type="submit" name="button" class="btn btn-success pl-1">Добавить</button>
    </form>

    <div class="table-responsive w-100 m-auto">
      <table class="table table-bordered table-hover table-sm">
        <thead class="align-middle">
          <tr class="">
            <th scope="col">id</th>
            <th scope="col">Стационар</th>
            <th scope="col">Действия</th>
          </tr>
        </thead>
        <tbody class=" align-middle">
          @foreach($stacionars as $stacionar)
          <tr>
            <td colspan="" class="col-1">{{$stacionar->id}}</td>
            <td colspan="" class="col-11">{{$stacionar->pname}}</td>
            <td class="col-1">
              <div class="btn-group" role="group">
              <x-modal modalId="Upd{{$stacionar->id}}" modalTitle="Обновить '{{$stacionar->pname}}' " btnClass="btn-success py-1" btnText="🖉">
                <form action="{{Route('UpdateStacionar', $stacionar->id)}}" method="post">
                  @csrf
                  <label for="stacionar">Стационар: "{{$stacionar->pname}}" </label>
                  <input type="text" class="form-control" id="stacionar" name="stacionar" value="">
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Сохранить</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                  </div>
                </form>
              </x-modal>
              <x-modal modalId="deleteStac{{$stacionar->id}}" modalTitle="Удалить" btnClass="btn-danger py-1" btnText="X">
                <p class="text-center">Вы действительно хотитие удалить запись стационара: "<b>{{$stacionar->pname}}</b>?"</p>
                <div class="modal-footer p-0 mt-2">
                  <a href="{{Route('DeleteStacionar', $stacionar->id)}}" class="btn btn-danger">Удалить</a>
                  <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Закрыть</button>
                </div>
              </x-modal>
              </div>
            </td>


          </tr>
          @endforeach

        </tbody>
        {{$stacionars->withQueryString()->links()}}
      </table>
    </div>
  </div>
</div>

@endsection
