<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["title"]; ?></title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <header>
        <h1>E-lixirium</h1>
    </header>
    <nav>
        <ul>
            <li><button class="menu-button" onclick="toggleMenu()"><!-- Navbar --><img src="upload/menu-hamburger-nav.svg" alt="Menu" /></button></li>
            <li><input type="text" placeholder="Search product"/><!-- Searchbar --></li>
            <li><a href="index.php?page=contatti"><!-- Cart --><img src="upload/cart-shopping.svg" alt="Shopping Cart" /></a></li>
            <li><a href="index.php?page=login"><!-- Notifications --><img src="upload/notification-13.svg" alt="Notifications" /></a></li>
            <li><a href="index.php?page=login"><!-- Account --><img src="upload/account-avatar.svg" alt="Account" /></a></li>
            <li><a href="index.php?page=login"><!-- Login --></a></li>
        </ul>
        <script src="js/scripts.js"></script>
    </nav>
    <section>
        <ul>
            <li><a href="index.php?page=home">Home</a></li>
            <li><a href="index.php?page=products">Products</a></li>
            <li><a href="index.php?page=about">About Us</a></li>

            <li><a href="index.php?page=register">Register</a></li>
            <li><a href="index.php?page=login">Login</a></li>
            <li><a href="index.php?page=account">Account</a></li>
            <li><a href="index.php?page=cart">Shopping Cart</a></li>
            <li><a href="index.php?page=orders">Orders</a></li>
            <li><a href="index.php?page=logout">Logout</a></li>
        </ul>
    </section>
    <main>
    <?php
    if(isset($templateParams["nome"])){
        require($templateParams["nome"]);
    }
    ?>
    </main>
    <!-- <aside>
        <section>
            <h2>Post Casuali</h2>
            <ul>
            <?php foreach($templateParams["articolicasuali"] as $articolocasuale): ?>
                <li>
                    <img src="<?php echo UPLOAD_DIR.$articolocasuale["imgarticolo"]; ?>" alt="" />
                    <a href="articolo.php?id=<?php echo $articolocasuale["idarticolo"]; ?>"><?php echo $articolocasuale["titoloarticolo"]; ?></a>
                </li>
            <?php endforeach; ?>
            </ul>
        </section>
        <section>
            <h2>Categorie</h2>
            <ul>
            <?php foreach($templateParams["categorie"] as $categoria): ?>
                <li><a href="articoli-categoria.php?id=<?php echo $categoria["idcategoria"]; ?>"><?php echo $categoria["nomecategoria"]; ?></a></li>
            <?php endforeach; ?>
            </ul>
        </section>
    </aside> -->
    <footer>
        <h2>Info</h2>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga architecto totam sint quia dolores similique! Possimus repellat voluptas vero ea? Ducimus explicabo maxime delectus fugit non! Saepe pariatur et quo.
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga architecto totam sint quia dolores similique! Possimus repellat voluptas vero ea? Ducimus explicabo maxime delectus fugit non! Saepe pariatur et quo.
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga architecto totam sint quia dolores similique! Possimus repellat voluptas vero ea? Ducimus explicabo maxime delectus fugit non! Saepe pariatur et quo.
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga architecto totam sint quia dolores similique! Possimus repellat voluptas vero ea? Ducimus explicabo maxime delectus fugit non! Saepe pariatur et quo.
        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Fuga architecto totam sint quia dolores similique! Possimus repellat voluptas vero ea? Ducimus explicabo maxime delectus fugit non! Saepe pariatur et quo.
        </p>
    </footer>
    <?php
    if(isset($templateParams["js"])):
        foreach($templateParams["js"] as $script):
    ?>
        <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>

</body>
</html>