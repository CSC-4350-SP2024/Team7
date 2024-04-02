// Appending to existing validation.js for contact form validation
function validateContactForm(event) {
    event.preventDefault();
    
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const subject = document.getElementById("subject").value.trim();
    const message = document.getElementById("message").value.trim();
    var isValid = true;

    // Clear any previous errors
    // Add your own error display elements and handle them here

    if (name === "") {
        isValid = false;
        // Handle error
    }

    if (!isEmail(email)) {
        isValid = false;
        // Handle error
    }

    if (subject === "") {
        isValid = false;
        // Handle error
    }

    if (message === "") {
        isValid = false;
        // Handle error
    }

    if(isValid) {
        document.getElementById("contactForm").submit();
    }

    return isValid;
}
