// Login form validation
document.addEventListener('DOMContentLoaded', function() {
    const loginForm = document.getElementById('loginForm');
    const emailInput = document.querySelector('input[name="email"]');
    const passwordInput = document.querySelector('input[name="password"]');
    const togglePassword = document.querySelector('.toggle-password');

    // Create error message elements
    const emailError = createErrorElement(emailInput);
    const passwordError = createErrorElement(passwordInput);

    // Password visibility toggle
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
    });
    

    // Real-time email validation
    emailInput.addEventListener('input', function() {
        validateEmail(this, emailError);
    });

    // Real-time password validation
    passwordInput.addEventListener('input', function() {
        validatePassword(this, passwordError);
    });

    // Form submission
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault();

        // Clear previous errors
        hideError(emailError);
        hideError(passwordError);

        // Validate both fields
        const isEmailValid = validateEmail(emailInput, emailError);
        const isPasswordValid = validatePassword(passwordInput, passwordError);

        // If both valid, submit form
        if (isEmailValid && isPasswordValid) {
            this.submit();
        }
    });

    // Helper functions
    function createErrorElement(input) {
        const errorDiv = document.createElement('div');
        errorDiv.className = 'error-message text-danger mt-1';
        input.parentElement.appendChild(errorDiv);
        return errorDiv;
    }

    function validateEmail(input, errorElement) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const isValid = emailPattern.test(input.value.trim());
        
        if (!input.value.trim()) {
            showError(input, errorElement, 'Email is required');
            return false;
        }
        
        if (!isValid) {
            showError(input, errorElement, 'Please enter a valid email address');
            return false;
        }
        
        hideError(errorElement);
        return true;
    }

    // function validatePassword(input, errorElement) {
    //     if (!input.value.trim()) {
    //         showError(input, errorElement, 'Password is required');
    //         return false;
    //     }
        
    //     if (input.value.length < 6) {
    //         showError(input, errorElement, 'Password must be at least 6 characters long');
    //         return false;
    //     }
        
    //     hideError(errorElement);
    //     return true;
    // }

    function validatePassword(input, errorElement) {
        if (!input.value.trim()) {
            showError(input, errorElement, 'Password is required');
            return false;
        }
        
        if (input.value.length === 6) {
            input.classList.remove('is-invalid');
            input.style.borderColor = 'blue';
            hideError(errorElement);
            return true;
        }
    
        if (input.value.length < 6) {
            showError(input, errorElement, 'Password must be at least 6 characters long');
            return false;
        }
        
        // Reset border color if password length is greater than 6
        input.style.borderColor = '';
        hideError(errorElement);
        return true;
    }
    

    function showError(input, errorElement, message) {
        input.classList.add('is-invalid');
        errorElement.textContent = message;
        errorElement.style.display = 'block';
        addShakeAnimation(errorElement);
    }

    function hideError(errorElement) {
        const input = errorElement.previousElementSibling;
        input.classList.remove('is-invalid');
        errorElement.style.display = 'none';
    }

    function addShakeAnimation(element) {
        element.classList.add('shake');
        setTimeout(() => element.classList.remove('shake'), 500);
    }
});