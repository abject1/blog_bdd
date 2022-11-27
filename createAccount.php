<?php
$errors = '';
$errorName = '';
$errorLastname = '';
$errorEmail = '';
$errorPassword = '';
$errorPasswordConfirm = '';

$host = 'localhost';
$dbname = 'blog';
$user = "root";
$pass = "";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die('Error : (' . $conn->connect_errno . ') ' . $conn->connext_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['lastName'] ?? '';
    $prenom = $_POST['name'] ?? '';
    $mail = $_POST['mail'] ?? '';
    $mdp = $_POST['password'] ?? '';
    $mdpConfirm = $_POST['passwordConfirm'] ?? '';
    date_default_timezone_set('UTC');
    $addDate = date('d.m.y');
    $connexion = 0;

    $stmt = $conn->prepare("INSERT INTO users (nom, prenom, mail, mdp, addDate, connexion) VALUES (?, ?, ?, ?, ?, ?)");

    $stmt->bind_param('ssssss', $nom, $prenom, $mail, $mdp, $addDate, $connexion);

    if (!$nom && !$prenom && !$mail && !$mdp && !$mdpConfirm) {
        $errors = 'TOUS LES CHAMPS SON VIDE !';
    } else {
        if (!$prenom) {
            $errorName = 'AJOUTER UN PRENOM';
        } else if (strlen($prenom) < 2) {
            $errorName = 'VOTRE PRENOM DOIT COMPTENIR AU MINIMUM DEUX CARACTERE';
        } else if (strlen($prenom) > 128) {
            $errorName = 'VOTRE PRENOM DOIT COMPTENIR MAXIMUM 128 CARACTERE';
        }

        if (!$nom) {
            $errorLastname = 'AJOUTER UN NOM';
        } else if (strlen($nom) < 2) {
            $errorLastname = 'VOTRE NOM DOIT COMPTENIR AU MINIMUM DEUX CARACTERE';
        } else if (strlen($nom) > 128) {
            $errorLastname = 'VOTRE NOM DOIT COMPTENIR MAXIMUM 128 CARACTERE';
        }

        if (!$mail) {
            $errorEmail = 'AJOUTER UN EMAIL';
        } else if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $errorEmail = '';
        } else {
            $errorEmail = "L'ADRESSE EMAIL EST INVALIDE";
        }

        if (!$mdp) {
            $errorPassword = "AJOUTER UN MOT DE PASS";
        } else if ($mdp !== $mdpConfirm) {
            $errorPasswordConfirm = "LE MOT DE PASS N'EST PAS LE MEME QUE LE MOT DE PASS DE CONFIRMATION";
        } else {
            $stmt->execute();
            header('Location: /blog_bdd/index.php');
        }

        if (!$mdpConfirm) {
            $errorPasswordConfirm = "LE MOT DE PASS DE CONFIRMATION EST MANQUANT";
        }
    }
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
                <p style="color: red; text-align: center;"><?= $errorName ?></p>
            </div>

            <div class="form-control">
                <label for="lastName">Nom :</label>
                <input type="text" name="lastName" placeholder="Dujardin" id="lastName">
                <p style="color: red; text-align: center;"><?= $errorLastname ?></p>
            </div>

            <div class="form-control">
                <label for="mail">Adresse mail :</label>
                <input type="text" name="mail" placeholder="exemple@exemple.com" id="mail">
                <p style="color: red; text-align: center;"><?= $errorEmail ?></p>
            </div>

            <div class="form-control">
                <label for="password">Mot de pass :</label>
                <input type="password" name="password" placeholder="Mot de passe" id="password">
                <p style="color: red; text-align: center; max-width: 70vw;"><?= $errorPassword ?></p>
            </div>

            <div class="form-control">
                <label for="passwordConfirm">Confirmation de mot de pass :</label>
                <input type="password" name="passwordConfirm" placeholder="Confirmée votre mot de passe" id="confirmPass">
                <p style="color: red; text-align: center; max-width: 70vw;"><?= $errorPasswordConfirm ?></p>
            </div>

            <p style="color: red; text-align: center;"><?= $errors ?></p>

            <input type="submit" class="btn btn-submit">
        </form>
        <a href="./login.php">Connexion</a>
    </div>
</body>

</html>