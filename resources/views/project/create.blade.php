@extends('app')

@section('content')

    <h3>Добавление нового проекта</h3>
    <form action="/save" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger" role="alert">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <h4>Название проекта</h4>
                        <input name="name" type="text" class="form-control" placeholder="Введите слово...">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <h4>Логотип компании</h4>
                                <input name="logo" type="file" id="exampleInputFile">
                            </div>
                            <div style="z-index: 2" class="col-lg-8 col-md-8 col-sm-8">
                                <h4>Выберите год</h4>
                                <input name="year" class="form-control" type="text" placeholder="2015" id="from">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h4>Описание проекта</h4>
                                <textarea class="form-control" rows="3" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    @include('include.dictionary', ['name' => 'services[]', 'title' => 'Выберите услугу', 'items' => $services])

                    @include('include.dictionary', ['name' => 'sectors[]', 'title' => 'Выберите отрасль', 'items' => $sectors])

                    @include('include.dictionary', ['name' => 'country[]', 'title' => 'География', 'items' => $country])
                </div>
                <div class="row top">
                    <div class="col-lg-12">
                        <h4>Теги проекта</h4>
                        <input type="text" class="form-control" placeholder="Введите слово..." id="FieldTags"
                               name="tags[]" value="">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-default table-hover gray-table">
                        <tr>
                            <th>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-link btn-sm" aria-label="Edit reference">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-link btn-sm" aria-label="Delete reference"
                                            disabled="disabled">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </button>
                                </div>
                                Исследование рынка и рекомендации по наращиванию объемов продаж на российском рынке
                                компании "Volvo Penta"
                            </th>
                        </tr>
                        <tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-link btn-sm" aria-label="Edit reference">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-link btn-sm" aria-label="Delete reference">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </button>
                                </div>
                                Оценка перспективности организации производства рентгено-диагностических
                                оборудования в России
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-link btn-sm" aria-label="Edit reference">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-link btn-sm" aria-label="Delete reference">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </button>
                                </div>
                                Оценка потенциала развития на российском рынке в отраслях-потребителях всех
                                бизнес-направлений компании
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-link btn-sm" aria-label="Edit reference">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-link btn-sm" aria-label="Delete reference">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </button>
                                </div>
                                Оценка перспективности организации производства рентгено-диагностических
                                оборудования в России
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-link btn-sm" aria-label="Edit reference">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-link btn-sm" aria-label="Delete reference">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </button>
                                </div>
                                Оценка потенциала развития на российском рынке в отраслях-потребителях всех
                                бизнес-направлений компании
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-link btn-sm" aria-label="Add reference">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                                <i><a href="#">Добавить референцию</a></i></td>
                        </tr>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12 pbtn">
                        <button type="submit" class="rbtn btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>
    </form>
    </div>

@endsection