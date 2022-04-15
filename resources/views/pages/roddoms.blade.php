@extends('app.app')

@section('content')
<div class="container">
  <div class="d-flex flex-column m-auto justify-content-end w-50">

      <form class="d-flex mb-3" action="{{Route('AddRoddom')}}" method="post">
        @csrf
          <input type="text" id="roddom" name="roddom" class="form-control @error('roddom') bordered border-danger @enderror" placeholder="Роддом">
          <button type="submit" name="button" class="btn btn-success pl-1">Добавить</button>
      </form>

    <div class="table-responsive w-100 m-auto">
      <table class="table table-bordered table-hover table-sm">
        <thead class="align-middle">
          <tr class="">
            <th scope="col-1">id</th>
            <th scope="col-10">Роддом</th>
            <th scope="col-1">Действия</th>
          </tr>
        </thead>
        <tbody class="align-middle">
          @foreach($roddoms as $roddom)
          <tr>
            <td colspan="" class="col-1">{{$roddom->id}}</td>
            <td colspan="" class="col-10">{{$roddom->pname}}</td>
            <td class="col-1">
              <div class="btn-group" role="group">
                <x-modal modalId="Upd{{$roddom->id}}" modalTitle="Обновить '{{$roddom->pname}}' " btnClass="btn-success py-1" btnText="🖉">
                  <form action="{{Route('UpdateRoddom', $roddom->id)}}" method="post">
                    @csrf
                    <label for="roddom">Роддом</label>
                    <input type="text" class="form-control" id="roddom" name="roddom" value="">
                    <div class="modal-footer">
                      <button type="submit" class="btn btn-success">Сохранить</button>
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    </div>
                  </form>
                </x-modal>

                <x-modal modalId="deleteStac" modalTitle="Удалить" btnClass="btn-danger py-1" btnText="X">
                  <p class="text-center">Вы действительно хотитие удалить запись роддома: "<b>{{$roddom->pname}}</b>?"</p>
                  <div class="modal-footer p-0 mt-2">
                    <a href="{{Route('DeleteRoddom', $roddom->id)}}" class="btn btn-danger">Удалить</a>
                    <button type="button" class="btn btn-secondary m-0 w-75" data-bs-dismiss="modal">Закрыть</button>
                  </div>
                </x-modal>
              </div>
            </td>

          </tr>
          @endforeach

        </tbody>
      </table>
      {{$roddoms->withQueryString()->links()}}
    </div>
  </div>
</div>

@endsection
