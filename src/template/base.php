<!DOCTYPE html>
<html lang="it">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["title"]; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>

<body>
    <header>
        <h1>E-lixirium</h1>
    </header>
    <script>
        // Change header color based on login status: black(not logged), green(user logged), red(admin logged)
        const userLogged = <?php echo isUserLoggedIn() ? "true" : "false"; ?>;
        const adminLogged = <?php echo isAdminLoggedIn() ? "true" : "false"; ?>;
        if (adminLogged) {
            document.querySelector("body header").classList.add("text-danger");
        } else if (userLogged) {
            document.querySelector("body header").classList.add("text-success");
        }
    </script>
    <nav>
        <ul class="list-group">
            <li class="list-group-item"><button class="menu-button" data-bs-toggle="collapse"
                    data-bs-target="#collapseMenu"><!-- Navbar --><img src="upload/menu-hamburger-nav.svg"
                        alt="Menu" /></button></li>
            <li class="list-group-item"><input type="text" placeholder="Search product" /><!-- Searchbar --></li>
            <li class="list-group-item"><a href="index.php?page=contatti"><!-- Cart --><img
                        src="upload/cart-shopping.svg" alt="Shopping Cart" /></a></li>
            <li class="list-group-item"><a href="index.php?page=login"><!-- Notifications --><img
                        src="upload/notification-13.svg" alt="Notifications" /></a></li>
            <li class="list-group-item"><a href="index.php?page=login"><!-- Account --><img
                        src="upload/account-avatar.svg" alt="Account" /></a></li>
            <li class="list-group-item"><a href="index.php?page=login"><!-- Login --></a></li>
        </ul>
    </nav>
    <section class="collapse" id="collapseMenu">
        <ul class="list-group">
            <li class="list-group-item"><a href="index.php?page=home">Home</a></li>
            <li class="list-group-item"><a href="index.php?page=products">Products</a></li>
            <li class="list-group-item"><a href="index.php?page=about">About Us</a></li>

            <li class="list-group-item"><a href="index.php?page=register">Register</a></li>
            <li class="list-group-item"><a href="index.php?page=login">Login</a></li>
            <li class="list-group-item"><a href="index.php?page=account">Account</a></li>
            <li class="list-group-item"><a href="index.php?page=cart">Shopping Cart</a></li>
            <li class="list-group-item"><a href="index.php?page=orders">Orders</a></li>
            <li class="list-group-item"><a href="index.php?page=logout">Logout</a></li>
        </ul>
    </section>
    <main>
        <?php
        if (isset($templateParams["nome"])) {
            require($templateParams["nome"]);
        }
        ?>
    </main>
    <!-- <aside>
        <section>
            <h2>Post Casuali</h2>
            <ul>
            <?php foreach ($templateParams["articolicasuali"] as $articolocasuale): ?>
                <li>
                    <img src="<?php echo UPLOAD_DIR . $articolocasuale["imgarticolo"]; ?>" alt="" />
                    <a href="articolo.php?id=<?php echo $articolocasuale["idarticolo"]; ?>"><?php echo $articolocasuale["titoloarticolo"]; ?></a>
                </li>
            <?php endforeach; ?>
            </ul>
        </section>
        <section>
            <h2>Categorie</h2>
            <ul>
            <?php foreach ($templateParams["categorie"] as $categoria): ?>
                <li><a href="articoli-categoria.php?id=<?php echo $categoria["idcategoria"]; ?>"><?php echo $categoria["nomecategoria"]; ?></a></li>
            <?php endforeach; ?>
            </ul>
        </section>
    </aside> -->
    <footer>
        <h2>Info</h2>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga architecto totam sint quia dolores similique!
            Possimus repellat voluptas vero ea? Ducimus explicabo maxime delectus fugit non! Saepe pariatur et quo.
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga architecto totam sint quia dolores similique!
            Possimus repellat voluptas vero ea? Ducimus explicabo maxime delectus fugit non! Saepe pariatur et quo.
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga architecto totam sint quia dolores similique!
            Possimus repellat voluptas vero ea? Ducimus explicabo maxime delectus fugit non! Saepe pariatur et quo.
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga architecto totam sint quia dolores similique!
            Possimus repellat voluptas vero ea? Ducimus explicabo maxime delectus fugit non! Saepe pariatur et quo.
            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga architecto totam sint quia dolores similique!
            Possimus repellat voluptas vero ea? Ducimus explicabo maxime delectus fugit non! Saepe pariatur et quo.
        </p>
    </footer>
    <?php
    if (isset($templateParams["js"])):
        foreach ($templateParams["js"] as $script):
            ?>
            <script src="<?php echo $script; ?>"></script>
            <?php
        endforeach;
    endif;
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>