<h2 class="mb-4">Shopping Cart</h2>
<?php if (count($templateParams["cart"]) == 0): ?>
    <p>Your cart is empty</p>
<?php else: ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Product</th>
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
                    <td><?php echo $product["name"]; ?></td>
                    <td><?php echo $product["price"] . "€"; ?></td>
                    <td>
                        <form method="POST" action="?page=cart">
                            <input type="hidden" name="update_quantity" />
                            <input type="hidden" name="id_product" value="<?php echo $product["id_product"]; ?>" />
                            <input type="number" name="quantity" value="<?php echo $product["quantity"]; ?>" min="1"
                                max="<?php echo $productInfo[0]["amount_left"]; ?>" />
                            <input type="submit" name="update" value="Update" />
                        </form>
                    </td>
                    <td><?php echo $product["price"] * $product["quantity"] . "€"; ?></td>
                    <td>
                        <form action="?page=cart" method="POST">
                            <input type="hidden" name="remove_product" />
                            <input type="hidden" name="id_product" value="<?php echo $product["id_product"]; ?>" />
                            <input type="submit" name="remove" value="Remove" />
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>Total: <?php echo $templateParams["total"] . "€"; ?></p>
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
                    <form action="?page=cart"  method="POST">
                        <input type="hidden" name="checkout-confirm">
                        <button type="submit" class="btn btn-primary">Confirm</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Checkout Button -->
    <form action="?page=cart" method="POST">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target=".modal">Checkout</button>
    </form>


<?php endif; ?>