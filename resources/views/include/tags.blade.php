<h3>Облако тегов</h3>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div id="tags-button" class="col-lg-12">
                @foreach ($projects as $project)
                    @foreach ($project->tags as $tag)
                        <a href="javascript:void(0)" class="tag" data-tag="{{ $tag->name }}"><span class="label label-default">{{ $tag->name }}</span></a>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>