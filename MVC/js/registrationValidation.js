document.addEventListener("DOMContentLoaded", function() {
    const form = document.getElementById('registrationForm');
    const nameField = document.getElementById('name');
    const emailField = document.getElementById('email');
    const passwordField = document.getElementById('password');
    const roleField = document.getElementById('role');
    const nameError = document.getElementById('nameError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const roleError = document.getElementById('roleError');

    form.addEventListener('submit', function(event) {
        let errors = [];
        let hasError = false;

        // Clear previous error messages
        nameError.style.display = 'none';
        emailError.style.display = 'none';
        passwordError.style.display = 'none';
        roleError.style.display = 'none';

        // Validate Name (only letters and spaces)
        if (!nameField.value.trim().match(/^[a-zA-Z]+(\.[a-zA-Z]+)*(\s[a-zA-Z]+(\.[a-zA-Z]+)*)*$/)) {
            nameError.style.display = 'block';
            nameError.innerHTML = 'Name should only contain letters, spaces, and dots.';
            hasError = true;
        }

        // Validate Email
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailField.value.trim().match(emailPattern)) {
            emailError.style.display = 'block';
            emailError.innerHTML = 'Please enter a valid email address.';
            hasError = true;
        }

        // Validate Password (at least 6 characters, letters and numbers)
        if (passwordField.value.length < 6 || !passwordField.value.match(/[A-Za-z]/) || !passwordField.value.match(/[0-9]/)) {
            passwordError.style.display = 'block';
            passwordError.innerHTML = 'Password should be at least 6 characters long and contain both letters and numbers.';
            hasError = true;
        }

        // Validate Role
        if (!roleField.value) {
            roleError.style.display = 'block';
            roleError.innerHTML = 'Please select a role.';
            hasError = true;
        }

        // If there are errors, show an alert
        if (hasError) {
            event.preventDefault();  // Prevent form submission
            alert("There are errors in the form. Please fix them and try again.");
        }
    });
});
