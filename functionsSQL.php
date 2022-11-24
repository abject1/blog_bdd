<?php

date_default_timezone_set('UTC');
$addDate = date("m.d.y");
$connexion = 0;

function connexion()
{
    $host = 'localhost';
    $dbname = 'blog';
    $user = "root";
    $pass = "";

    $conn = new mysqli($host, $user, $pass, $dbname);

    if ($conn->connect_error) {
        die('Error : (' . $conn->connect_errno . ') ' . $conn->connext_error);
    }
}
