<?php
$currentId = $templateParams["notification-detail"][0]["id_notification"];
$notifications = $templateParams["notifications"];
$nextId = null;
$prevId = null;

for ($i = 0; $i < count($notifications); $i++) {
    if ($notifications[$i]['id_notification'] == $currentId) {
        if ($i > 0) {
            $prevId = $notifications[$i - 1]['id_notification'];
        }
        if ($i < count($notifications) - 1) {
            $nextId = $notifications[$i + 1]['id_notification'];
        }
        break;
    }
}
?>
<div class="container my-4">
    <div class="mb-3">
        <a href="?page=notifications" class="btn btn-outline-primary bg-light-purple border-0 text-purple">Back to
            Notifications</a>
    </div>

    <div class="card shadow-lg rounded">
        <div class="card-header bg-purple-mid">
            <h2 class="mb-0"><?php echo $templateParams["notification-detail"][0]["title"] ?></h2>
        </div>
        <div class="card-body">
            <p class="text-muted"><?php echo $templateParams["notification-detail"][0]["date"] ?></p>
            <p class="card-text">
                <?php echo nl2br(htmlspecialchars($templateParams["notification-detail"][0]["description"])); ?>
            </p>
        </div>
    </div>
    <div class="d-flex justify-content-between mt-3">
        <a href="?page=notification-detail&id=<?php echo $prevId == null ? $currentId : $prevId; ?>"
            class="btn btn-outline-primary bg-light-purple border-0 text-purple">Next</a>
        <a href="?page=notification-detail&id=<?php echo $nextId == null ? $currentId : $nextId; ?>"
            class="btn btn-outline-primary bg-light-purple border-0 text-purple">Previous</a>
    </div>
</div>