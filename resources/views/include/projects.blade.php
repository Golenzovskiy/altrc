<div class="table-responsive pbtn">
    <table class="table table-default">
        <tr>
            <th>Компания</th>
            <th>Логотип</th>
            <th>Название проекта</th>
            <th/>
        </tr>

        @foreach ($projects as $k => $project)
            {{-- */ $tags = '' /* --}}
            @foreach ($project->tags as $tag)
                {{-- */ $tags[] = $tag->name /* --}}
            @endforeach
            <tr data-tags='{{ json_encode($tags, JSON_UNESCAPED_UNICODE) }}'>
                <td>
                    {{ $project->company }}
                </td>
                <td>
                    @if ($project->logo)
                        <img class="max-max-width-100" border="0"
                             src="{{ $project->logo }}">
                    @endif
                </td>
                <td>
                    {{ $project->name }}
                    @if ($project->description)
                        ({{ $project->description }})
                    @endif
                </td>
                <td style="min-width: 200px">
                    <div style="float: right; margin-left: 5px" class="btn-group" role="group" aria-label="...">
                        <a class="btn btn-default btn-xs triangle-bottom" data-toggle="collapse" href="#collapse{{$k+1}}" role="button">
                            <span class="glyphicon glyphicon-triangle-bottom" aria-hidden="true"/>
                        </a>
                        <button type="button" class="favorite-refer btn btn-{{ ($userReferences && in_array($project->name, $userReferences)) ? 'primary' : 'default' }} btn-xs" aria-label="Left Align">
                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                        </button>
                    </div>
                    @if($project->review)
                        <button title="Есть отзыв" style="float: right; margin-left: 5px; cursor: default" type="button" class="btn btn-primary btn-xs">
                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                        </button>
                    @endif
                    <div class="hidden references-text">{{ $project->name }}</div>
                </td>
            </tr>
            <tr class="collapse" id="collapse{{$k+1}}">
                <td colspan="5">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="btn-toolbar padding-bottom-15">
                                <div class="btn-group pull-right padding-right-8">
                                    <a href="#" class="btn btn-default btn-xs"><span
                                                data-toggle="tooltip" data-placement="top"
                                                title="Добавить описание"
                                                class="glyphicon glyphicon glyphicon-pushpin"
                                                aria-hidden="true"></span></a>
                                    <a href="/edit/{{ $project->id }}" class="btn btn-default btn-xs"><span
                                                data-toggle="tooltip" data-placement="top"
                                                title="Редактировать проект"
                                                class="glyphicon glyphicon glyphicon-wrench"
                                                aria-hidden="true"></span></a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-default table-hover ">
                                    <tr class="hidden pattern">
                                        <td>
                                            <div class="pull-right">
                                                <div class="btn-group">
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
                                                    </div>
                                                    <button type="button" class="favorite-refer btn btn-default btn-xs" aria-label="Left Align">
                                                        <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                                    </button>
                                                </div>
                                            <div>
                                            <span data-description="{{ $project->description }}"
                                                  data-company="{{ $project->company }}"
                                                  class="js-references-change editable editable-click js-references"
                                                  data-emptytext="" data-id="{{ $project->id }}"><div
                                                        class="references-text"></div></span>
                                            </div>
                                        </td>
                                    </tr>
                                    @if ($project->references)
                                        @foreach ($project->references as $i => $reference)
                                            {{-- */$disabled = 'disabled="disabled"'/* --}}
                                            @if($i !== 0)
                                                {{-- */$disabled = ""/* --}}
                                            @endif
                                            <tr>
                                                <td>
                                                    <div class="pull-right">
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
                                                        <button type="button" class="favorite-refer btn btn-{{ ($userReferences && in_array($reference->name, $userReferences)) ? 'primary' : 'default' }} btn-xs" aria-label="Left Align">
                                                            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                                                        </button>
                                                    </div>
                                                    <div>
                                                        <span data-description="{{ $project->description }}"
                                                        data-company="{{ $project->company }}"
                                                        class="js-references-change js-references"
                                                        data-id="{{ $project->id }}"><div class="references-text">{{ $reference->name }}</div></span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach

    </table>
</div>