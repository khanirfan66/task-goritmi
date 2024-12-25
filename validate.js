document.getElementById("registrationForm").addEventListener("submit", function (event) {
    const form = event.target;
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    // Check if passwords match
    if (password !== confirmPassword) {
        document.getElementById("confirmPassword").setCustomValidity("Passwords do not match.");
    } else {
        document.getElementById("confirmPassword").setCustomValidity("");
    }

    if (!form.checkValidity()) {
        event.preventDefault();
        event.stopPropagation();
    }

    form.classList.add("was-validated");
});
