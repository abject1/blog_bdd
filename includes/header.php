<header>
    <h1><a href="./index.php">Inifni Blog</a></h1>
    <div class="underline"></div>
    <div class="log">
        <?php if ($_SERVER['REQUEST_URI'] !== '/blog_bdd/login.php') { ?>
            <a href="./login.php">Login <i class="fa-solid fa-user"></i></a>
        <?php } else { ?>
            <a href="">Logout <i class="fa-solid fa-user"></i></a>
        <?php } ?>
    </div>
</header>