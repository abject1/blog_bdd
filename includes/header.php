<header>
    <h1><a href="./index.php">Inifni Blog</a></h1>
    <div class="underline"></div>
    <div class="log">
        <?php if ($_SERVER['REQUEST_URI'] !== '/blog_bdd/login.php') { ?>
            <a href="./login.php">Login <i class="fa-solid fa-user"></i></a>
        <?php } else if ($_SERVER['REQUEST_URI'] === '/blog_bdd/login.php') {
        }  ?>
    </div>
    <div id="menuBurger">
        <span id="spanUn"></span>
        <span id="spanDeux"></span>
        <span id="spanNotSeen"></span>
    </div>
    <nav>
        <ul>
            <li class="<?php $_SERVER['REQUEST_URI'] === '/blog_bdd/index.php' ? 'active' : '' ?>"><a href="./index.php">Accueil</a></li>
            <li class="<?php $_SERVER['REQUEST_URI'] === '/blog_bdd/add-article.php' ? 'active' : '' ?>"><a href="./add-article.php">Ajouter un article</a></li>
            <li class="<?php $_SERVER['REQUEST_URI'] === '/blog_bdd/profil.php' ? 'active' : '' ?>"><a href="./profil.php">Mon profil</a></li>
        </ul>
    </nav>
</header>