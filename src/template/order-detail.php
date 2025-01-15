<div class="container my-4">
    <div class="mb-3">
        <a href="?page=orders" class="btn btn-outline-primary bg-light-purple border-0 text-purple">Back to Orders</a>
    </div>
    <div class="card">
        <div class="card-header bg-purple-mid">
            <h2 class="mb-0">Order Details</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Image</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($templateParams["order-detail"] as $product): ?>
                            <tr onclick="window.location='?page=product&id=<?php echo $product['id_product']; ?>';">
                                <td><?php echo $product['name']; ?></td>
                                <td>
                                    <img src="<?php echo UPLOAD_DIR . $product["image_name"]; ?>"
                                        alt="<?php echo $product['name']; ?>" class="img-thumbnail img-fluid"/>
                                </td>
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
</div>