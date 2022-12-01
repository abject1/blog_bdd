<?php

require_once './isloggeding.php';

$currentUser = isLoggedin();

if (!$currentUser) {
    header('Location /blog_bdd/login.php');
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

if ($session) {
    $userStmt = $conn->prepare('SELECT * FROM users WHERE id=:id');
    $userStmt->bindValue(':id', $session['userid']);
    $userStmt->execute();
    $user  = $userStmt->fetch();
}

$userId = $user['id'];
$userName = $user['prenom'];

const ERROR_REQUIRED = 'Veuillez remplir ce champ';
const ERROR_CATEGORY_NOT_SELECTED = 'Veuillez selectionner une categorie';
const ERROR_TITLE_TOO_SHORT = 'Le titre est trop cour';
const ERROR_CONTENT_TOO_SHORT = 'Le contenue est trop cour';

$errors = [
    'title' => '',
    'category' => '',
    'content' => '',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = filter_input_array(INPUT_POST, [
        'title' => FILTER_SANITIZE_SPECIAL_CHARS,
        'content' => FILTER_SANITIZE_SPECIAL_CHARS,
    ]);

    $title = $input['title'] ?? '';
    $category = $_POST['category'] ?? '';
    $content = $input['content'] ?? '';

    if (!$title) {
        $errors['title'] = ERROR_REQUIRED;
    } else if (mb_strlen($title) < 5) {
        $errors['title'] = ERROR_TITLE_TOO_SHORT;
    }

    if ($category == NULL) {
        $errors['category'] = ERROR_CATEGORY_NOT_SELECTED;
    }

    if (!$content) {
        $errors['content'] = ERROR_REQUIRED;
    } else if (mb_strlen($content) < 20) {
        $errors['title'] = ERROR_CONTENT_TOO_SHORT;
    }

    if (empty(array_filter($errors, fn ($e) => $e !== ''))) {
        $stmtArticle = $conn->prepare('INSERT INTO article (authorid, authorname, title, category, content) VALUES ( :authorid, :authorname, :title, :category, :content)');
        $stmtArticle->bindValue(':authorid', $userId);
        $stmtArticle->bindValue(':authorname', $userName);
        $stmtArticle->bindValue(':title', $title);
        $stmtArticle->bindValue(':category', $category);
        $stmtArticle->bindValue(':content', $content);
        $stmtArticle->execute();
        header('Location: /blog_bdd/index.php');
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <?php include './includes/head.php' ?>
    <link rel="stylesheet" href="./dist/css/add-article.css">
    <title>Infini Blog</title>
</head>

<body>
    <?php include './includes/header.php' ?>
    <div class="content">
        <h1>Ajout d'un article</h1>
        <form action="./add-article.php" method="POST">
            <div class="form-control">
                <label for="title">Titre</label>
                <input type="text" name="title" id="title" placeholder="Titre" value="<?= $title ?? '' ?>">
                <h3 style="color: red; text-align: center; font-size: 1.2rem;"><?= $errors['title'] ?></h3>
            </div>
            <div class="form-control">
                <label for="category">Categorie</label>
                <select name="category" id="category">
                    <option value="null"></option>
                    <option value="technology">Technologie</option>
                    <option value="politique">Politique</option>
                    <option value="nature">Nature</option>
                    <option value="sport">Sport</option>
                </select>
                <h3 style="color: red; text-align: center; font-size: 1.2rem;"><?= $errors['category'] ?></h3>
            </div>
            <div class="form-control">
                <label for="content">Contenue</label>
                <textarea name="content" id="content"><?= $content ?? '' ?></textarea>
                <h3 style="color: red; text-align: center; font-size: 1.2rem;"><?= $errors['content'] ?></h3>
            </div>
            <div class="actions">
                <a type="button" class="btn btn-danger" id="btn" href="./index.php">Annuler</a>
                <button class="btn btn-primary" id="btn">Sauvegarder</button>
            </div>
        </form>
    </div>
</body>

</html>