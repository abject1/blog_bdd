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


$_GET = filter_input_array(INPUT_GET, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$id = $_GET['id'] ?? '';

if ($id) {
    $articleStmt = $conn->prepare("DELETE FROM article WHERE id=:id");
    $articleStmt->bindValue(':id', $id);
    $articleStmt->execute();
    $article = $articleStmt->fetchAll();
    header('Location: /blog_bdd/');
}

?>

<a href="./index.php">Accueil</a>