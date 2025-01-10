<!-- Image and Title -->
<div class="container my-5 text-center mb-4">
        <img src="<?php echo UPLOAD_DIR . "potion.jpg"; ?>" alt="Logo" class="img-fluid"/>
        <h1 class="mt-3">The Best Spell Shop</h1>
    </div>

    <!-- Categories Carousel -->
    <div class="mb-5">
        <h3>Categories</h3>
        <div class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="d-flex justify-content-center">
                        <?php foreach ($templateParams["categories"] as $category): ?>
                            <div class="p-3 border mx-2">
                                <?php echo $category["name"]; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#categoryCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#categoryCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- Products List -->
    <div>
        <h3>Products</h3>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <?php foreach ($templateParams["products"] as $product): ?>
                <div class="col">
                    <div class="card">
                        <img src="<?php echo UPLOAD_DIR . "potion.jpg"; ?>" class="card-img-top" alt="<?php echo "potion.jpg"; ?>" />
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $product["name"]; ?></h5>
                            <p class="card-text"><strong>Price: </strong><?php echo $product["price"]; ?> €</p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>