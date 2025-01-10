<div class="container mt-4">
    <a href="?page=notifications" class="btn btn-outline-primary mb-4">
        <i class="bi bi-arrow-left"></i> Back to Notifications
    </a>

    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="card-title"><?php echo $templateParams["notification-detail"][0]["title"] ?></h2>
            <p class="text-muted"><?php echo $templateParams["notification-detail"][0]["date"] ?></p>
            <p class="card-text"><?php echo nl2br(htmlspecialchars($templateParams["notification-detail"][0]["description"])); ?></p>
        </div>
    </div>
</div>