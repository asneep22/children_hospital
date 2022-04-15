@extends('app.app')

@section('content')
<div class="container">
  <div class="d-flex flex-column m-auto justify-content-end w-50">

    <form class="w-100 d-flex mb-3 m-auto" action="{{Route('AddBolezn')}}" method="post">
      @csrf
      <input type="text" id="bolezn" name="bolezn" class="form-control @error('bolezn') bordered border-danger   @enderror" placeholder="Болезнь">
      <button type="submit" name="button" class="btn btn-success pl-1">Добавить</button>
    </form>

    <div class="table-responsive w-100 m-auto">
      <table class="table table-bordered table-hover table-sm">
        <thead class="align-middle">
          <tr class="">
            <th scope="col">id</th>
            <th scope="col">Болезнь</th>
            <th scope="col">Действия</th>
          </tr>
        </thead>
        <tbody class="align-middle">
          @foreach($bolezni as $bolezn)
          <tr>
            <td colspan="" class="col-1">{{$bolezn->id}}</td>
            <td colspan="" class="col-10">{{$bolezn->pname}}</td>
            <td class="col-1">
              <div class="btn-group" role="group" aria-label="group{{$bolezn->id}}">
                <x-modal modalId="Upd{{$bolezn->id}}" modalTitle="Обновить '{{$bolezn->pname}}' " btnClass="btn-success py-1" btnText="🖉">
                  <form action="{{Route('UpdateBolezn', $bolezn->id)}}" method="post">
                    @csrf
                    <label for="bolezn">Болезнь: "{{$bolezn->pname}}" </label>
                    <input type="text" class="form-control" id="bolezn" name="bolezn" value="">
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Сохранить</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    </div>
                  </form>
                </x-modal>
                <x-modal modalId="deleteBol{{$bolezn->id}}" modalTitle="Удалить" btnClass="btn-danger py-1" btnText="X">
                  <p class="text-center">Вы действительно хотитие удалить запись болезни: "<b>{{$bolezn->pname}}</b>?"</p>
                  <div class="modal-footer p-0 mt-2">
                    <a href="{{Route('DeleteBolezn', $bolezn->id)}}" class="btn btn-danger">Удалить</a>
                    <button type="button" class="btn btn-secondary m-0" data-bs-dismiss="modal">Закрыть</button>
                  </div>
                </x-modal>
              </div>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
      {{$bolezni->withQueryString()->links()}}
    </div>
  </div>
</div>

@endsection
