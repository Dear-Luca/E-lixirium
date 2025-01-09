document.querySelector("nav a.dropdown-toggle").addEventListener('click', function (event) {
    const dropdownMenu = document.querySelector("nav ul.dropdown-menu");
    // Check if dropdown is expanded
    if (!dropdownMenu.classList.contains('show')) {
        // Redirect to all products page
        window.location.href = "?page=products";
    }
});

document.querySelector("select#id_product").addEventListener("change", function () {
    location.href = 'index.php?page=product&id=' + this.value;
});

document.querySelector(".btn-primary").addEventListener("click", function () {
    // enable fields
    document.querySelectorAll("input[type='text'], input[type='email'], input[type='date'], input[type='password']").forEach(input => {
        input.disabled = false;
    });

    document.querySelector("div.mb-3:nth-child(8)").style.display = "block";

    // show buttons save and cancel
    document.querySelector(".btn-success").style.display = "block";
    document.querySelector(".btn-danger").style.display = "block";
    document.querySelector(".btn-primary").style.display = "none";
});

document.querySelector(".btn-danger").addEventListener("click", function () {
    // show current values (of the session)
    document.querySelectorAll("input[type='text'], input[type='email'], input[type='date'], input[type='password']").forEach(input => {
        input.value = input.getAttribute("data-original-value");
    });

    document.querySelector("div.mb-3:nth-child(8)").style.display = "none";

    document.querySelectorAll("input[type='text'], input[type='email'], input[type='date'], input[type='password']").forEach(input => {
        input.disabled = true;
    });

    // show modify button
    document.querySelector(".btn-primary").style.display = "block";
    document.querySelector(".btn-success").style.display = "none";
    document.querySelector(".btn-danger").style.display = "none";
});
