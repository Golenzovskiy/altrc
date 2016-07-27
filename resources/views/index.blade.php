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
    <h3>Поиск по тегам</h3>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div id="tags-button" class="col-lg-12">
                    <a href="#" class="tag" data-tag="001"><span class="label label-default">Пищёвка</span></a>
                    <a href="#" class="tag" data-tag="002"><span class="label label-default">Стройка</span></a>
                    <a href="#" class="tag" data-tag="003"><span class="label label-default">Авто</span></a>
                </div>
            </div>
        </div>
    </div>
    <h3>Результаты поиска&nbsp;<span id="amount" class="badge"></span></h3>
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="dropdown rbtn">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            Выводить по: 20
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="#">10 результатов</a></li>
                            <li class="active"><a href="#">20 результатов</a></li>
                            <li><a href="#">30 результатов</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="#">50 результатов</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row" id="filterResult">

            </div>
            <!--div id="draggable" class="panel panel-default">
              <p>Drag me!</p>
            </div-->
            <nav class="center">
                <ul class="pagination">
                    <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a>
                    </li>
                    <li class="active"><a href="#">1 <span class="sr-only">(current)</span></a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>

@endsection