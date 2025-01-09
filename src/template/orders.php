<h2>Orders</h2>
<?php if (count($templateParams["orders"]) == 0): ?>
    <p>You have no orders</p>
<?php else: ?>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($templateParams["orders"] as $order): ?>
                <tr onclick="window.location.href='order_detail?id_order=<?php echo $order["id_order"]; ?>'">
                    <td><?php echo $order["id_order"]; ?></td>
                    <td><?php echo $order["date"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>