<?php
require_once('src/user.php');

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = [];
    if (isset($_POST['name']) && strlen(trim($_POST['name'])) > 1) {
        $name = trim($_POST['name']);
    } else {
        $error['name'] = true;
    }
    if (isset($_POST['email']) && strlen(trim($_POST['email'])) > 1) {
        $email = trim($_POST['email']);
    } else {
        $error['email'] = true;
    }
    if (isset($_POST['password1']) && strlen(trim($_POST['password1'])) > 1) {
        $password = trim($_POST['password1']);

    } else {
        $error['password1'] = true;
    }
    if (isset($_POST['password2']) && strlen(trim($_POST['password2'])) > 1) {
        $password2 = trim($_POST['password2']);
        if ($password != $password2) {
        } else {
            $error['password2'] = true;
        }
    }
    if (isset($_POST['surname']) && strlen($_POST['surname']) > 1) {
        $surname = trim($_POST['surname']);

    } else {
        $error['surname'] = true;
    }
    if (isset($_POST['address']) && strlen($_POST['address']) > 1) {
        $address = trim($_POST['address']);

    } else {
        $error['address'] = true;
    }
    user::setConnection($conn);
    $newUser = user::register($name, $surname, $email, $password, $password2, $address);
    if ($newUser != false) {
        $_SESSION['user'] = $newUser;
        header('location: ');
    }
    $r = 1;
}
?>

<?php
if (isset($error['name'])) {
    echo("Podales zle imie");
}
if (isset($error['email'])) {
    echo("Podales zlego maila");
}
if (isset($error['password1'])) {
    echo("Podales zle haslo");
}
if (isset($error['password2'])) {
    echo("Zly Repeat Hasla");
}
if (isset($error['surname'])) {
    echo("Zle Nazwisko");
}
if (isset($error['address'])) {
    echo("POdales zly adres");
}

?>
