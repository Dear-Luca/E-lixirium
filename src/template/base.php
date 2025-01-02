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
    <nav class="navbar navbar-expand-md bg-body-tertiary">
        <div class="container-fluid">
            <!-- <a class="navbar-brand" href="#">E-lixirium</a> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=home">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Product1</a></li>
                            <li><a class="dropdown-item" href="#">Product2</a></li>
                            <li><a class="dropdown-item" href="#">Product3</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=about">About us</a>
                    </li>
                </ul>
            </div>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search products" aria-label="Search">
                <!-- <button class="btn btn-outline-success" type="submit">Search</button> -->
            </form>
            <span class="nav-link d-none d-md-flex">
                <?php if (isUserLoggedIn()): ?>
                    <a href="index.php?page=cart"><img src="upload/cart-speed.svg" alt="Shopping Cart" /></a>
                    <a href="index.php?page=orders"><img src="upload/box-check.svg" alt="Orders" /></a>
                    <a href="index.php?page=notifications"><img src="upload/notification-13.svg" alt="Notifications" /></a>
                    <a href="index.php?page=account"><img src="upload/user.svg" alt="Account" /></a>
                    <a href="index.php?page=logout"><img src="upload/sign-out.svg" alt="Logout" /></a>
                <?php else: ?>
                    <a href="index.php?page=login"><img src="upload/sign-in.svg" alt="Login" /></a>
                <?php endif; ?>
            </span>
        </div>
    </nav>
    <main>
        <?php
        if (isset($templateParams["nome"])) {
            require($templateParams["nome"]);
        }
        ?>
    </main>
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