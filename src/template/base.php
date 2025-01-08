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
        // TODO: debug only, remove before release
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
                        <a class="nav-link" href="?page=home">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Products
                        </a>
                        <ul class="dropdown-menu">
                            <?php foreach ($templateParams["categories"] as $category): ?>
                                <li>
                                    <a class="dropdown-item"
                                        href="?page=products&category=<?php echo $category["name"] ?>"><?php echo $category["name"] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?page=about">About Us</a>
                    </li>
                    <!-- <hr class="d-block d-md-none" /> -->
                    <div class="nav-link d-block d-md-none p-0">
                        <?php if (isUserLoggedIn()): ?>
                            <!-- User logged in: -->
                            <li class="nav-item"><a class="nav-link" href="?page=cart">Shopping Cart</a></li>
                            <li class="nav-item"><a class="nav-link" href="?page=orders">Orders</a></li>
                            <li class="nav-item"><a class="nav-link" href="?page=notifications">Notifications</a></li>
                            <li class="nav-item"><a class="nav-link" href="?page=account">Account</a></li>
                            <li class="nav-item"><a class="nav-link" href="?page=logout">Logout</a></li>
                        <?php elseif (isAdminLoggedIn()): ?>
                            <!-- Admin logged in: -->
                            <li class="nav-item"><a class="nav-link" href="?page=account">Admin account</a></li>
                            <li class="nav-item"><a class="nav-link" href="?page=logout">Logout</a></li>
                        <?php else: ?>
                            <!-- User not logged in: -->
                            <li class="nav-item"><a class="nav-link" href="?page=register">Register</a></li>
                            <li class="nav-item"><a class="nav-link" href="?page=login">Login</a></li>
                        <?php endif; ?>
                    </div>
                </ul>
            </div>
            <form class="d-flex" role="search" method="GET" action="search.php">
                <input class="form-control me-2" type="search" placeholder="Search products" aria-label="Search"
                    name="value" id="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <div class="nav-link d-none d-md-flex">
                <?php if (isUserLoggedIn()): ?>
                    <!-- User logged in: -->
                    <a href="?page=cart"><img src="<?php echo UPLOAD_DIR ?>cart-speed.svg" alt="Shopping Cart" /></a>
                    <a href="?page=orders"><img src="<?php echo UPLOAD_DIR ?>box-check.svg" alt="Orders" /></a>
                    <a href="?page=notifications"><img src="<?php echo UPLOAD_DIR ?>notification-13.svg"
                            alt="Notifications" /></a>
                    <a href="?page=account"><img src="<?php echo UPLOAD_DIR ?>user.svg" alt="Account" /></a>
                    <a href="?page=logout"><img src="<?php echo UPLOAD_DIR ?>sign-out.svg" alt="Logout" /></a>
                <?php elseif (isAdminLoggedIn()): ?>
                    <!-- Admin logged in: -->
                    <a href="?page=account"><img src="<?php echo UPLOAD_DIR ?>user.svg" alt="Account" /></a>
                    <a href="?page=logout"><img src="<?php echo UPLOAD_DIR ?>sign-out.svg" alt="Logout" /></a>
                <?php else: ?>
                    <!-- User not logged in: -->
                    <a href="?page=login"><img src="<?php echo UPLOAD_DIR ?>sign-in.svg" alt="Login" /></a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <main>
        <?php
        if (isset($templateParams["content"])) {
            require($templateParams["content"]);
        }
        ?>
    </main>
    <div class="container">
        <footer class="py-3 my-4">
            <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                <li class="nav-item">
                    <a href="?page=home" class="nav-link px-2 text-body-secondary">Home</a>
                </li>
                <li class="nav-item">
                    <a href="?page=products" class="nav-link px-2 text-body-secondary">Products</a>
                </li>
                <li class="nav-item">
                    <a href="?page=about" class="nav-link px-2 text-body-secondary">About Us</a>
                </li>
            </ul>
            <p class="text-center text-body-secondary">© 2024 E-lixirium</p>
        </footer>
    </div>
    <?php
    if (isset($templateParams["js"])):
        foreach ($templateParams["js"] as $script):
            ?>
            <script src="<?php echo SCRIPTS_DIR . $script; ?>"></script>
            <?php
        endforeach;
    endif;
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>