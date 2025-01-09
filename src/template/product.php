<!-- $templateParams["product"] name id_product description image_name price amount_left duration -->
<?php $product = $templateParams["product"][0];
$category = $dbh->getCategoriesOfProduct($product["id_product"])[0]["name"]; ?>
<div class="container">
    <div class="row row-cols-1 row-cols-lg-2 m-0 justify-content-center">
        <section class="col">
            <a href="?page=products&category=<?php echo $category; ?>"
                class="btn btn-outline-primary mb-3 d-lg-none">Back to <?php echo $category; ?></a>
            <h2 class="d-block d-lg-none"><?php echo $product["name"]; ?></h2>
            <img src="<?php echo UPLOAD_DIR . $product["image_name"]; ?>" alt="<?php echo $product["image_name"]; ?>"
                class="img-fluid w-100" />
        </section>
        <section class="col">
            <header>
                <a href="?page=products&category=<?php echo $category; ?>"
                    class="btn btn-outline-primary mb-3 d-none d-lg-inline-block">Back to <?php echo $category; ?></a>
                <h2 class="d-none d-lg-block"><?php echo $product["name"]; ?></h2>
                <?php if ($product["amount_left"] < 5): ?>
                    <p class="text-danger mb-0">Only <?php echo $product["amount_left"]; ?> left!</p>
                <?php endif; ?>
                <p>€<?php echo $product["price"]; ?></p>
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
                    <p class="m-0">(<?php echo $stars; ?>)</p>
                </span>
                <p><?php echo $product["description"]; ?></p>
            </header>
            <section>
                <h3">Configure your spell:</h3>
                <form action="#" method="POST">
                    <div class="row">
                        <div class="form-floating col-8">
                            <select class="form-select" id="id_product" name="id_product"
                                aria-label="Spell duration" required>
                                <option selected value="<?php echo $product["id_product"]; ?>">
                                    <?php echo $product["duration"]; ?>
                                </option>
                                <?php
                                $matchProducts = $dbh->getProductsOfName($product["name"]);
                                foreach ($matchProducts as $matchProduct) {
                                    if ($matchProduct["duration"] != $product["duration"] && $matchProduct["amount_left"] > 0) {
                                        echo "<option value='" . $matchProduct["id_product"] . "'>" . $matchProduct["duration"] . "</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label class="m-2 mt-0" for="duration">Spell duration</label>
                        </div>
                        <div class="form-floating col-4">
                            <input type="number" id="amount" name="amount" class="form-control" required value="1"
                                min="1" max="<?php echo $product["amount_left"]; ?>" />
                            <label class="m-2 mt-0" for="amount">Amount</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 my-3" <?php if ($product["amount_left"] < 1)
                        echo "disabled"; ?>>
                        <?php
                        if ($product["amount_left"] < 1) {
                            echo "Product finished";
                        } else {
                            echo "Add to cart";
                        }
                        ?>
                    </button>
                </form>
            </section>
        </section>
    </div>
</div>