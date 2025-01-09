<div class="container my-5">
    <div class="mb-4">
        <a href="?page=orders" class="btn btn-secondary">Back to Orders</a>
    </div>
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Order Details</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($templateParams["order-detail"] as $product): ?>
                        <tr>
                            <td><?php echo $product["name"]; ?></td>
                            <td><?php echo $product["price"] . "€"; ?></td>
                            <td><?php echo $product["quantity"]; ?></td>
                            <td><?php echo $product["price"] * $product["quantity"] . "€"; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>