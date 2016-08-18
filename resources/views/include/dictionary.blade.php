<div class="col-lg-4">
    <h4>{{ $title }}</h4>
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