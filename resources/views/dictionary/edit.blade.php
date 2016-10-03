@extends('app')

@section('content')

    <h3>Редактирование справочников</h3>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-warning alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4>Внимание!</h4>
                            <p>Редактирование справочников приведет к <strong>изменению данных во всех</strong>
                                проектах. Изменения сохраняются без перезагрузки страницы</p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
                            <ul class="nav nav-tabs" id="myTabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#services" id="home-tab" role="tab" data-toggle="tab"
                                       aria-controls="home" aria-expanded="true">Услуги</a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#sectors" role="tab" id="profile-tab" data-toggle="tab"
                                       aria-controls="profile" aria-expanded="false">Отрасли</a>
                                </li>
                                <li role="presentation" class="">
                                    <a href="#tags" role="tab" id="profile-tab" data-toggle="tab"
                                       aria-controls="profile" aria-expanded="false">Теги</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">

                                @include('dictionary.tab', ['id' => 'services', 'dictionary' => $services])

                                @include('dictionary.tab', ['id' => 'sectors', 'dictionary' => $sectors])

                                @include('dictionary.tab', ['id' => 'tags', 'dictionary' => $allTags])

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection