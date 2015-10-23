<?php

require_once('indexx.php');
require_once('admin.php');

session_start();


if(isset($_SESSION['user']['isAdmin'])!= 1) {
    header("Location: indexx.php");
}

$myAdmin = $_SESSION['user'];

if($_SERVER['REQUEST_METHOD']=='GET') {
    if (isset($_GET['admin_id'])) {
        $adminIdToShow = $_GET['admin_id'];
        $adminIdToShow = Admin::getAdminById($adminToShow);
    } else {
        $adminIdToShow = $myAdmin;
    }

    if ($adminIdToShow != false) {
        echo("Storna admina {$adminIdToShow->getEmail()} ");
    } else {

        echo("Nie ma takiego admina");
    }
}


echo ("Witaj {$myAdmin->getEmail()}");





