@if (count($projects) > 0)
<div class="table-responsive pbtn">
    <table class="table table-default">
        <tr>
            <th>Логотип</th>
            <th>Название проекта</th>
            <th>Варианты формулировок</th>
        </tr>

        @foreach ($projects as $k => $project)
            <tr data-tags='["001", "002"]'>
                <td>
                 @if ($project->logo)
                    <img border="0"
                         src="{{ $project->logo }}">
                 @endif
                </td>
                <td>{{ $project->description }}</td>
                <td><a class="dashed" data-toggle="collapse" href="#collapse{{$k}}"
                       aria-expanded="false" aria-controls="collapse">{{ $project->references[0]->name }}</a></td>
            </tr>
            <tr class="collapse" id="collapse{{$k}}">
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
        @endforeach

    </table>
</div>
@else
  <p>По вашему запросы ничего не найдено</p>
@endif