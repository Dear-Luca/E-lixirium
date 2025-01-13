<div class="container">
    <div class="mb-3">
        <a href="?page=notifications" class="btn btn-outline-primary bg-light-purple border-0 text-purple">Back to Orders</a>
    </div>

    <div class="card shadow-lg rounded">
        <div class="card-header bg-purple-mid">
            <h2 class="mb-0"><?php echo $templateParams["notification-detail"][0]["title"] ?></h2>
        </div>
        <div class="card-body">
            <p class="text-muted"><?php echo $templateParams["notification-detail"][0]["date"] ?></p>
            <p class="card-text">
                <?php echo nl2br(htmlspecialchars($templateParams["notification-detail"][0]["description"])); ?></p>
        </div>
    </div>
</div>