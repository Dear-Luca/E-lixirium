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
            <header>
                <a href="./?page=products&category=<?php echo urlencode($category); ?>"
                    class="btn btn-outline-primary mb-3 d-none d-lg-inline-block bg-light-purple border-0 text-purple">Back
                    to <?php echo $category; ?></a>
                <h2 class="d-none d-lg-block display-5"><?php echo $product["name"]; ?></h2>
                <?php if ($product["amount_left"] < 5): ?>
                    <p class="text-danger fw-semibold mb-0">Only <?php echo $product["amount_left"]; ?> left!</p>
                <?php endif; ?>
                <div class="d-flex align-items-center">
                    <p class="text-purple pe-3 m-0"><strong>€<?php echo $product["price"]; ?></strong></p>
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
                <p class="my-4"><?php echo $product["description"]; ?></p>
            </header>
            <section>
                <h3>Configure your spell:</h3>
                <form action="#" method="POST">
                    <input type="hidden" id="id_product_cart" name="id_product_cart"
                        value="<?php echo $product["id_product"]; ?>" />
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
                            <input type="number" id="amount" name="amount" class="form-control" required value="1"
                                min="1" max="<?php echo $product["amount_left"]; ?>" />
                            <label class="m-2 mt-0" for="amount">Amount</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 my-3 bg-light-purple border-0 text-purple" <?php if ($product["amount_left"] < 1 || !isUserLoggedIn())
                        echo "disabled"; ?>>
                        <?php
                        if ($product["amount_left"] < 1) {
                            echo "Product finished";
                        } elseif (!isUserLoggedIn()) {
                            echo "Login to add to cart";
                        } else {
                            echo "Add to cart";
                        }
                        ?>
                    </button>
                </form>
            </section>
        </section>
    </div>
    <?php if (isUserLoggedIn()):
        $existingReview = $dbh->checkReview($product["id_product"], $_SESSION["username"]);
        $existingRating = $existingReview ? $existingReview[0]["stars"] : "";
        $existingComment = $existingReview ? $existingReview[0]["comment"] : ""; ?>
        <section class="row">
            <h3><?php echo count($existingReview) ? "Your review:" : "Leave a review:"; ?></h3>
            <form action="#" method="POST">
                <input type="hidden" id="id_product_review" name="id_product_review"
                    value="<?php echo $product["id_product"]; ?>" />
                <div class="form-floating">
                    <select class="form-select" id="rating" name="rating" aria-label="Rating" required>
                        <option disabled value="" <?php echo !$existingReview ? "selected" : ""; ?>>
                            Select a rating
                        </option>
                        <option value="1" <?php echo $existingRating == 1 ? "selected" : ""; ?>>1 - Very Poor</option>
                        <option value="2" <?php echo $existingRating == 2 ? "selected" : ""; ?>>2 - Poor</option>
                        <option value="3" <?php echo $existingRating == 3 ? "selected" : ""; ?>>3 - Average</option>
                        <option value="4" <?php echo $existingRating == 4 ? "selected" : ""; ?>>4 - Good</option>
                        <option value="5" <?php echo $existingRating == 5 ? "selected" : ""; ?>>5 - Excellent</option>
                    </select>
                    <label class="m-2 mt-0" for="rating">Rating</label>
                </div>
                <div class="form-floating">
                    <textarea id="comment" name="comment" class="form-control"
                        required><?php echo htmlspecialchars($existingComment); ?></textarea>
                    <label class="m-2 mt-0" for="comment">Comment</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 my-3 bg-light-purple border-0 text-purple">
                    <?php echo $existingReview ? "Update Review" : "Submit Review"; ?>
                </button>
            </form>
        </section>
    <?php endif; ?>
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
            <p>No comments yet. Be the first to comment!</p>
        <?php endif; ?>
    </section>
</div>