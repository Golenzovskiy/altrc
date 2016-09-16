@extends('app')

@section('content')

    <h3>Поиск по проектам</h3>

    <form id="js-filter" action="/filter" method="post" enctype="multipart/form-data">
        <input type="hidden" name="filterTags" id="filter-tags" value="">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-4 col-md-6"><h4>Поиск по проектам</h4>
                        <input name="project" type="text" class="form-control" placeholder="Введите слово..." value="{{ (isset($filter['project'])) ? $filter['project'] : '' }}">
                    </div>
					<div class="col-lg-4 col-md-6"><h4>Поиск по референциям</h4>
                        <input name="references" type="text" class="form-control" placeholder="Введите слово..." value="{{ (isset($filter['references'])) ? $filter['references'] : '' }}">
                    </div>
                    <div class="col-lg-4">
                        <h4>Выберите год</h4>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <input class="form-control" type="text" placeholder="2015" id="from" name="from"
                                       value="{{ (isset($filter['from'])) ? $filter['from'] : '1990' }}">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <input class="form-control" type="text" placeholder="2016" id="to" name="to"
                                       value="{{ (isset($filter['to'])) ? $filter['to'] : '2020' }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">

                    @include('include.dictionary', ['name' => 'services[]', 'title' => 'Услуги', 'items' => $services, 'itemsProject' => (isset($filter['services'])) ? $filter['services'] : null ])

                    @include('include.dictionary', ['name' => 'sectors[]', 'title' => 'Отрасли', 'items' => $sectors, 'itemsProject' => (isset($filter['sectors'])) ? $filter['sectors'] : null ])

                    @include('include.dictionary', ['name' => 'country[]', 'title' => 'География', 'items' => $country, 'itemsProject' => (isset($filter['country'])) ? $filter['country'] : null ])

                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h4>Поиск по тегам</h4>
                        <input type="text" class="form-control" placeholder="Введите слово..." id="FieldTags"
                               name="tags" value="{{ ($filter && $filter['tags']) ? $filter['tags'] : '' }}">
                    </div>
                </div>
				<div class="row">
					<div class="col-lg-12 padding-top-15">
						<div id="request" class="hidden well well-sm"></div>
					</div>
					<div class="btn-group col-lg-12 padding-right-15">
					<div class="pull-right">
						<a href="/reset" class="reset hidden btn btn-default ladda-button">Сбросить</a>
						<button type="submit" class="btn btn-primary ladda-button {{ ($isFilterSet) ? 'js-auto-filter' : '' }}"
						data-style="zoom-out" id="filter"><span class="ladda-label">Фильтровать</span>
						</button>
					</div>
					</div>
				</div>
            </div>
        </div>
    </form>
    <div id="searchResult" class="hidden">
    </div>
    <div id="menu-bar" class="col-lg-4">
        <div class="bs-component">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <button class="btn btn-default btn-xs" id="copy" data-clipboard-action="copy">Копировать в буфер <span class="glyphicon glyphicon-copy" aria-hidden="true" /></button>
                    <button class="btn btn-primary btn-xs pull-right handleClose"><span class="glyphicon glyphicon-remove" aria-hidden="true" /></button>
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