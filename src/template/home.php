<?php array_push($templateParams["js"], "particles.js");
array_push($templateParams["js"], "home.js"); ?>
<!-- Image and Title -->
<div class="container-fluid">
    <section class="row my-5 justify-content-center text-center">
        <img src="<?php echo UPLOAD_DIR . "potion.jpg"; ?>" alt="Logo" class="img-fluid" />
        <h2 class="mt-3">The Best Spell Shop</h2>
    </section>
    <hr>
    <!-- Categories Carousel -->
    <section class="mb-5 mt-1">
        <h2>Random categories</h2>
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-6 m-0 mt-4">
            <?php foreach ($templateParams["categories"] as $category): ?>
                <div class="col">
                    <div class="card card-hover borders-0">
                        <div class="card-img-top randomColorImage"></div>
                        <div class="card-body">
                            <p class="text-nowrap text-center fw-semibold"><?php echo $category["name"]; ?></p>
                            <a href="./?page=products&category=<?php echo urlencode($category["name"]); ?>"
                                class="stretched-link" title="<?php echo "Products - " . $category["name"]; ?>"></a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
    <hr>
    <!-- Product List -->
    <section class="mb-5 mt-1">
        <h2>Top products</h2>
        <div class="row row-cols-2 row-cols-md-3 row-cols-xl-6 g-4 m-0">
            <?php foreach ($templateParams["products"] as $product): ?>
                <div class="col">
                    <div class="card magic-card card-hover">
                        <img src="<?php echo UPLOAD_DIR . $product["image_name"]; ?>" class="card-img-top" alt="" />
                        <div class="card-body">
                            <h3 class="card-title"><?php echo $product["name"]; ?></h3>
                            <div class="d-flex">
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
                            </div>
                            <a href="./?page=product&id=<?php echo $product["id_product"]; ?>" class="stretched-link"
                                title="<?php echo "Product - " . $product["name"]; ?>"></a>
                        </div>
                        <div class="magic-particles"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>