<?php

try {
    $conn = new PDO('mysql:host=localhost;dbname=blog', 'root', '', [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo $e->getMessage();
}

require_once './isloggeding.php';

$currentUser = isLoggedin();

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

$articleStmt = $conn->prepare('SELECT * FROM article');
$articleStmt->execute();
$article = $articleStmt->fetchAll();
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
    <div class="container-index">
        <section class="header-personnal">
            <?php if ($currentUser) : ?>
                <h6>Hello <a href="./profil.php"><?= $user['nom'] ?> <?= $user['prenom'] ?></a></h6>
            <?php else : ?>
                <h6>Hello tu est nouveau? crée ton profil juste <a style="color: red;" href="./login.php">ici</a></h6>
            <?php endif; ?>
        </section>
        <section class="articles">
            <?php foreach ($article as $a) : ?>
                <div class="article">
                    <h3><?= $a['title'] ?></h3>
                    <h4>Auteur : <?= $a['authorname'] ?></h4>
                    <h5>Category : <?= $a['category'] ?></h5>
                    <div class="underline"></div>
                    <p><?= $a['content'] ?></p>
                </div>
            <?php endforeach; ?>
        </section>
    </div>

</body>

</html>