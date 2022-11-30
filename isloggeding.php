<?php

function isLoggedin()
{
    try {
        $conn = new PDO('mysql:host=localhost;dbname=blog', 'root', '', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    $sessionId = $_COOKIE['session'] ?? '';
    $signature = $_COOKIE['signature'] ?? '';
    if ($sessionId && $signature) {
        $hash = hash_hmac('sha256', $sessionId, 'infinity ligne est la meilleur entreprise');
        $match = hash_equals($signature, $hash);
        if ($match) {
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
        }
    }

    return $user ?? false;
}
