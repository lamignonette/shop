<?php
include_once('src/user.php');

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && $_POST['login'] && strlen($_POST['login']) > 0) {

    $newUser = user::login($_POST['email'], $_POST['haslo']);
    if ($newUser != false) {
        $_SESSION['user'] = $newUser;
        header('location: indexx.php');
    }
}

