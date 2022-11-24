<?php

include './functionsSQL.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['lastName'];
    $prenom = $_POST['name'];
    $mail = $_POST['mail'];
    $mdp = $_POST['password'];
    $addDate = date('d.m.y');
    $connexion = 0;

    $stmt = $conn->prepare("INSERT INTO users (nom, prenom, mail, mdp, addDate, connexion) VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param('ssssss', $nom, $prenom, $mail, $mdp, $addDate, $connexion);
    $stmt->execute();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php' ?>
    <link rel="stylesheet" href="./dist/css/createAccount.css">
    <title>Infini Blog | Login</title>
</head>

<body>
    <?php include './includes/header.php' ?>
    <div class="createAccount">
        <h4>Creation de compte</h4>
        <form action="./createAccount.php" method="post">
            <input type="hidden" name="id" value="<?php echo $user['id'];  ?>" />
            <input type="hidden" name="action" value="<?php echo $action;  ?>" />

            <div class="form-control">
                <label for="name">Prénom :</label>
                <input type="text" name="name" placeholder="Kévin" id="name">
            </div>

            <div class="form-control">
                <label for="lastName">Nom :</label>
                <input type="text" name="lastName" placeholder="Dujardin" id="lastName">
            </div>

            <div class="form-control">
                <label for="mail">Adresse mail :</label>
                <input type="text" name="mail" placeholder="exemple@exemple.com" id="mail">
            </div>

            <div class="form-control">
                <label for="password">Mot de pass :</label>
                <input type="password" name="password" placeholder="Mot de passe" id="password">
            </div>


            <label for="passwordConfirm">Confirmation de mot de pass :</label>
            <input type="password" name="passwordConfirm" placeholder="Confirmée votre mot de passe" id="confirmPass">

            <input type="submit" class="btn btn-submit">
        </form>
        <a href="./login.php">Connexion</a>
    </div>
</body>

</html>