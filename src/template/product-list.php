<?php if (isset($templateParams["category"])): ?>
    <h2><?php echo $templateParams["category"]; ?></h2>
<?php endif; ?>
<div class="container-sm">
    <div
        class="row m-0 row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xl-6 row-cols-xxl-7 justify-content-center">
        <?php foreach ($templateParams["products"] as $product):
            if ($product["amount_left"] > 0): ?>
                <!-- name id_product description image_name price amount_left duration -->
                <article class="card col p-0">
                    <img src="<?php echo UPLOAD_DIR . $product["image_name"]; ?>" class="card-img-top"
                        alt="<?php echo $product["image_name"]; ?>" />
                    <div class="card-body">
                        <h3 class="card-title"><?php echo $product["name"]; ?></h3>
                        <p class="card-text"><?php echo $product["price"] . "€"; ?></p>
                        <p class="card-text">stars (number)</p>
                    </div>
                </article>
            <?php endif;
        endforeach; ?>
    </div>
</div>