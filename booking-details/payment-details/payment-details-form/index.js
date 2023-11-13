window.onload = () => {
    let userEmail = localStorage.getItem("userEmail");
    let email = document.getElementById('buyer-email');
    if (userEmail) {
        email.value = atob(userEmail);
        email.readOnly = true;
    }

    let userName = localStorage.getItem("userName");
    let name = document.getElementById('buyer-name');
    if (userName) {
        name.value = atob(userName);
        name.readOnly = true;
    }

}