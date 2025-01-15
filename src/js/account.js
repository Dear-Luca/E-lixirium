document.querySelector(".btn-primary").addEventListener("click", function () {
    // enable fields
    document.querySelectorAll("input[type='text'], input[type='email'], input[type='date']").forEach(input => {
        input.disabled = false;
    });

    document.querySelector("section.col-12.col-md-9 .row > div:nth-of-type(3) input").disabled = true;

    document.querySelector("div section form div:nth-child(8)").style.display = "block";
    document.querySelector("div section form div:nth-child(7)").style.display = "block";
    // show buttons save and cancel
    document.querySelector(".btn-success").style.display = "block";
    document.querySelector(".btn-danger").style.display = "block";
    document.querySelector(".btn-primary").style.display = "none";
});

document.querySelector(".btn-danger").addEventListener("click", function () {
    //reset password to type password
    document.querySelector("div.container div.row section.col-12 form div div:nth-child(7) input").type = "password";
    document.querySelector("div.container div.row section.col-12 form div div:nth-child(8) input").type = "password";
    document.querySelector("div.container div.row section.col-12 form div div:nth-child(7) input").value = "";
    document.querySelector("div.container div.row section.col-12 form div div:nth-child(8) input").value = "";
    // show current values (of the session)
    document.querySelectorAll("input[type='text'], input[type='email'], input[type='date']").forEach(input => {
        input.value = input.getAttribute("data-original-value");
    });

    document.querySelector("div section form div:nth-child(7)").style.display = "none";
    document.querySelector("div section form div:nth-child(8)").style.display = "none";


    document.querySelectorAll("input[type='text'], input[type='email'], input[type='date']").forEach(input => {
        input.disabled = true;
    });

    // show modify button
    document.querySelector(".btn-primary").style.display = "block";
    document.querySelector(".btn-success").style.display = "none";
    document.querySelector(".btn-danger").style.display = "none";
});

function togglePasswordVisibility(passwordSelector, imageSelector) {
    const password = document.querySelector(passwordSelector);
    const image = document.querySelector(imageSelector);
    const currentUrl = window.location.href;
    const baseUrl = currentUrl.split('?')[0];

    if (password.type === "password") {
        password.type = "text";
        const newUrl = baseUrl + "upload/open-eye.svg";
        image.src = newUrl;
        image.alt = "show password";
    } else {
        password.type = "password";
        const newUrl = baseUrl + "upload/closed-eye.svg";
        image.src = newUrl;
        image.alt = "hide password";
    }
}

document.querySelector("div.container div.row section.col-12 form div div:nth-child(7) button").addEventListener('click', function () {
    togglePasswordVisibility("div.container div.row section.col-12 form div div:nth-child(7) input", "div.container div.row div.col-12.col-md-6 div.card button img:nth-child(1)");

});

document.querySelector("div.container div.row section.col-12 form div div:nth-child(8) button").addEventListener('click', function () {
    togglePasswordVisibility("div.container div.row section.col-12 form div div:nth-child(8) input", "div.container div.row div.col-12.col-md-6 div.card button img:nth-child(2)");

});

