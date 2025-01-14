<?php array_push($templateParams["js"], "particles.js"); ?>
<!-- Image and Title -->
<div class="container-fluid">
    <section class="row m-0 justify-content-center text-center">
        <img src="<?php echo UPLOAD_DIR . "potion.jpg"; ?>" alt="Logo" class="img-fluid" />
        <h2 class="mt-3">The Best Spell Shop</h2>
    </section>

    <!-- Categories Carousel -->
    <section class="mt-5">
        <h2>Random categories</h2>
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-6 m-0">
            <?php foreach ($templateParams["categories"] as $category): ?>
                <div class="col">
                    <div class="card card-hover borders-0">
                        <img src="<?php echo UPLOAD_DIR; ?>/potion.jpg" class="card-img-top" alt="">
                        <div class="card-body">
                            <p class="text-nowrap text-center h-md-4 h-lg-5"><?php echo $category["name"]; ?></p>
                            <a href="./?page=products&category=<?php echo $category["name"]; ?>" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Product List -->
    <section class="mt-5">
        <h2>Top products</h2>
        <div class="row row-cols-2 row-cols-md-3 g-4 m-0">
            <?php foreach ($templateParams["products"] as $product): ?>
                <div class="col">
                    <div class="card magic-card card-hover">
                        <img src="<?php echo UPLOAD_DIR . "potion.jpg"; ?>" class="card-img-top" alt="" />
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $product["name"]; ?></h3>
                            <span class="d-flex">
                                <?php
                                $stars = $product["stars"];
                                for ($i = 1; $i <= 5; $i++) {
                                    if ($i <= $stars) {
                                        echo "<img src='" . UPLOAD_DIR . "star-full.svg' alt='Filled star' />";
                                    } else {
                                        echo "<img src='" . UPLOAD_DIR . "star-empty.svg' alt='Empty star' />";
                                    }
                                }
                                ?>
                                <p class="m-0 small fw-semibold">(<?php echo $stars; ?>)</p>
                            </span>
                            <a href="./?page=product&id=<?php echo $product["id_product"]; ?>" class="stretched-link"></a>
                        </div>
                        <div class="magic-particles"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>