<?php

try {
    $conn = new PDO('mysql:host=localhost;dbname=blog', 'root', '', [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo $e->getMessage();
}

$sessionId = $_COOKIE['session'] ?? '';
if ($sessionId) {
    $statement = $conn->prepare('DELETE FROM session where id=?');
    $statement->execute([$sessionId]);
    setcookie('session', '', time() - 1);
}
header('Location: /blog_bdd/index.php');
