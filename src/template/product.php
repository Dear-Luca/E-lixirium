<!-- $templateParams["product"] name id_product description image_name price amount_left duration -->
<?php $product = $templateParams["product"][0] ?>
<div class="container">
    <section class="row row-cols-1 row-cols-lg-2 m-0 justify-content-center">
        <section class="col">
            <h2 class="d-block d-lg-none"><?php echo $product["name"]; ?></h2>
            <img src="<?php echo UPLOAD_DIR . $product["image_name"]; ?>" alt="<?php echo $product["image_name"]; ?>"
                class="img-fluid w-100" />
        </section>
        <section class="col">
            <header>
                <h2 class=" d-none d-lg-block"><?php echo $product["name"]; ?></h2>
                <?php if ($product["amount_left"] < 5): ?>
                    <p class="text-danger mb-0">Only <?php echo $product["amount_left"]; ?> left!</p>
                <?php endif; ?>
                <p>€<?php echo $product["price"]; ?></p>
                <p><?php echo $product["description"]; ?></p>
            </header>
            <section>
                <form action="#" method="POST">
                    <div class="row">
                        <div class="form-floating col-8">
                            <select class="form-select" id="duration" name="duration" aria-label="Spell duration"
                                required>
                                <option selected class="text-secondary" value="">Select duration</option>
                                <option value="1">1 minute</option>
                                <option value="2">1 hour</option>
                                <option value="3">1 week</option>
                                <option value="4">1 month</option>
                            </select>
                            <label for="duration">Spell duration</label>
                        </div>
                        <div class="form-floating col-4">
                            <input type="number" id="amount" name="amount" class="form-control" required value="1"
                                min="1" max="<?php echo $product["amount_left"]; ?>" />
                            <label for="typeNumber">Amount</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 my-3">Add to cart</button>
                </form>
            </section>
        </section>
    </section>
</div>