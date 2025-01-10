<div>
    <h2>Notifications</h2>
    <?php if (count($templateParams["notifications"]) == 0): ?>
        <p>You have not received any notifications yet</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($templateParams["notifications"] as $notification): ?>
                <li class="list-group-item list-group-item-action">
                    <a href="?page=notification-detail&id=<?php echo $notification['id']; ?>"
                        class="d-flex justify-content-between text-decoration-none text-dark">
                        <div>
                            <h5 class="mb-1"><?php echo $notification["title"]; ?></h5>
                            <small class="text-muted"><?php echo $notification["date"]; ?></small>
                        </div>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>