<form action="#" method="POST">
    <h2>Login</h2>
    <?php if (isset($templateParams["error"])): ?>
        <p><?php echo $templateParams["error"]; ?></p>
    <?php endif; ?>
    <ul>
        <li>
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required/>
        </li>
        <li>
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required/>
        </li>
        <li>
            <input type="submit" name="submit" value="Login" />
        </li>
    </ul>
</form>