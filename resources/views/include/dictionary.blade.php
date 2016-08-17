<div class="col-lg-4">
    <h4>{{ $title }}</h4>
    <select multiple class="form-control multiple" name="{{ $name }}">
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
    <div class="well well-sm"><button disabled="disabled" type="button" class="btn btn-link btn-xs"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button><i>Ничего не выбрано</i></div>
</div>