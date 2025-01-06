<div class="card">
    <header class="card-header">
        <h2>Account</h2>
    </header>
    <h3 class="mb-3">User Information</h3>
    <?php if (isset($templateParams["error"])): ?>
        <p><?php echo $templateParams["error"]; ?></p>
    <?php endif; ?>
    <section class="card-body">
        <form id="user-form" method="POST" action="?page=account">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control"
                    value="<?php echo $templateParams["userInfo"][0]["name"]; ?>"
                    data-original-value="<?php echo $templateParams['userInfo'][0]['name']; ?>" disabled />
            </div>

            <div class="mb-3">
                <label for="surname" class="form-label">Surname:</label>
                <input type="text" id="surname" name="surname" class="form-control"
                    value="<?php echo $templateParams["userInfo"][0]["surname"]; ?>"
                    data-original-value="<?php echo $templateParams['userInfo'][0]['surname']; ?>" disabled />
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control"
                    value="<?php echo $templateParams["userInfo"][0]["username"]; ?>"
                    data-original-value="<?php echo $templateParams['userInfo'][0]['username']; ?>" disabled />
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control"
                    value="<?php echo $templateParams["userInfo"][0]["email"]; ?>"
                    data-original-value="<?php echo $templateParams['userInfo'][0]['email']; ?>" disabled />
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label">Birthday:</label>
                <input type="date" id="birthday" name="birthday" class="form-control"
                    value="<?php echo $templateParams["userInfo"][0]["birthday"]; ?>"
                    data-original-value="<?php echo $templateParams['userInfo'][0]['birthday']; ?>" disabled />
            </div>
            <div class="mb-3">
                <label for="card_number" class="form-label">Card number:</label>
                <input type="text" id="card_number" name="card_number" class="form-control"
                    value="<?php echo $templateParams["userInfo"][0]["card_number"]; ?>"
                    data-original-value="<?php echo $templateParams['userInfo'][0]['card_number']; ?>" disabled />
            </div>

            <div class="mb-3">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control"
                    value="<?php echo $templateParams["userInfo"][0]["password"]; ?>"
                    data-original-value="<?php echo $templateParams['userInfo'][0]['password']; ?>" disabled />
            </div>

            <div class="mb-3" id="confirm-password-container">
                <label for="confirmPassword" class="form-label">Confirm password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" class="form-control"
                    value="<?php echo $templateParams["userInfo"][0]["password"]; ?>"
                    data-original-value="<?php echo $templateParams['userInfo'][0]['password']; ?>" />
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" id="edit-button" class="btn btn-primary">Edit</button>
                <button type="submit" id="save-button" class="btn btn-success">Save</button>
                <button type="button" id="cancel-button" class="btn btn-danger">Cancel</button>
            </div>
        </form>
    </section>
</div>