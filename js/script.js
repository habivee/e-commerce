document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll("form");

    forms.forEach((form) => {
        form.addEventListener("submit", function (event) {
            let username = form.querySelector("input[name='username']");
            let email = form.querySelector("input[name='email']");
            let password = form.querySelector("input[name='password']");
            let userInput = form.querySelector("input[name='user_input']");

            if (username && username.value.trim().length < 3) {
                alert("Username must be at least 3 characters long.");
                event.preventDefault();
            }

            if (email && !/\S+@\S+\.\S+/.test(email.value)) {
                alert("Enter a valid email address.");
                event.preventDefault();
            }

            if (password && password.value.trim().length < 6) {
                alert("Password must be at least 6 characters long.");
                event.preventDefault();
            }

            if (userInput && userInput.value.trim() === "") {
                alert("Enter your username or email.");
                event.preventDefault();
            }
        });
    });
});

