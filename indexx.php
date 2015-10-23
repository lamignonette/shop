<?php
require __DIR__. '/vendor/autoload.php';
require __DIR__. '/config/db.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB, DB_PORT);
if ($conn->connect_error) {
    $error = $conn->connect_error . '(' . $conn->connect_errno . ')';
} else {
    $conn->set_charset('utf8');
}




$router = new AltoRouter();
$router->setBasePath(BASE_PATH);
include('routing.php');
$match =$router->match();

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
<?php
include('body.php');
if($match){
    require $match['target'];
}
?>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script src="src/script.js"></script>
</body>
</html>
