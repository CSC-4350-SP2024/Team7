function validateForm(event) {
    event.preventDefault(); 
    
    const username = document.getElementById("username").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const confirmPassword = document.getElementById("confirmPassword").value.trim();
    var isValid = true;

    document.getElementById('usernameErr').textContent = '';
    document.getElementById('emailErr').textContent = '';
    document.getElementById('passwordErr').textContent = '';
    document.getElementById('confirmPassErr').textContent = '';

    if (username.length < 5 || username.length > 10) {
        isValid = false;
        document.getElementById('usernameErr').textContent = 'Username must be between 5 and 10 characters.';
    }

    if (!isEmail(email)) {
        isValid = false;
        document.getElementById('emailErr').textContent = 'Please enter a valid email address.';
    }

    if (password.length < 5 || password.length > 10) {
        isValid = false;
        document.getElementById("passwordErr").textContent = 'Password must be between 5 and 10 characters.';
    } else if (password === username) {
        isValid = false;
        document.getElementById("passwordErr").textContent = 'Password must not be the same as the username.';
    }

    if (confirmPassword !== password) {
        isValid = false;
        document.getElementById("confirmPassErr").textContent = 'Passwords do not match.';
    }

    return isValid;
}

function isEmail(email) {
    return /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{3,}))$/.test(email);
}
