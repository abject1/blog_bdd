<?php

require_once './isloggeding.php';

$currentUser = isLoggedin();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php' ?>
    <link rel="stylesheet" href="./dist/css/index.css">
    <title>Infini Blog</title>
</head>

<body>
    <?php include './includes/header.php' ?>
</body>

</html>