@extends('app')

@section('content')

<h3>Поиск по проектам</h3>

<form id="js-filter" action="/filter" method="post" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="panel panel-default">
    <div class="panel-body">
        <form id="form">
            <div class="row">
                <div class="col-lg-6"><h4>Поиск по референциям</h4>
                    <input id="test" name="project" type="text" class="form-control" placeholder="Введите слово...">
                </div>
                <div class="col-lg-6">
                    <h4>Выберите год</h4>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <input class="form-control" type="text" placeholder="2015" id="from">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <input class="form-control" type="text" placeholder="2016" id="to">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                @include('include.dictionary', ['title' => 'Выберите услугу', 'items' => $services])

                @include('include.dictionary', ['title' => 'Выберите отрасль', 'items' => $sectors])

                @include('include.dictionary', ['title' => 'География', 'items' => $country])

            </div>
            <div class="row">
                <div class="col-lg-12 pbtn">
                    <button disabled="disabled" type="submit" class="rbtn btn btn-primary ladda-button"
                            data-style="zoom-out" id="filter"><span class="ladda-label">Фильтровать</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
</form>

<div id="searchResult" class="hidden">
</div>

@endsection