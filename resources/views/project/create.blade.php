@extends('app')

@section('content')

<h3>Добавление нового проекта</h3>
<form action="/save" method="post" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <h4>Название проекта</h4>
                <input type="text" class="form-control" placeholder="Введите слово...">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4">
                        <h4>Логотип компании</h4>
                        <!--img border="0" src="http://altrc.ru/upload/resize_cache/iblock/51a/105_105_1/51a4670556ade39f7f5d85aafd740df1.png"-->
                        <input type="file" id="exampleInputFile">
                    </div>
                    <div style="z-index: 2" class="col-lg-8 col-md-8 col-sm-8">
                        <h4>Выберите год</h4>
                        <input class="form-control" type="text" placeholder="2015" id="from">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h4>Выберите услугу</h4>
                <select multiple class="form-control">
                    <option>Стратегический маркетинг</option>
                    <option>Стратегия и развитие бизнеса</option>
                    <option>Оргструктура и изменения</option>
                    <option>Бенчмаркинг и зарубежные рынки</option>
                </select>
            </div>
            <div class="col-lg-4">
                <h4>Выберите отрасль</h4>
                <select multiple class="form-control">
                    <option>FMCG и потребительские товары</option>
                    <option>Добыча, сырье и материалы</option>
                    <option>Ритейл, логистика и дистрибуция</option>
                    <option>Машиностроение и инжиниринг</option>
                    <option>Медицина и фармацевтика</option>
                    <option>Строительство и стройматериалы</option>
                    <option>Химия и энергетика</option>
                    <option>Государственные органы и компании</option>
                </select>
            </div>
            <div class="col-lg-4">
                <h4>География</h4>
                <select multiple class="form-control">
                    <option>Россия и СНГ</option>
                    <option>Китай</option>
                    <option>Индия</option>
                    <option>США</option>
                    <option>Индонезия</option>
                    <option>Бразилия</option>
                    <option>Пакистан</option>
                    <option>Нигерия</option>
                    <option>Бангладеш</option>
                </select>
            </div>
        </div>
        <div class="row top">
            <div class="col-lg-12">
                <input type="text" class="form-control" placeholder="Введите слово..." id="FieldTags"
                       name="tags" value="Пищёвка, Стройка">
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