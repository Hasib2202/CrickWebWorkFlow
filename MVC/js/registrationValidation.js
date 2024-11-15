document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');
    const nameField = document.getElementById('name');
    const emailField = document.getElementById('email');
    const passwordField = document.getElementById('password');
    const roleField = document.getElementById('role');
    
    const nameError = document.getElementById('nameError');
    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');
    const roleError = document.getElementById('roleError');

    // Restrict invalid characters in the name field
    nameField.addEventListener('keypress', function(e) {
        const char = String.fromCharCode(e.keyCode || e.which);
        const valid = /[A-Za-z\s.]/.test(char);
        if (!valid) {
            e.preventDefault();
        }
    });

    // Remove invalid characters if pasted
    nameField.addEventListener('input', function(e) {
        this.value = this.value.replace(/[^A-Za-z\s.]/g, '');
    });

    form.addEventListener('submit', function(event) {
        let hasError = false;
        
        [nameError, emailError, passwordError, roleError].forEach(error => {
            error.style.display = 'none';
            error.textContent = '';
        });

        // Name validation
        const nameValue = nameField.value.trim();
        // Allow names with letters, spaces, and dots, with dots allowed at any position
        if (!nameValue || !/^[A-Za-z.\s]+$/.test(nameValue)) {
            nameError.textContent = 'Name can only contain letters, spaces, and dots';
            nameError.style.display = 'block';
            hasError = true;
        }

        // Email validation
        const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailPattern.test(emailField.value.trim())) {
            emailError.textContent = 'Please enter a valid email address';
            emailError.style.display = 'block';
            hasError = true;
        }

        // Password validation
        if (passwordField.value.length < 6 || 
            !/[A-Za-z]/.test(passwordField.value) || 
            !/[0-9]/.test(passwordField.value)) {
            passwordError.textContent = 'Password must be at least 6 characters and contain both letters and numbers';
            passwordError.style.display = 'block';
            hasError = true;
        }

        // Role validation
        if (!roleField.value) {
            roleError.textContent = 'Please select a role';
            roleError.style.display = 'block';
            hasError = true;
        }

        if (hasError) {
            event.preventDefault();
        }
    });
});
