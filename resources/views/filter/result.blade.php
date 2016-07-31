@if (count($projects) > 0)

@include('include.tags', ['project' => $projects])

<h3>Результаты поиска&nbsp;<span id="amount" class="badge"></span></h3>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="dropdown rbtn">
                    <button class="btn btn-default dropdown-toggle" type="button" id="dropdown-menu"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        Выводить по: 20
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdown-menu">
                        <li><a href="#">10 результатов</a></li>
                        <li class="active"><a href="#">20 результатов</a></li>
                        <li><a href="#">30 результатов</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">50 результатов</a></li>
                    </ul>
                </div>
            </div>
        </div>

    <div class="row" id="filterResult">
        @include('include.projects', ['project' => $projects])
    </div>

    <!--div id="draggable" class="panel panel-default">
      <p>Drag me!</p>
    </div-->
    <nav class="center">
        {{ $projects->links() }}
    </nav>
</div>
</div>

@else
  <p>По вашему запросы ничего не найдено</p>
@endif