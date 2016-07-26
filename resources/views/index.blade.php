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
            <div class="row">
                <div class="table-responsive pbtn">
                    <table class="table table-default" id="filterResult">
                        <tr>
                            <th>Логотип</th>
                            <th>Название проекта</th>
                            <th>Варианты формулировок</th>
                        </tr>
                        <tr data-tags='["001", "002"]'>
                            <td><img border="0"
                                     src="http://altrc.ru/upload/resize_cache/iblock/51a/105_105_1/51a4670556ade39f7f5d85aafd740df1.png">
                            </td>
                            <td>Исследование рынка и рекомендации по наращиванию объемов продаж на
                                российском рынке компании "Volvo Penta"
                            </td>
                            <td><a class="dashed" data-toggle="collapse" href="#collapse1"
                                   aria-expanded="false" aria-controls="collapse">Исследование рынка и
                                    рекомендации по наращиванию
                                    объемов продаж на российском рынке компании "Volvo Penta"</a></td>
                        </tr>
                        <tr class="collapse" id="collapse1">
                            <td colspan="5">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="btn-toolbar padding-bottom-15">
                                            <div class="btn-group pull-right">
                                                <a href="#" class="btn btn-default btn-xs"><span
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Добавить описание"
                                                            class="glyphicon glyphicon glyphicon-pushpin"
                                                            aria-hidden="true"></span></a>
                                                <a href="#" class="btn btn-default btn-xs"><span
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Редактировать проект"
                                                            class="glyphicon glyphicon glyphicon-wrench"
                                                            aria-hidden="true"></span></a>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-default table-hover">
                                                <tr>
                                                    <th>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Edit reference">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Delete reference"
                                                                    disabled="disabled">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        Исследование рынка и рекомендации по наращиванию
                                                        объемов продаж на российском рынке компании "Volvo
                                                        Penta"
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Edit reference">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Delete reference">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        Оценка перспективности организации производства
                                                        рентгено-диагностических оборудования в России
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Edit reference">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Delete reference">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        Оценка потенциала развития на российском рынке в
                                                        отраслях-потребителях всех бизнес-направлений
                                                        компании
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Edit reference">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Delete reference">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        Оценка перспективности организации производства
                                                        рентгено-диагностических оборудования в России
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Edit reference">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Delete reference">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        Оценка потенциала развития на российском рынке в
                                                        отраслях-потребителях всех бизнес-направлений
                                                        компании
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <button type="button" class="btn btn-link btn-sm"
                                                                aria-label="Add reference">
                                                                    <span class="glyphicon glyphicon-plus"
                                                                          aria-hidden="true"></span>
                                                        </button>
                                                        <i><a href="#">Добавить референцию</a></i></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr data-tags='["002"]'>
                            <td><img border="0"
                                     src="http://altrc.ru/upload/resize_cache/iblock/7aa/105_105_1/7aae13b05110c4543a081bd25a084321.jpg">
                            </td>
                            <td>Оценка перспективности организации производства рентгено-диагностических
                                оборудования в России для Siemens
                            </td>
                            <td><a class="dashed" data-toggle="collapse" href="#collapse2"
                                   aria-expanded="false" aria-controls="collapse">Оценка перспективности
                                    организации производства
                                    рентгено-диагностических оборудования в России для Siemens</a>
                            </td>
                        </tr>
                        <tr class="collapse" id="collapse2">
                            <td colspan="5">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="btn-toolbar padding-bottom-15">
                                            <div class="btn-group pull-right">
                                                <a href="#" class="btn btn-default btn-xs"><span
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Добавить описание"
                                                            class="glyphicon glyphicon glyphicon-pushpin"
                                                            aria-hidden="true"></span></a>
                                                <a href="#" class="btn btn-default btn-xs"><span
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Редактировать проект"
                                                            class="glyphicon glyphicon glyphicon-wrench"
                                                            aria-hidden="true"></span></a>
                                            </div>
                                        </div>
                                        <div class="table-responsive table-hover">
                                            <table class="table table-default table-hover">
                                                <tr>
                                                    <th>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Edit reference">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Delete reference"
                                                                    disabled="disabled">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        Исследование рынка и рекомендации по наращиванию
                                                        объемов продаж на российском рынке компании "Volvo
                                                        Penta"
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Edit reference">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Delete reference">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        Оценка перспективности организации производства
                                                        рентгено-диагностических оборудования в России
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Edit reference">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Delete reference">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        Оценка потенциала развития на российском рынке в
                                                        отраслях-потребителях всех бизнес-направлений
                                                        компании
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Edit reference">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Delete reference">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        Оценка перспективности организации производства
                                                        рентгено-диагностических оборудования в России
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Edit reference">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Delete reference">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        Оценка потенциала развития на российском рынке в
                                                        отраслях-потребителях всех бизнес-направлений
                                                        компании
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <button type="button" class="btn btn-link btn-sm"
                                                                aria-label="Add reference">
                                                                    <span class="glyphicon glyphicon-plus"
                                                                          aria-hidden="true"></span>
                                                        </button>
                                                        <i><a href="#">Добавить референцию</a></i></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr data-tags='["003"]'>
                            <td><img class="preview_picture" border="0"
                                     src="http://altrc.ru/upload/resize_cache/iblock/b86/105_105_1/b86133d17738c6f961eaa132d82d4ee7.jpg">
                            </td>
                            <td>Оценка потенциала развития на российском рынке в
                                отраслях-потребителях всех бизнес-направлений компании Oerlikon Group
                            </td>
                            <td><a class="dashed" data-toggle="collapse" href="#collapse3"
                                   aria-expanded="false" aria-controls="collapse">Оценка потенциала развития
                                    на российском рынке в
                                    отраслях-потребителях всех бизнес-направлений компании Oerlikon Group</a>
                            </td>
                        </tr>
                        <tr class="collapse" id="collapse3">
                            <td colspan="5">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="btn-toolbar padding-bottom-15">
                                            <div class="btn-group pull-right">
                                                <a href="#" class="btn btn-default btn-xs"><span
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Добавить описание"
                                                            class="glyphicon glyphicon glyphicon-pushpin"
                                                            aria-hidden="true"></span></a>
                                                <a href="#" class="btn btn-default btn-xs"><span
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Редактировать проект"
                                                            class="glyphicon glyphicon glyphicon-wrench"
                                                            aria-hidden="true"></span></a>
                                            </div>
                                        </div>
                                        <div class="btn-toolbar">
                                            <div class="btn-group pull-right">
                                                <a href="#" class="btn btn-default btn-xs"><span
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Добавить описание"
                                                            class="glyphicon glyphicon glyphicon-pushpin"
                                                            aria-hidden="true"></span></a>
                                                <a href="#" class="btn btn-default btn-xs"><span
                                                            data-toggle="tooltip" data-placement="top"
                                                            title="Редактировать проект"
                                                            class="glyphicon glyphicon glyphicon-wrench"
                                                            aria-hidden="true"></span></a>
                                            </div>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-default table-hover">
                                                <tr>
                                                    <th>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Edit reference">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Delete reference"
                                                                    disabled="disabled">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        Исследование рынка и рекомендации по наращиванию
                                                        объемов продаж на российском рынке компании "Volvo
                                                        Penta"
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Edit reference">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Delete reference">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        Оценка перспективности организации производства
                                                        рентгено-диагностических оборудования в России
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Edit reference">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Delete reference">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        Оценка потенциала развития на российском рынке в
                                                        отраслях-потребителях всех бизнес-направлений
                                                        компании
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Edit reference">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Delete reference">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        Оценка перспективности организации производства
                                                        рентгено-диагностических оборудования в России
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Edit reference">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm"
                                                                    aria-label="Delete reference">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        Оценка потенциала развития на российском рынке в
                                                        отраслях-потребителях всех бизнес-направлений
                                                        компании
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <button type="button" class="btn btn-link btn-sm"
                                                                aria-label="Add reference">
                                                                    <span class="glyphicon glyphicon-plus"
                                                                          aria-hidden="true"></span>
                                                        </button>
                                                        <i><a href="#">Добавить референцию</a></i></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
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