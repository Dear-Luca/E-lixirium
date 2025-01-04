<div class="d-flex justify-content-center align-items-center">
    <form action="#" method="POST" class="w-100 m-5">
        <h2 class="h3 mb-3 fw-normal">Register</h2>
        <p>Already registered? <a href="?page=login">Login</a></p>
        <?php if (isset($templateParams["error"])): ?>
            <p><?php echo $templateParams["error"]; ?></p>
        <?php endif; ?>
        <div class="form-floating">
            <input type="text" class="form-control" id="name" name="name" required />
            <label for="name" class="form-label">Name</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="surname" name="surname" required />
            <label for="surname" class="form-label">Surname</label>
        </div>
        <div class="form-floating">
            <input type="date" class="form-control" id="birthday" name="birthday" required />
            <label for="birthday" class="form-label">Birthday</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control" id="username" name="username" required />
            <label for="username" class="form-label">Username</label>
        </div>
        <div class="form-floating">
            <input type="email" class="form-control" id="email" name="email" required />
            <label for="email" class="form-label">Email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" required />
            <label for="password" class="form-label">Password</label>
        </div>
        <button class="btn btn-primary w-100 my-4" type="submit">Register</button>
    </form>
</div>