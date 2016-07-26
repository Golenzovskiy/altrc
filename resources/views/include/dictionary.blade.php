<div class="col-lg-4">
    <h4>{{ $title }}</h4>
    <select multiple class="form-control">
        @foreach ($items as $item)
            <option value="{{ $item->name }}">{{ $item->name }}</option>
        @endforeach
    </select>
</div>