@extends('app')

@section('content')

<h3>Поиск по проектам</h3>

<form id="js-filter" action="/filter" method="post" enctype="multipart/form-data">
<div class="panel panel-default">
    <div class="panel-body">
            <div class="row">
                <div class="col-lg-6"><h4>Поиск по референциям</h4>
                    <input name="references" type="text" class="form-control" placeholder="Введите слово...">
                </div>
                <div class="col-lg-6">
                    <h4>Выберите год</h4>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <input class="form-control" type="text" placeholder="2015" id="from" name="from" value="2007">
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <input class="form-control" type="text" placeholder="2016" id="to" name="to" value="2020">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">

                @include('include.dictionary', ['name' => 'services[]', 'title' => 'Выберите услугу', 'items' => $services])

                @include('include.dictionary', ['name' => 'sectors[]', 'title' => 'Выберите отрасль', 'items' => $sectors])

                @include('include.dictionary', ['name' => 'country[]', 'title' => 'География', 'items' => $country])

            </div>
            <div class="row">
                <div class="col-lg-12 pbtn">
                    <!--disabled="disabled"-->
                    <button type="submit" class="rbtn btn btn-primary ladda-button"
                            data-style="zoom-out" id="filter"><span class="ladda-label">Фильтровать</span>
                    </button>
                </div>
            </div>
    </div>
</div>
</form>

<div id="searchResult" class="hidden">
</div>

<div id="menu-bar" class="col-lg-4">
    <div class="handle">
        <span class="fa fa-chevron-left fa-lg"></span>
    </div>
    <div class="bs-component">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Референции</h3>
            </div>
            <div class="panel-body" id="js-reference-panel">
                @if($userReferences)
                    @foreach($userReferences as $name)
                        <div class="references-text">{{ $name }}</div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection