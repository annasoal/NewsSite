<?php
session_start()
?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Главная страница</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootswatch/3.3.4/superhero/bootstrap.min.css">
    <link rel="stylesheet" href="http:////maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="container">
    <div class="bs-component">
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-2">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/index.php">NEWS</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="/index.php"> Главная страница <span class="sr-only">(current)</span></a>
                        </li>
                        <li><a href="?ctrl=admin&action=showaddOne">Добавить новость</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                               aria-expanded="false">Пользовательское меню <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="?ctrl=users&action=showRegistrationForm">Зарегистрироваться</a></li>
                                <li><a href="?ctrl=users&action=showAuthorizationForm"">Авторизоваться</a></li>
                                <li><a href="?ctrl=users&action=showProfile&id=<?php echo $_SESSION['id'] ?>">Просмотреть/изменить
                                        профиль</a></li>
                                <li class="divider"></li>
                                <li><a href="#">Separated link</a></li>
                                <li class="divider"></li>
                                <li><a href="#">One more separated link</a></li>
                            </ul>
                        </li>
                    </ul>
                    <form class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Поиск">
                        </div>
                        <button type="submit" class="btn btn-default">Искать</button>
                    </form>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">Link</a></li>
                    </ul>
                </div>
            </div>

        </nav>
    </div>


    <form class="form-horizontal" method="post" action="?ctrl=users&action=findUser" name="finduser">
        <fieldset>
            <legend>Форма авторизации</legend>

            <div class="form-group">
                <label for="inputEmail" class="col-lg-2 control-label">Логин</label>

                <div class="col-lg-10">
                    <input type="text" name="login" class="form-control" id="inputEmail" placeholder="Email">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-lg-2 control-label">Пароль</label>

                <div class="col-lg-10">
                    <input type="password" name="pass" class="form-control" id="inputPassword" placeholder="Пароль">

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember"> Запомнить меня
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button type="reset" class="btn btn-default">Очистить форму</button>
                    <button type="submit" name="authorize" class="btn btn-primary">Авторизоваться</button>
                </div>
    </form>

    <?php
    If (($_SESSION['authorizeerrors']) != '') {
        echo '<div class="jumbotron"> <h4>' .
            $_SESSION['authorizeerrors'] . '</h4></div>';
        unset ($_SESSION['authorizeerrors']);
    }
    If (($_SESSION ['authorizeok']) != '') {
        echo '<div class="jumbotron"> <h4>' .
            $_SESSION['authorizeok'] . '</h4></div>';
        unset ($_SESSION['authorizeok']);
    }
    ?>


</div>
</fieldset>
<footer>
    <div class="row">
        <div class="col-lg-12">
            <copyright>
                <ul class="list-unstyled">
                    <li class="pull-right"><a href="#top">Наверх</a></li>
                    <li><a href="#" onclick="pageTracker._link(this.href); return false;">Blog</a></li>
                    <li><a href="#">RSS</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">GitHub</a></li>
                    <li><a href="#">API</a></li>
                    <li><a href="#">Support</a></li>
                </ul>

                <p>Based on <a href="http://getbootstrap.com" rel="nofollow">Bootstrap</a>.
                    Icons from <a href="http://fortawesome.github.io/Font-Awesome/" rel="nofollow">Font Awesome</a>.
                    Web fonts from <a href="http://www.google.com/webfonts" rel="nofollow">Google</a>.</p>

        </div>
    </div>
</footer>
</div>


<!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
</body>
</html>