<?php
require __DIR__. '/vendor/autoload.php';
require __DIR__. '/config/db.php';

$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DB, DB_PORT);
if ($db->connect_error) {
    $error = $db->connect_error . '(' . $db->connect_errno . ')';
} else {
    $db->set_charset('utf8');
}