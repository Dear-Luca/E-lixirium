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
                        <li class="list-group-item list-group-item-action">
                            <a href="?page=notification-detail&id=<?php echo $notification['id_notification']; ?>"
                                class="d-flex justify-content-between text-decoration-none text-dark">
                                <div>
                                    <p class="mb-1 h5"><?php echo $notification["title"]; ?></p>
                                    <small class="text-muted"><?php echo $notification["date"]; ?></small>
                                </div>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>    
    <?php endif; ?>
</div>