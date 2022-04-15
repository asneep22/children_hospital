@if ($errors->any())
<div class="alert alert-danger m-auto mt-0 mb-5">
  <ul class="d-flex flex-column list-unstyled">

    @foreach ($errors->all() as $error)
      <li class="col p-0 m-0">{{ $error }}</li>
    @endforeach

  </ul>
</div>
@endif
