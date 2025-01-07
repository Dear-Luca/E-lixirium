document.querySelector("nav a.dropdown-toggle").addEventListener('click', function (event) {
    const dropdownMenu = document.querySelector("nav ul.dropdown-menu");
    // Check if dropdown is expanded
    if (!dropdownMenu.classList.contains('show')) {
        // Redirect to all products page
        window.location.href = "?page=products";
    }
});

// document.getElementById("edit-button").addEventListener("click", function () {
//     // enable fields
//     document.getElementById("name").disabled = false;
//     document.getElementById("surname").disabled = false;
//     document.getElementById("username").disabled = false;
//     document.getElementById("email").disabled = false;
//     document.getElementById("birthday").disabled = false;
//     document.getElementById("card_number").disabled = false;
//     document.getElementById("password").disabled = false;
//     document.getElementById("confirm-password-container").style.display = "block";

//     // show buttons save and cancel
//     document.getElementById("save-button").style.display = "block";
//     document.getElementById("cancel-button").style.display = "block";
//     document.getElementById("edit-button").style.display = "none";
// });

// document.getElementById("cancel-button").addEventListener("click", function () {
//     // show current values (of the session)
//     document.getElementById("name").value = document.getElementById("name").getAttribute("data-original-value");
//     document.getElementById("surname").value = document.getElementById("surname").getAttribute("data-original-value");
//     document.getElementById("username").value = document.getElementById("username").getAttribute("data-original-value");
//     document.getElementById("email").value = document.getElementById("email").getAttribute("data-original-value");
//     document.getElementById("birthday").value = document.getElementById("birthday").getAttribute("data-original-value");
//     document.getElementById("card_number").value = document.getElementById("card_number").getAttribute("data-original-value");
//     document.getElementById("password").value = document.getElementById("password").getAttribute("data-original-value");
//     // document.getElementById("confirm-password").value = document.getElementById("confirm-password").getAttribute("data-original-value");
//     document.getElementById("confirm-password-container").style.display = "none";
    
//     // didable fields
//     document.getElementById("name").disabled = true;
//     document.getElementById("surname").disabled = true;
//     document.getElementById("username").disabled = true;
//     document.getElementById("email").disabled = true;
//     document.getElementById("birthday").disabled = true;
//     document.getElementById("card_number").disabled = true;

//     // show modify button
//     document.getElementById("edit-button").style.display = "block";
//     document.getElementById("save-button").style.display = "none";
//     document.getElementById("cancel-button").style.display = "none";
// });
document.querySelector(".btn-primary").addEventListener("click", function () {
    // enable fields
    document.querySelectorAll("input[type='text'], input[type='email'], input[type='date'], input[type='password']").forEach(input => {
        input.disabled = false;
    });
    
    // Seleziona il contenitore per la conferma password senza ID
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
    
    // Seleziona il contenitore per la conferma password senza ID
    document.querySelector("div.mb-3:nth-child(8)").style.display = "none";
    
    // disable fields
    document.querySelectorAll("input[type='text'], input[type='email'], input[type='date'], input[type='password']").forEach(input => {
        input.disabled = true;
    });

    // show modify button
    document.querySelector(".btn-primary").style.display = "block";
    document.querySelector(".btn-success").style.display = "none";
    document.querySelector(".btn-danger").style.display = "none";
});