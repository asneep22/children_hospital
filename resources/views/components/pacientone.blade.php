<div class="row">
    <div class="col-md-8">
        <div class="table-responsive">
            <h4 class="text-center">Болезни</h4>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Местонахождение</th>
                        <th>Периоды болезни</th>
                        <th>Диагнозы</th>
                        <th>Рекомендации</th>
                    </tr>

                </thead>
                <tbody>

                    @foreach($stacs=$pacient["stacionars"]->resolve() as $stac)

                    <tr>
                        <td>{{$stac["vid"]}}</td>
                        <td>{{$stac["date_in"]}} - {{$stac["date_ou"]}}</td>
                        <td>@foreach($stac["bolezns"]->resolve() as $b)
                            {{$b["bolezn"]}}<br>
                            @endforeach
                        </td>
                        <td>{{$stac["recommend"]}}</td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="table-responsive">

            <h4 class="text-center">Вакцинация</h4>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>Вакцины пациента</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pacient["vacine"]->resolve() as $vac)
                    <tr>
                        <td>{{$vac["vacine"]}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>