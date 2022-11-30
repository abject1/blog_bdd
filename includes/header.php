<?php
require_once './isloggeding.php';

$currentUser = isLoggedin();

?>

<header>
    <h1><a href="./index.php">Inifni Blog</a></h1>
    <div class="underline"></div>
    <div class="log">
        <?php if (!$currentUser) : ?>
            <a href="./login.php">Login <i class="fa-solid fa-user"></i></a>
        <?php endif; ?>
    </div>
    <div id="menuBurger">
        <span id="spanUn"></span>
        <span id="spanDeux"></span>
        <span id="spanNotSeen"></span>
    </div>
    <nav>
        <ul>
            <li>
                <a class="<?= $_SERVER['REQUEST_URI'] === '/blog_bdd/index.php' ? 'active' : '' ?>" href="./index.php">Accueil</a>
            </li>
            <li>
                <a class="<?= $_SERVER['REQUEST_URI'] === '/blog_bdd/add-article.php' ? 'active' : '' ?>" href="./add-article.php">Ajouter un article</a>
            </li>
            <li>
                <a class="<?= $_SERVER['REQUEST_URI'] === '/blog_bdd/profil.php' ? 'active' : '' ?>" href="./profil.php">Mon profil</a>
            </li>
        </ul>
    </nav>
</header>