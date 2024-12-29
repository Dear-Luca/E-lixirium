<form action="#" method="POST">
    <h2>Register</h2>
    <?php if (isset($templateParams["error"])): ?>
        <p><?php echo $templateParams["error"]; ?></p>
    <?php endif; ?>
    <ul>
        <li>
            <label for="name">Name:</label><input type="text" id="name" name="name" />
        </li>
        <li>
            <label for="surname">Surname:</label><input type="text" id="surname" name="surname" />
        </li>
        <li>
            <label for="username">Username:</label><input type="text" id="username" name="username" />
        </li>
        <li>
            <label for="email">Email:</label><input type="text" id="email" name="email" />
        </li>
        <li>
            <label for="password">Password:</label><input type="password" id="password" name="password" />
        </li>
        <li>
            <input type="submit" name="submit" value="Invia" />
        </li>
    </ul>
</form>