{{-- */$ax = rand()/* --}}
<div class="col-lg-4">
    <h4>{{ $title }}{{--<a href="#" data-toggle="modal" data-target="#{{ quotemeta($name) }}" class="btn-xs btn-default pull-right">
            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
        </a>--}}<a href="/dictionarys#{{ rtrim($name, '[]') }}" class="btn btn-xs btn-link pull-right"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a>
    </h4>
    <select multiple class="form-control radius-up" name="{{ $name }}">
        @foreach ($items as $item)
            {{-- */$selected = '';/* --}}
            @if(isset($itemsProject))
                @foreach ($itemsProject as $itemProject)
                    @if($itemProject->name == $item->name)
                        {{-- */$selected = 'selected';/* --}}
                    @endif
                @endforeach
            @endif
            <option {{ $selected }} value="{{ $item->name }}">{{ $item->name }}</option>
        @endforeach
    </select>
    <div class="well well-sm radius-down">
		<a href="#" class="btn-xs pull-left padding-top-0 padding-0-5"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
		<div><em>Ничего не выбрано</em></div>
	</div>
</div>
{{--
<div class="modal fade" id="{{ $name }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <!-- Modal -->
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Редактирование справочника "<b>{{ $title }}</b>"</h4>
            </div>
            <div class="modal-body">
                <button type="button" class="btn btn-link btn-sm" aria-label="Add reference">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
                <i><a href="#">Добавить строку</a></i>
                <div class="scroll-table">
                    <table class="table table-condensed table-hover gray-table">
                        @foreach ($items as $item)
                        <tr>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-link btn-sm" aria-label="Edit reference">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-link btn-sm js-dictionary-remove">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                    </button>
                                </div>
                                {{ $item->name }}
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                <button type="button" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</div>--}}
