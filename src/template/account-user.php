<div class="card">
    <header class="card-header">
        <h2>Account</h2>
    </header>
    <h3 class="mb-4">User Information</h3>
    <?php if (isset($templateParams["error"])): ?>
        <p><?php echo $templateParams["error"]; ?></p>
    <?php endif; ?>
    <section class="card-body">
        <form id="user-form" method="POST" action="?page=account">
            <div class="mb-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="<?php echo $_SESSION['name']; ?>"
                    disabled>
            </div>

            <div class="mb-3">
                <label for="surname" class="form-label">Surname:</label>
                <input type="text" id="surname" name="surname" class="form-control"
                    value="<?php echo $_SESSION['surname']; ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control"
                    value="<?php echo $_SESSION['username']; ?>" disabled>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control"
                    value="<?php echo $_SESSION['email']; ?>" disabled>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" id="edit-button" class="btn btn-primary">Edit</button>
                <button type="submit" id="save-button" class="btn btn-success">Save</button>
                <button type="button" id="cancel-button" class="btn btn-danger">Cancel</button>
            </div>
        </form>
    </section>
    </div>