<div class="row mt-3">
@php ($stacs = $pacient["stacionars"]->resolve())
@if (count($stacs))
    <div class="col-md-8">
        <div class="table-responsive">
            <h4 class="text-center">Болезни</h4>
            <table class="table table-sm">
                <thead>
                    <tr>
                        <th>Местонахождение</th>
                        <th>Периоды болезни</th>
                        <th>Диагнозы</th>
                        <th>Рекомендации</th>
                    </tr>

                </thead>
                <tbody>

                    @foreach($stacs as $stac)

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
@endif
    @php ($vacs = $pacient["vacine"]->resolve())
    @if (count($vacs))
    <div class="col-md-2">
        <div class="table-responsive">

            <h4 class="text-center">Вакцинация</h4>
            <table class="table table-sm ">
                <thead>
                    <tr>
                        <th>Вакцины пациента</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vacs as $vac)
                    <tr>
                        <td>{{$vac["vacine"]}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    <div class="col-md-2">
        <div class="responsove">
        <h4 class="text-center">Анализы</h4>
            <table class="table table-sm">
                <tr>
                    <th>Аудио</th>
                    <td>{{$pacient["audio"]?"Да":"Нет"}}</td>
                </tr>
                <tr>
                    <th>Рецепиент</th>
                    <td>{{$pacient["recepient"]?"Да":"Нет"}}</td>
                </tr>
                <tr>
                    <th>Гепатит</th>
                    <td>{{$pacient["gepatit"]?"Да":"Нет"}}</td>
                </tr>
                <tr>
                    <th>Группа СВС</th>
                    <td>{{$pacient["gruppasvs"]?"Да":"Нет"}}</td>
                </tr>
                <tr>
                    <th>Скриннинг</th>
                    <td>{{$pacient["skrinning"]=="roddom"?"В роддоме":($pacient["skrinning"]=="policlinic"?"В поликлинике":"")}}</td>
                </tr>
                <tr>
                    <th>ВИЧ</th>
                    <td>{{$pacient["vich"]?"Да":"Нет"}}</td>
                </tr>
            </table>
        </div>
    </div>
</div>