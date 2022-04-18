  <button type="button" class="btn {{$btnClass}}" data-bs-toggle="modal" data-bs-target="#{{$modalId}}">
    {{$btnText}}
  </button>

  <div class="modal fade " id="{{$modalId}}" tabindex="-1" aria-labelledby="{{$modalId}}Lable" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="{{$modalTitle}}Lable">{{$modalTitle}}</h5>
          <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>
        <div class="modal-body">
          {{$slot}}
        </div>
      </div>
    </div>
  </div>
