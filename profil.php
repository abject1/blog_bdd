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
$userId = $session['userid'];

if ($session) {
    $userStmt = $conn->prepare('SELECT * FROM users WHERE id=:id');
    $userStmt->bindValue(':id', $userId);
    $userStmt->execute();
    $user = $userStmt->fetch();
}


$articleStmt = $conn->prepare('SELECT * FROM article WHERE authorid=:id');
$articleStmt->bindValue(':id', $userId);
$articleStmt->execute();
$article = $articleStmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php' ?>
    <link rel="stylesheet" href="./dist/css/profil.css">
    <title>Infini Blog</title>
</head>

<body>
    <?php include './includes/header.php' ?>
    <h2>Hello <?= $user["prenom"] ?> <?= $user["nom"] ?></h2>
    <section class="myArticle">
        <h4>Vos articles</h4>
        <?php foreach ($article as $a) : ?>
            <div class="article">
                <h3><?= $a['title'] ?></h3>
                <h4>Auteur : <?= $a['authorname'] ?></h4>
                <h5>Category : <?= $a['category'] ?></h5>
                <div class="underline"></div>
                <p><?= $a['content'] ?></p>
                <div class="commande">
                    <button class="btn btn-primary" id="btn">Modifier</button>
                    <a href="./delete-article.php?id=<?= $a['id'] ?>" type="submit" id="btn" class="btn btn-danger">Supprimer</a>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</body>

</html>