<?php

require_once './isloggeding.php';

$currentUser = isLoggedin();

if ($currentUser) {
    header('Location /blog_bdd/profil.php');
}

try {
    $conn = new PDO('mysql:host=localhost;dbname=blog', 'root', '', [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    echo $e->getMessage();
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = filter_input_array(INPUT_POST, [
        "mail" => FILTER_SANITIZE_EMAIL,
    ]);
    $password = $_POST['password'] ?? '';
    $mail = $input['mail'] ?? '';

    if (!$password || !$mail) {
        $error = 'ERROR';
    } else {
        $stmtUser = $conn->prepare('SELECT * FROM users WHERE mail=:mail');
        $stmtUser->bindValue(':mail', $mail);
        $stmtUser->execute();
        $user = $stmtUser->fetch();
        $passSave = $user['mdp'];

        if ($password === $passSave) {
            $sessionId = bin2hex(random_bytes(32));
            $stmtSession = $conn->prepare('INSERT INTO session VALUES (:sessionid, :userid)');
            $stmtSession->bindValue(':userid', $user['id']);
            $stmtSession->bindValue(':sessionid', $sessionId);
            $stmtSession->execute();
            $signature = hash_hmac('sha256', $sessionId, 'infinity ligne est la meilleur entreprise');
            setcookie('session', $sessionId, time() + 60 * 60 * 24 * 14, "", "", false, true);
            setcookie('signature', $signature, time() + 60 * 60 * 24 * 14, "", "", false, true);
            header('Location: /blog_bdd/profil.php');
        } else {
            $error = "MOT DE PASSE OU EMAIL FAUX";
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php' ?>
    <link rel="stylesheet" href="./dist/css/login.css">
    <title>Infini Blog | Login</title>
</head>

<body>
    <?php include './includes/header.php' ?>
    <?php
    ?>
    <div class="login">
        <h4>Connexion</h4>
        <form action="./login.php" method="POST">
            <div class="form-control">
                <label for="mail" id="mail">Adresse mail :</label>
                <input type="text" name="mail" placeholder="exemple@exemple.com">
            </div>
            <div class="form-control">
                <label for="password" id="password">Mot de passe :</label>
                <input type="password" name="password" placeholder="Mot de passe">
            </div>
            <?php if ($error) : ?>
                <h1 style="color: red; text-align: center; max-width: 70vw; font-size: 1.8rem; margin-top: 1.8rem;"><?= $error ?></h1>
            <?php endif; ?>
            <input type="submit" class="btn btn-submit">
        </form>
        <a href="./createAccount.php">Crée un compte</a>
    </div>
</body>

</html>