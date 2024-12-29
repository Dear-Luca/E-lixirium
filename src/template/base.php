<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <header>
        <h1>Blog di Tecnologie Web</h1>
    </header>
    <nav>
        <ul>
            <li><a <?php isActiveQuery("home");?> href="index.php?page=home">Home</a></li><li><a <?php isActiveQuery("archivio");?> href="index.php?page=archivio">Archivio</a></li><li><a <?php isActiveQuery("contatti");?> href="index.php?page=contatti">Contatti</a></li><li><a <?php isActiveQuery("login");?> href="index.php?page=login">Login</a></li>
        </ul>
    </nav>
    <main>
    <?php
    if(isset($templateParams["nome"])){
        require($templateParams["nome"]);
    }
    ?>
    </main><aside>
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
    </aside>
    <footer>
        <p>Tecnologie Web - A.A. 2024/2025</p>
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