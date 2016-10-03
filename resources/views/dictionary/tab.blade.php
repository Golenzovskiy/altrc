<div class="tab-pane fade {{ ($id == 'services' ? 'active in' : '') }}" role="tabpanel" id="{{ $id }}"
     aria-labelledby="home-tab">
    <div class="table-responsive">
        <table class="table table-condense table-hover gray-table">
            <tr><td>
                    <div class="btn-group "></div>
                    <button type="button" class="btn btn-link btn-sm"
                            aria-label="Add reference">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </button>
                    <em><a class="js-dictionary-create" href="#">Добавить строку</a></em>
                </td>
            </tr>
            <tr class="hidden pattern">
                <td>
                    <div class="btn-group ">
                        <button type="button"
                                class="btn btn-link btn-sm js-{{ ($id == 'tags') ? 'tags' : 'dictionary' }}-edit"
                                aria-label="Edit dictionary">
                            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                        </button>
                        <button type="button"
                                class="btn btn-link btn-sm js-{{ ($id == 'tags') ? 'tags' : 'dictionary' }}-remove"
                                aria-label="Delete dictionary">
                            <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                        </button>
                    </div>
                    <span class="js-dictionary-change js-dictionary">
                        <span class="dictionary-text"></span>
                    </span>
                </td>
            </tr>
            @foreach($dictionary as $i => $items)
                {{--*/ $count = count($items->projects) /*--}}
                <tr>
                    <td>
                        <button style="min-width: 56px;" class="btn btn-default btn-sm"
                                type="button" data-toggle="collapse"
                                @if ($count > 0) data-target="#{{ $id }}_{{ $i }}" @endif aria-expanded="false"
                                aria-controls="{{ $id }}">
                            <span class="badge">{{ $count }}</span>
                        </button>
                        <div class="btn-group ">
                            <button type="button"
                                    class="btn btn-link btn-sm js-{{ ($id == 'tags') ? 'tags' : 'dictionary' }}-edit"
                                    aria-label="Edit dictionary">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </button>
                            <button type="button"
                                    class="btn btn-link btn-sm js-{{ ($id == 'tags') ? 'tags' : 'dictionary' }}-remove"
                                    aria-label="Delete dictionary">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </button>
                        </div>
                        <span class="js-dictionary-change js-dictionary">
                            <span class="dictionary-text">{{ $items->name }}</span>
                        </span>
                        <div class="collapse" id="{{ $id }}_{{ $i }}">
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