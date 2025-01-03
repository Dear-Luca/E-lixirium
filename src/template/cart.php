<h2>Shopping Cart</h2>
<?php if (count($templateParams["cart"]) == 0): ?>
    <p>Your cart is empty</p>
<?php else: ?>
    <ul>
        
        <?php foreach ($templateParams["cart"] as $product): ?>
            <li>
                <?php echo $product["id_product"] ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>