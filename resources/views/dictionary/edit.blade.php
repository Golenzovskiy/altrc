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
                                <li role="presentation" class="active"><a href="#services" id="home-tab" role="tab"
                                                                          data-toggle="tab" aria-controls="home"
                                                                          aria-expanded="true">Услуги</a></li>
                                <li role="presentation" class=""><a href="#sectors" role="tab" id="profile-tab"
                                                                    data-toggle="tab" aria-controls="profile"
                                                                    aria-expanded="false">Отрасли</a></li>
                                <li role="presentation" class=""><a href="#tags" role="tab" id="profile-tab"
                                                                    data-toggle="tab" aria-controls="profile"
                                                                    aria-expanded="false">Теги</a></li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade active in" role="tabpanel" id="services"
                                     aria-labelledby="home-tab">
                                    <div class="table-responsive">
                                        <table class="table table-condense table-hover gray-table">
                                            <tr><td>
                                                    <div class="btn-group "></div>
                                                <button type="button" class="btn btn-link btn-sm"
                                                        aria-label="Add reference">
                                                            <span class="glyphicon glyphicon-plus"
                                                                  aria-hidden="true"></span>
                                                </button>
                                                <em><a class="js-dictionary-create" href="#">Добавить строку</a></em>
                                                </td>
                                            </tr>
                                            <tr class="hidden pattern">
                                                <td>
                                                    <div class="btn-group ">
                                                        <button type="button"
                                                                class="btn btn-link btn-sm js-dictionary-edit"
                                                                aria-label="Edit dictionary">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-link btn-sm js-dictionary-remove"
                                                                aria-label="Delete dictionary">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                        </button>
                                                    </div>
                                                    <span class="js-dictionary-change js-dictionary">
                                                        <span class="dictionary-text"></span>
                                                    </span>
                                                </td>
                                            </tr>
                                            @foreach($services as $i => $items)
                                            <tr>
                                                <td>
                                                    <button style="min-width: 56px;" class="btn btn-default btn-sm"
                                                            type="button" data-toggle="collapse"
                                                            data-target="#service_{{ $i }}" aria-expanded="false"
                                                            aria-controls="service">
                                                        <span class="badge">{{ $items->project_count }}</span>
                                                    </button>
                                                    <div class="btn-group ">
                                                        <button type="button"
                                                                class="btn btn-link btn-sm js-dictionary-edit"
                                                                aria-label="Edit dictionary">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-link btn-sm js-dictionary-remove"
                                                                aria-label="Delete dictionary">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                        </button>
                                                    </div>
                                                    <span class="js-dictionary-change js-dictionary">
                                                        <span class="dictionary-text">{{ $items->name }}</span>
                                                    </span>
                                                    <div class="collapse" id="service_{{ $i }}">
                                                        <div class="panel panel-default">
                                                            <div class="panel-body">
                                                                <ul class="list-unstyled">
                                                                    @foreach($items->projects as $project)
                                                                        <li><a href="/edit/{{ $project->id }}">{{ $project->company }}</a></li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" role="tabpanel" id="sectors"
                                     aria-labelledby="dropdown1-tab">
                                    <div class="table-responsive">
                                        <table class="table table-condense table-hover gray-table">
                                            <tr><td>
                                                    <div class="btn-group "></div>
                                                    <button type="button" class="btn btn-link btn-sm"
                                                            aria-label="Add reference">
                                                            <span class="glyphicon glyphicon-plus"
                                                                  aria-hidden="true"></span>
                                                    </button>
                                                    <em><a class="js-dictionary-create" href="#">Добавить строку</a></em>
                                                </td>
                                            </tr>
                                            <tr class="hidden pattern">
                                                <td>
                                                    <div class="btn-group ">
                                                        <button type="button"
                                                                class="btn btn-link btn-sm js-dictionary-edit"
                                                                aria-label="Edit dictionary">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-link btn-sm js-dictionary-remove"
                                                                aria-label="Delete dictionary">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                        </button>
                                                    </div>
                                                    <span class="js-dictionary-change js-dictionary">
                                                        <span class="dictionary-text"></span>
                                                    </span>
                                                </td>
                                            </tr>
                                            @foreach($sectors as $i => $items)
                                                <tr>
                                                    <td>
                                                        <button style="min-width: 56px;" class="btn btn-default btn-sm"
                                                                type="button" data-toggle="collapse"
                                                                data-target="#sectors_{{ $i }}" aria-expanded="false"
                                                                aria-controls="sectors">
                                                            <span class="badge">{{ $items->project_count }}</span>
                                                        </button>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm js-dictionary-edit"
                                                                    aria-label="Edit dictionary">
                                                                            <span class="glyphicon glyphicon-edit"
                                                                                  aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm js-dictionary-remove"
                                                                    aria-label="Delete dictionary">
                                                                            <span class="glyphicon glyphicon-remove"
                                                                                  aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        <span class="js-dictionary-change js-dictionary">
                                                            <div class="dictionary-text">{{ $items->name }}</div>
                                                        </span>
                                                        <div class="collapse" id="sectors_{{ $i }}">
                                                            <div class="panel panel-default">
                                                                <div class="panel-body">
                                                                    <ul class="list-unstyled">
                                                                        @foreach($items->projects as $project)
                                                                            <li><a href="/edit/{{ $project->id }}">{{ $project->company }}</a></li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" role="tabpanel" id="tags"
                                     aria-labelledby="dropdown2-tab">
                                    <div class="table-responsive">
                                        <table class="table table-condense table-hover gray-table">
                                            <tr><td>
                                                    <div class="btn-group "></div>
                                                    <button type="button" class="btn btn-link btn-sm"
                                                            aria-label="Add reference">
                                                            <span class="glyphicon glyphicon-plus"
                                                                  aria-hidden="true"></span>
                                                    </button>
                                                    <em><a class="js-dictionary-create" href="#">Добавить строку</a></em>
                                                </td>
                                            </tr>
                                            <tr class="hidden pattern">
                                                <td>
                                                    <div class="btn-group ">
                                                        <button type="button"
                                                                class="btn btn-link btn-sm js-dictionary-edit"
                                                                aria-label="Edit dictionary">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                                        </button>
                                                        <button type="button"
                                                                class="btn btn-link btn-sm js-dictionary-remove"
                                                                aria-label="Delete dictionary">
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                                        </button>
                                                    </div>
                                                    <span class="js-dictionary-change js-dictionary">
                                                        <span class="dictionary-text"></span>
                                                    </span>
                                                </td>
                                            </tr>
                                            @foreach($allTags as $i => $items)
                                                <tr>
                                                    <td>
                                                        <button style="min-width: 56px;" class="btn btn-default btn-sm"
                                                                type="button" data-toggle="collapse"
                                                                data-target="#tags_{{ $i }}" aria-expanded="false"
                                                                aria-controls="tags">
                                                            <span class="badge">{{ $items->project_count }}</span>
                                                        </button>
                                                        <div class="btn-group">
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm js-dictionary-edit"
                                                                    aria-label="Edit dictionary">
                                                                            <span class="glyphicon glyphicon-edit"
                                                                                  aria-hidden="true"></span>
                                                            </button>
                                                            <button type="button"
                                                                    class="btn btn-link btn-sm js-dictionary-remove"
                                                                    aria-label="Delete dictionary">
                                                                            <span class="glyphicon glyphicon-remove"
                                                                                  aria-hidden="true"></span>
                                                            </button>
                                                        </div>
                                                        <span class="js-dictionary-change js-dictionary">
                                                            <div class="dictionary-text">{{ $items->name }}</div>
                                                        </span>
                                                        <div class="collapse" id="tags_{{ $i }}">
                                                            <div class="panel panel-default">
                                                                <div class="panel-body">
                                                                    <ul class="list-unstyled">
                                                                        @foreach($items->projects as $project)
                                                                            <li><a href="/edit/{{ $project->id }}">{{ $project->company }}</a></li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection