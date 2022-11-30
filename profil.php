<?php

require_once './isloggeding.php';

$currentUser = isLoggedin();

if (!$currentUser) {
    header('Location: /blog_bdd/login.php');
}

try {
    $conn = new PDO('mysql:host=localhost;dbname=blog', 'root', '', [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo $e->getMessage();
}

$sessionId = $_COOKIE['session'] ?? '';

$sessionStmt = $conn->prepare('SELECT * FROM session WHERE id=:id');
$sessionStmt->bindValue(':id', $sessionId);
$sessionStmt->execute();
$session = $sessionStmt->fetch();

if ($session) {
    $userStmt = $conn->prepare('SELECT * FROM users WHERE id=:id');
    $userStmt->bindValue(':id', $session['userid']);
    $userStmt->execute();
    $user  = $userStmt->fetch();
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php' ?>
    <title>Infini Blog</title>
</head>

<body>
    <?php include './includes/header.php' ?>
    <h1>Profil</h1>
    <h2>Hello <?= $user["prenom"] ?> <?= $user["nom"] ?></h2>
</body>

</html>