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
    $login = true;
    $createAccount = false;

    if ($login === true) {
    ?>
        <div class="login">
            <h4>Connexion</h4>
            <form action="./loginConnexion.php" method="POST">
                <label for="mail" id="mail">Adresse mail :
                    <input type="text" name="mail" placeholder="exemple@exemple.com"></label><br>
                <label for="password" id="password">Mot de passe :
                    <input type="password" name="password" placeholder="Mot de passe"></label>
                <input type="submit" class="btn btn-submit">
            </form>
            <a href="./createAccount.php">Crée un compte</a>
        </div>
    <?php } ?>
</body>

</html>