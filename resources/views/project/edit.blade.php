@extends('app')

@section('content')

    <h3>Редактирование проекта</h3>
    <form class="edit-mode" action="/edit/{{ $project->id }}" method="post" enctype="multipart/form-data">
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

                        <div class="row">
                            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                                <h4>Название компании</h4>
                                <input name="company" type="text" class="form-control"
                                       placeholder="Введите слово..." value="{{ $project->company }}">
                            </div>
                            <div class="col-lg-8 col-md-7 col-sm-6 col-xs-12">
                                <h4>Название проекта</h4>
                                <input name="name" type="text" class="form-control" placeholder="Введите слово..."
                                       value="{{ $project->name }}">
                            </div>
                            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                                <h4>Альтернативные названия компании</h4>
                                <input name="company" type="text" class="form-control"
                                       placeholder="Введите слово..." value="{{ $project->company }}">
                            </div>
                            <div style="z-index: 2" class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                                <h4>Выберите год</h4>
                                <input name="year" class="form-control" type="text" placeholder="2015" id="from"
                                       value="{{ date('Y', strtotime($project->year)) }}">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                <h4>Логотип компании</h4>
                                @if ($project->logo)
                                    <label for="logo" class="file-label">
                                        <img id="logo-image" border="0" src="{{ $project->logo }}">
                                        <input name="logo" type="file" class="hidden" id="logo">
                                    </label>
                                @else
                                    <img id="logo-image" border="0" src="" class="hidden">
                                    <input name="logo" type="file" id="logo">
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <h4>Описание компании</h4>
                        <textarea class="form-control description" rows="6"
                                  name="description">{{ $project->description }}</textarea>
                    </div>
                    @include('include.dictionary', ['name' => 'services[]', 'title' => 'Услуги',
                    'items' => $services, 'itemsProject' => $selectedServices])

                    @include('include.dictionary', ['name' => 'sectors[]', 'title' => 'Отрасли',
                    'items' => $sectors, 'itemsProject' => $selectedSectors])
                </div>
                <div class="row top">
                    <div class="col-lg-12">
                        <h4>Теги проекта</h4>
                        {{-- */$tags[] = ''/* --}}
                        @foreach($selectedTags as $value)
                            {{-- */$tags[] = $value->name/* --}}
                        @endforeach
                        <input type="text" class="form-control" placeholder="Введите слово..." id="FieldTags"
                               name="tags" value="{{ implode(',', $tags) }}">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-default table-hover gray-table">
                        <tr class="hidden pattern">
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-link btn-sm js-references-edit"
                                            aria-label="Edit reference">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-link btn-sm js-references-remove"
                                            aria-label="Delete reference">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </button>
                                </div>
                                <span class="js-references-change js-references" data-position=""
                                      data-emptytext="" data-id="{{ $project->id }}"><div
                                            class="references-text"></div></span>
                                <input type="hidden" data-position=""
                                       value="">
                            </td>
                        </tr>
                        @foreach ($project->references as $i => $reference)
                            {{-- */$disabled = 'disabled="disabled"'/* --}}
                            @if($i !== 0)
                                {{-- */$disabled = ""/* --}}
                            @endif
                            <tr>
                                <td>
                                    <div class="btn-group">
                                        <button type="button"
                                                class="btn btn-link btn-sm js-references-edit"
                                                aria-label="Edit reference">
                                                                        <span class="glyphicon glyphicon-edit"
                                                                              aria-hidden="true"></span>
                                        </button>
                                        <button type="button"
                                                class="btn btn-link btn-sm js-references-remove"
                                                aria-label="Delete reference"
                                                {{ $disabled }}>
                                                                        <span class="glyphicon glyphicon-remove"
                                                                              aria-hidden="true"></span>
                                        </button>
                                    </div>
                                    <span class="js-references-change js-references" data-position="{{ $i }}"
                                          data-id="{{ $project->id }}">
                                        <div class="references-text">{{ $reference->name }}</div></span>
                                    <input type="hidden" name="references[]" data-position="{{ $i }}"
                                           value="{{ $reference->name }}">
                                </td>
                            </tr>
                        @endforeach
                        <tr class="action">
                            <td>
                                <button type="button"
                                        data-id="{{ $project->id }}"
                                        class="btn btn-link btn-sm js-references-create"
                                        aria-label="Add reference">
                                                                    <span class="glyphicon glyphicon-plus"
                                                                          aria-hidden="true"></span>
                                </button>
                                <i><a href="javascript:void(0)" class="js-references-create"
                                      data-id="{{ $project->id }}">Добавить референцию</a></i></td>
                        </tr>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-12 pbtn">
                        <button id="delete" type="button" class="btn btn-default">Удалить проект</button>
                        <button type="submit" class="rbtn btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection