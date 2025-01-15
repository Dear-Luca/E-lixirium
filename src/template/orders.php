<div class="container my-4">
    <?php if (count($templateParams["orders"]) == 0): ?>
        <div class="alert alert-info text-center">
            <p class="h5">You have no orders</p>
        </div>
    <?php else: ?>
        <div class="card">
            <div class="card-header bg-purple-mid">
                <h2 class="mb-0">Orders</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($templateParams["orders"] as $order): ?>
                                <tr
                                    onclick="window.location.href='?page=order_detail&id_order=<?php echo $order["id_order"]; ?>'">
                                    <td><?php echo $order["id_order"]; ?></td>
                                    <td><?php echo $order["date"]; ?></td>
                                    <td><strong><?php echo $dbh->getOrderTotal($order["id_order"])[0]["total"] . '€'; ?></strong>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    <?php endif; ?>
</div>