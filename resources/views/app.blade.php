<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="_token" content="{!! csrf_token() !!}"/>

    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Alt concept</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}"/>

    <link href="https://bootswatch.com/simplex/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/ladda-themeless.min.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <link href="/css/jquery.tagit.css" rel="stylesheet" type="text/css">
    <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <link href="/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<span id="test" data-a="5" data-b="4"></span>
<!--a href="#" id="form-submit2" class="btn btn-primary btn-lg ladda-button" data-style="expand-right" data-size="l"><span class="ladda-label">Submit form</span></a-->
<div class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#resonsive-menu">
                <span class="sr-only">Открыть меню</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--<a href="#" class="navbar-brand"><img height="25px" src="http://www.raexpert.ru/companies/ikf_alt_logo.gif"/></a>-->
            <a href="#" class="navbar-brand"><img class="img-responsive imgl"
                                                  src="http://altrc.ru/bitrix/tpl/img/alt-logo-color-rgb.png"/></a>
        </div>
        <div class="collapse navbar-collapse" id="resonsive-menu">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Найти референцию</a></li>
                <!--li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Пункт 2 <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Подпункт 1</a></li>
                        <li><a href="#">Подпункт 2</a></li>
                        <li><a href="#">Подпункт 3</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Подпункт 4</a></li>
                    </ul>
                </li-->
                <li><a href="/create">Добавить проект</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">

            @yield('content')

        </div>
    </div>
</div>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/datepicker-ru.js"></script>
<script src="/js/spin.min.js"></script>
<script src="/js/ladda.min.js"></script>
<script src="/js/tag-it.js" type="text/javascript" charset="utf-8"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script src="/js/app.js"></script>
</body>
</html>