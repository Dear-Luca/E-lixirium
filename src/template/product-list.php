<?php if (isset($templateParams["header"])): ?>
    <h2 class="text-center"><?php echo $templateParams["header"]; ?></h2>
<?php endif; ?>
<div class="container-sm">
    <div
        class="row m-0 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 row-cols-xxl-7 justify-content-center">
        <?php foreach ($templateParams["products"] as $product): ?>
            <!-- name id_product description image_name price amount_left duration -->
            <article class="card card-hover col p-0 g-4 bg-purple-gray">
                <img src="<?php echo UPLOAD_DIR . $product["image_name"]; ?>" class="card-img-top"
                    alt="<?php echo $product["image_name"]; ?>" />
                <div class="card-body">
                    <h3 class="card-title"><?php echo $product["name"]; ?></h3>
                    <p class="card-text text-purple">€<?php echo $product["price"] ?></p>
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
                        <p class="m-0 fw-semibold">(<?php echo $stars; ?>)</p>
                    </span>
                    <a href="./?page=product&id=<?php echo $product["id_product"]; ?>" class="stretched-link"></a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</div>