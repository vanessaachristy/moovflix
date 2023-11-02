function validateInput() {
    let email = document.getElementById("buyer-email");
    let name = document.getElementById("buyer-name");

    if (!validateEmail(email.value)) {
        alert("Invalid email!");
        return false;
    }
    if (!validateName(name.value)) {
        alert("Invalid name input!");
        return false;
    }
    if (validateEmail(email.value) && validateName(name.value)) {
        return true;
    }
}
function validateName(name) {
    // Define a regular expression for a basic name validation
    // This example allows only letters, spaces, hyphens, and apostrophes in names
    var namePattern = /^[A-Za-z\s'-]+$/;

    return namePattern.test(name);
}

function validateEmail(email) {
    // Use a regular expression to validate the email address
    var pattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    return pattern.test(email);
}