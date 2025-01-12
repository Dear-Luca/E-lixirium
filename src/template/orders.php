<div class="container">
    <?php if (count($templateParams["orders"]) == 0): ?>
        <p>You have no orders</p>
    <?php else: ?>
        <div class="card">
            <div class="card-header bg-purple text-white">
                <h2 class="mb-0">Orders</h2>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead >
                        <tr>
                            <th scope="col">Order ID</th>
                            <th scope="col">Date</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($templateParams["orders"] as $order): ?>
                            <tr onclick="window.location.href='?page=order_detail&id_order=<?php echo $order["id_order"]; ?>'">
                                <td><?php echo $order["id_order"]; ?></td>
                                <td><?php echo $order["date"]; ?></td>
                                <th><?php echo $dbh->getOrderTotal($order["id_order"])[0]["total"] . '€'; ?></th>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </div>

    <?php endif; ?>