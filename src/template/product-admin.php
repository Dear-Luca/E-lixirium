<!-- $templateParams["product"] name id_product description image_name price amount_left duration -->
<?php array_push($templateParams["js"], "product.js");
$product = $templateParams["product"][0];
$category = $dbh->getCategoriesOfProduct($product["id_product"])[0]["name"]; ?>
<div class="container">
    <div class="row row-cols-1 row-cols-lg-2 m-0 justify-content-center">
        <section class="col py-3 px-0 px-lg-3">
            <a href="./?page=products&category=<?php echo urlencode($category); ?>"
                class="btn btn-outline-primary mb-3 d-lg-none bg-light-purple border-0 text-purple">Back to
                <?php echo $category; ?></a>
            <h2 class="d-block d-lg-none display-5"><?php echo $product["name"]; ?></h2>
            <img src="<?php echo UPLOAD_DIR . $product["image_name"]; ?>" alt="<?php echo $product["image_name"]; ?>"
                class="img-fluid w-100" />
        </section>
        <section class="col py-3 px-0 px-lg-3">
            <form action="#" method="POST">
                <input type="hidden" id="id_product_update" name="id_product_update"
                    value="<?php echo $product["id_product"]; ?>" />
                <header>
                    <a href="./?page=products&category=<?php echo urlencode($category); ?>"
                        class="btn btn-outline-primary mb-3 d-none d-lg-inline-block bg-light-purple border-0 text-purple">Back
                        to <?php echo $category; ?></a>
                    <h2 class="d-none d-lg-block display-5"><?php echo $product["name"]; ?></h2>
                    <div class="d-flex align-items-center">
                        <div class="form-floating col-3 me-3">
                            <input type="text" class="text-purple form-control" value="<?php echo $product["price"]; ?>"
                                name="price" id="price" />
                            <label for="price">Price (€)</label>
                        </div>
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
                    </div>
                    <div class="form-floating">
                        <textarea class="pe-3 m-0 form-control h-100" name="description" id="description"
                            rows="4"><?php echo $product["description"]; ?></textarea>
                        <label for="description">Description</label>
                    </div>
                </header>
                <section>
                    <h3>Spell configuration:</h3>
                    <div class="row">
                        <div class="form-floating col-8">
                            <select class="form-select" id="duration" name="duration" aria-label="Spell duration">
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
                            <input type="number" id="amount" name="amount" class="form-control" required
                                value="<?php echo $product["amount_left"]; ?>" min="0" />
                            <label class="m-2 mt-0" for="amount">Amount</label>
                        </div>
                    </div>
                    <div class="d-flex mt-3">
                        <button type="submit" class="btn bg-light-purple me-1 border-0 text-purple">
                            Update product
                        </button>
                        <button class="btn btn-danger d-inline-block" type="button" data-bs-toggle="modal"
                            data-bs-target="#deleteModal">
                            <img src="<?php echo UPLOAD_DIR ?>trash.svg" alt="Trash" height="35" />Delete product
                        </button>
                    </div>
                </section>
            </form>
        </section>
    </div>
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="deleteProductModalLabel">Delete product</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this product?</p>
                </div>
                <div class="modal-footer">
                    <form action="#" method="POST">
                        <input type="hidden" name="delete-confirm" />
                        <input type="hidden" id="id_product_delete" name="id_product_delete"
                            value="<?php echo $product["id_product"]; ?>" />
                        <button type="submit"
                            class="btn btn-outline-primary bg-light-purple border-0 text-purple">Confirm</button>
                    </form>
                    <button type="button" class="btn btn-danger d-inline-block" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
    <section class="row pt-3">
        <h3>Comments:</h3>
        <hr />
        <?php
        $comments = $dbh->getReviews($product["id_product"]);
        if (count($comments) > 0):
            foreach ($comments as $comment): ?>
                <div class="mb-3">
                    <h4 class="h5"><?php echo htmlspecialchars($comment["username"]); ?>:</h4>
                    <?php
                    $stars = $comment["stars"];
                    for ($i = 1; $i <= 5; $i++) {
                        if ($i <= $stars) {
                            echo "<img src='" . UPLOAD_DIR . "star-full.svg' alt='Filled star' />";
                        } else {
                            echo "<img src='" . UPLOAD_DIR . "star-empty.svg' alt='Empty star' />";
                        }
                    }
                    ?>
                    <p><?php echo htmlspecialchars($comment["comment"]); ?></p>
                </div>
                <hr />
            <?php endforeach;
        else: ?>
            <p>No comments yet</p>
        <?php endif; ?>
    </section>
</div>