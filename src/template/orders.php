<h2>Orders</h2>
<?php if (count($templateParams["orders"]) == 0): ?>
    <p>You have no orders</p>
<?php else: ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Date</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($templateParams["orders"] as $order): ?>
                <tr>
                    <td><?php echo $order["id_order"]; ?></td>
                    <td><?php echo $order["date"]; ?></td>
                    <td><?php echo $order["total"] . "€"; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>