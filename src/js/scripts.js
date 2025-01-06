document.querySelector("nav a.dropdown-toggle").addEventListener('click', function (event) {
    const dropdownMenu = document.querySelector("nav ul.dropdown-menu");
    // Check if dropdown is expanded
    if (!dropdownMenu.classList.contains('show')) {
        // Redirect to all products page
        window.location.href = "?page=products";
    }
});

document.getElementById("edit-button").addEventListener("click", function () {
    // enable fields
    document.getElementById("name").disabled = false;
    document.getElementById("surname").disabled = false;
    document.getElementById("username").disabled = false;
    document.getElementById("email").disabled = false;

    // show buttons save and cancel
    document.getElementById("save-button").style.display = "block";
    document.getElementById("cancel-button").style.display = "block";
    document.getElementById("edit-button").style.display = "none";
});

document.getElementById("cancel-button").addEventListener("click", function () {
    // show current values (of the session)
    document.getElementById("name").value = "<?php echo $_SESSION['name']; ?>";
    document.getElementById("surname").value = "<?php echo $_SESSION['surname']; ?>";
    document.getElementById("username").value = "<?php echo $_SESSION['username']; ?>";
    document.getElementById("email").value = "<?php echo $_SESSION['email']; ?>";

    // didable fields
    document.getElementById("name").disabled = true;
    document.getElementById("surname").disabled = true;
    document.getElementById("username").disabled = true;
    document.getElementById("email").disabled = true;

    // show modify button
    document.getElementById("edit-button").style.display = "block";
    document.getElementById("save-button").style.display = "none";
    document.getElementById("cancel-button").style.display = "none";
});
