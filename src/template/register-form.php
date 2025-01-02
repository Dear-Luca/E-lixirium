<form action="#" method="POST">
    <h2>Register</h2>
    <?php if (isset($templateParams["error"])): ?>
        <p><?php echo $templateParams["error"]; ?></p>
    <?php endif; ?>
    <ul>
        <li>
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required />
        </li>
        <li>
            <label for="surname" class="form-label">Surname:</label>
            <input type="text" class="form-control" id="surname" name="surname" required/>
        </li>
        <li>
            <label for="birthday" class="form-label">Birthday:</label>
            <input type="date" class="form-control" id="birthday" name="birthday" required/>
        </li>
        <li>
            <label for="username" class="form-label">Username:</label>
            <input type="text" class="form-control" id="username" name="username" required/>
        </li>
        <li>
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required/>
        </li>
        <li>
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="password" required/>
        </li>
        <li>
            <input type="submit" name="submit" value="Register" />
        </li>
    </ul>
</form>