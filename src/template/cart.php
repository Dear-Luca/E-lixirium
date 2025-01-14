<div class="container">
    <?php if (count($templateParams["cart"]) == 0): ?>
        <div class="alert alert-info text-center">
            <p class="h5">Your cart is empty</p>
        </div>
    <?php else: ?>
        <?php if (isset($templateParams["error"])): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $templateParams["error"]; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="card">
            <div class="card-header bg-purple-mid">
                <h2 class="mb-0"> Shopping-Cart</h2>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($templateParams["cart"] as $product): ?>
                            <?php
                            $productInfo = $dbh->getProduct($product["id_product"]);
                            ?>
                            <tr>
                                <td>
                                    <a href="?page=product&id=<?php echo $product['id_product']; ?>"
                                        class="text-decoration-none text-dark">
                                        <?php echo $product['name']; ?>
                                    </a>
                                </td>
                                <td>
                                    <a href="?page=product&id=<?php echo $product['id_product']; ?>"
                                        class="text-decoration-none text-dark">
                                        <img src="<?php echo UPLOAD_DIR . $product["image_name"] ?>" />
                                    </a>

                                </td>
                                <td><?php echo $product["price"] . "€"; ?></td>
                                <td>
                                    <form method="POST" action="?page=cart">
                                        <input type="hidden" name="update_quantity" />
                                        <input type="hidden" name="id_product" value="<?php echo $product["id_product"]; ?>" />
                                        <input type="number" name="quantity" value="<?php echo $product["quantity"]; ?>" min="1"
                                            max="<?php echo $productInfo[0]["amount_left"]; ?>" />
                                        <input class="btn btn-outline-primary bg-light-purple border-0 text-purple"
                                            type="submit" name="update" value="Update" />
                                    </form>
                                </td>
                                <td><?php echo $product["price"] * $product["quantity"] . "€"; ?></td>
                                <td>
                                    <form action="?page=cart" method="POST">
                                        <input type="hidden" name="remove_product" />
                                        <input type="hidden" name="id_product" value="<?php echo $product["id_product"]; ?>" />
                                        <input class="btn btn-outline-primary bg-light-purple border-0 text-purple"
                                            type="submit" name="remove" value="Remove" />
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <p class="h5 my-3">Total: <?php echo $templateParams["total"] . "€"; ?></p>
        <!-- Modal -->
        <div class="modal fade" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Confirm Payment</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to proceed with the payment?</p>
                    </div>
                    <div class="modal-footer">
                        <form action="?page=cart" method="POST">
                            <input type="hidden" name="checkout-confirm" />
                            <button type="submit"
                                class="btn btn-outline-primary bg-light-purple border-0 text-purple">Confirm</button>
                        </form>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checkout Button -->
        <form action="?page=cart" method="POST">
            <!-- <input type="hidden" name="checkout"/> -->
            <button type="button" class="btn btn-outline-primary mb-3 bg-light-purple border-0 text-purple"
                data-bs-toggle="modal" data-bs-target=".modal">Checkout</button>
        </form>


    <?php endif; ?>
</div>