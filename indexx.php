<?php
require __DIR__. '/vendor/autoload.php';
require __DIR__. '/config/db.php';
require_once("src/admin.php");

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB, DB_PORT);
if ($conn->connect_error) {
    $error = $conn->connect_error . '(' . $conn->connect_errno . ')';
} else {
    $conn->set_charset('utf8');
}

Admin::setConnection($conn);

$router = new AltoRouter();
$router->setBasePath('BASE_PATH');
include('routing.php');

$match = $router->match();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>sklep</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">

        <?php
        if($match){
          require $match['target']; //klucz ktory zwraca, jest zawsze stały
        }

        ?>
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Sklep</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="#">Rejestracja</a></li>

            </ul>
            <form class="navbar-form navbar-left" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="email">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="hasło">
                </div>
                <button type="submit" class="btn btn-default">Zaloguj</button>
            </form>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
