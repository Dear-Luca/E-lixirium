<div class="container">
    <?php if (count($templateParams["notifications"]) == 0): ?>
        <div class="alert alert-info text-center">
            <p class="h5">You have not received any notifications yet</p>
        </div>
    <?php else: ?>
        <div class="card">
            <div class="card-header bg-purple-mid">
                <h2 class="mb-0">Notifications</h2>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <?php foreach ($templateParams["notifications"] as $notification): ?>
                        <li onclick="window.location.href='?page=notification-detail&id=<?php echo $notification['id_notification']; ?>'"
                            class="list-group-item list-group-item-action justify-content-between d-flex align-items-center">
                            <div>
                                <p class="mb-1 h5"><?php echo $notification["title"]; ?></p>
                                <small class="text-muted"><?php echo $notification["date"]; ?></small>
                            </div>
                            <?php if ($notification["seen"] == 0): ?>
                                <span class="dot bg-primary"></span>
                            <?php endif; ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</div>