<div class="container my-5">

    <h2 class="mb-4">Admin</h2>
    <?php if (isset($templateParams["error"])): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?php echo $templateParams["error"]; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="d-flex align-items-center mb-4">
        <h3>Add category</h3>
    </div>

    <form method="POST" action="?page=account">
        <div class="mb-3">
            <label for="categoryName" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="categoryName" name="categoryName"
                placeholder="Enter category name" required />
        </div>
        <button type="submit" class="btn btn-outline-primary bg-light-purple border-0 text-purple">Create
            Category</button>
    </form>

    <div class="d-flex align-items-center mb-4 mt-4">
        <h3>Add product</h3>
    </div>

    <form class="mb-4" method="POST" action="?page=account" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="productName" class="form-label">Name</label>
            <input type="text" class="form-control" id="productName" name="productName" placeholder="Enter product name"
                required />
        </div>

        <div class="mb-3">
            <label for="productDescription" class="form-label">Description</label>
            <textarea class="form-control" id="productDescription" name="productDescription" rows="3"
                placeholder="Enter product description" required></textarea>
        </div>

        <div class="mb-3">
            <label for="productPrice" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="productPrice" name="productPrice"
                placeholder="Enter price" required />
        </div>

        <div class="mb-3">
            <label for="productAmount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="productAmount" name="productAmount" placeholder="Enter amount"
                required />
        </div>

        <div class="mb-3">
            <span class="form-label">Category</span>
            <?php foreach ($templateParams["categories"] as $index => $category): ?>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="category[]"
                        value="<?php echo htmlspecialchars($category["name"]); ?>" id="category-<?php echo $index; ?>" />
                    <label class="form-check-label" for="category-<?php echo $index; ?>">
                        <?php echo htmlspecialchars($category["name"]); ?>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>

        <fieldset class="mb-3">
            <legend class="h6">Duration</legend>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="duration" id="durationHour" value="hour" />
                <label class="form-check-label" for="durationHour">Hour</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="duration" id="durationDay" value="day" />
                <label class="form-check-label" for="durationDay">Day</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="duration" id="durationWeek" value="week" />
                <label class="form-check-label" for="durationWeek">Week</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="duration" id="durationMonth" value="month" />
                <label class="form-check-label" for="durationMonth">Month</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="duration" id="durationForever" value="forever" />
                <label class="form-check-label" for="durationForever">Forever</label>
            </div>
        </fieldset>

        <div class="mb-3">
            <label for="productImages" class="form-label">Images</label>
            <input type="file" class="form-control" id="productImages" name="productImages" required />
        </div>

        <div>
            <button type="submit" class="btn btn-outline-primary bg-light-purple border-0 text-purple">Create
                product</button>
        </div>
    </form>
</div>