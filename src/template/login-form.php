<div class="d-flex justify-content-center align-items-center">
    <form action="#" method="POST" class="w-100 m-5">
        <h2 class="h3 mb-3 fw-normal">Login</h2>
        <p>Don't have an account? <a href="./?page=register" class="text-purple">Sign up</a></p>
        <?php if (isset($templateParams["error"])): ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $templateParams["error"]; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        <div class="form-floating">
            <input type="text" class="form-control" id="username" name="username" required />
            <label for="username">Username</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="password" name="password" required />
            <label for="password">Password</label>
        </div>
        <button class="btn btn-primary w-100 my-4 bg-light-purple border-0 text-purple" type="submit">Login</button>
    </form>
</div>