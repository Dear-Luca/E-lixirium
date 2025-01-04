<h2>Shopping Cart</h2>
<?php if (count($templateParams["cart"]) == 0): ?>
    <p>Your cart is empty</p>
<?php else: ?>
    <ul>
        <?php foreach ($templateParams["cart"] as $product): ?>
            <li>
                <?php echo $product["name"] ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>