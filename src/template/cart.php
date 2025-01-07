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
                <tr>
                    <td><?php echo $product["name"]; ?></td>
                    <td><?php echo $product["price"] . "€"; ?></td>
                    <td>
                        <form method="POST" action="?page=cart">
                            <input type="hidden" name="update_quantity"/>
                            <input type="hidden" name="id_product" value="<?php echo $product["id_product"]; ?>" />
                            <input type="number" name="quantity" value="<?php echo $product["quantity"]; ?>" min="1" />
                            <input type="submit" name="update" value="Update" />
                        </form>
                    </td>
                    <td><?php echo $product["price"] * $product["quantity"] . "€"; ?></td>
                    <td>
                        <form action="?page=cart" method="POST">
                            <input type="hidden" name="remove_product"/>
                            <input type="hidden" name="id_product" value="<?php echo $product["id_product"]; ?>" />
                            <input type="submit" name="remove" value="Remove" />
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <p>Total: <?php echo $templateParams["total"] . "€"; ?></p>
    <form action="?post=cart" method="POST">
        <input type="submit" name="checkout" value="Checkout" />
    </form>


<?php endif; ?>