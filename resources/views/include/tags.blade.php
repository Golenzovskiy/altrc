<div class="col-lg-4 {{ (isset($className)) ? $className : '' }}">
<h4>Теги <a href="/dictionarys#tags" class="btn btn-xs btn-link pull-right"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span></a></h4>
<div class="panel panel-default" id="tag-panel">
    <div class="panel-body">
        <div class="row">
            <div id="tags-button" class="col-lg-12">
                @foreach ($tags as $tag)
                    <a href="javascript:void(0)" class="tag" data-tag="{{ $tag->name }}"><span class="label {{ (!$tag->active) ? 'label-default' : 'label-primary' }}">{{ $tag->name }}</span></a>
                @endforeach
            </div>
        </div>
    </div>
</div>
</div>