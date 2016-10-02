<div class="col-lg-4 {{ (isset($className)) ? $className : '' }}">
<h4>Теги <a href="/dictionarys#tags" class="btn btn-xs btn-link pull-right"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a></h4>
<div class="panel panel-default" id="tag-panel">
    <div class="panel-body">
        <div class="row">
            <div id="tags-button" class="col-lg-12">
                @foreach ($tags as $tag)
                    <button class="tag btn btn-xs {{ (!$tag->active) ? 'btn-default' : 'btn-primary' }}"
                            data-tag="{{ $tag->name }}">{{ $tag->name }}</button>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>