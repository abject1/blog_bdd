<?php

include './functionsSQL.php';

/* les erreurs */
/*const ERREUR_REQUIRED = 'Veuillez remplire le champ';
const ERREUR_MDP_SHORT = 'Le mot de passe est trop court (8 caractère minimum)';
const ERREUR_MDP_SPECIAL_CHARACTERE = 'Le mot de passe doit contenir au minimum une majuscule, une minuscule, un nombre et un caractère spécial';
const ERREUR_MAIL = "L'email est invalide";
const ERREUR_CONFIRM_MDP = "Le mot de passe et la confirmation de mot de passe ne correspondent pas";

$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';*/
$addDate = date('m.d.y');

/*$errors = [
    'name' => '',
    'prenom' => '',
    'mail' => '',
    'mdp' => ''
];*/

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // $_POST = filter_input_array(INPUT_POST, [
    //     'lastName' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    //     'name' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,
    //     'mail' => FILTER_SANITIZE_EMAIL,
    //     'password' => FILTER_SANITIZE_FULL_SPECIAL_CHARS,

    // ]);

    $name = $_POST['name'];
    $lastName = $_POST['lastName'];
    $mail = $_POST['mail'];
    $mdp = $_POST['password'];
    // $confirmPass = $_POST['confirmPass'];

    // if (!$nom) {
    //     $errors['name'] = ERREUR_REQUIRED;
    // }
    // if (!$prenom) {
    //     $errors['prenom'] = ERREUR_REQUIRED;
    // }
    // if (!$mail) {
    //     $errors['mail'] = ERREUR_REQUIRED;
    // }
    // if (!$mdp) {
    //     $errors['mdp'] = ERREUR_REQUIRED;
    // } else if (mb_strlen($mdp) < 8) {
    //     $errors['mdp'] = ERREUR_MDP_SHORT;
    // } else if (password_verify($mdp, $hash)) {
    //     $errors['mdp'] = ERREUR_MDP_SPECIAL_CHARACTERE;
    // } else if ($mdp !== $confirmPass) {
    //     $errors['mdp'] = ERREUR_CONFIRM_MDP;
    // }


    createUser($lastName, $name, $mail, $mdp, $addDate);

    // header('Location : ');
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
        <form action="./createAccount.php" method="POST">
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