$(".preloader").fadeOut();

function validateLoginForm(event) {
    event.preventDefault();
    let email = document.forms.loginForm.email.value;
    let regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g;
    if (!regEmail.test(email)) {
        alert(`Please enter a valid e-mail address`);
        return false;
    }
    document.forms.loginForm.submit();
    return true;
}