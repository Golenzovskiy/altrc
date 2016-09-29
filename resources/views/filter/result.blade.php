@if (count($projects) > 0)

@include('include.tags', ['tags' => $tags, 'className' => 'hidden tag-hidden-wrapper'])

<h3>Результаты поиска&nbsp;<span id="amount" class="badge"></span></h3>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="dropdown rbtn">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-menu"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Выводить по: {{ ($amountDisplayProjects) ? $amountDisplayProjects : 20 }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdown-menu">
                        <li data-amount="10"><a href="javascript:void(0)">10 результатов</a></li>
                        <li data-amount="20"><a href="javascript:void(0)">20 результатов</a></li>
                        <li data-amount="30"><a href="javascript:void(0)">30 результатов</a></li>
                        <li role="separator" class="divider"></li>
                        <li data-amount="50"><a href="javascript:void(0)">50 результатов</a></li>
                    </ul>
                </div>
            </div>
        </div>

    <div class="row" id="filterResult">
        @include('include.projects', ['project' => $projects])
    </div>

    <nav class="center">
        {{ $projects->links() }}
    </nav>
</div>
</div>

@else
    <div class="alert alert-dismissible alert-warning">
        <p>По вашему запросу ничего не найдено.</p>
    </div>
@endif