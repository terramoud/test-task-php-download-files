$(".preloader").fadeOut();

function validateLoginForm(event) {
    event.preventDefault();
    let email = document.forms.loginForm.email.value;
    let pass = document.forms.loginForm.password.value;
    let regEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/g;
    let patternPass = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{8,}$/g;

    // if (!regEmail.test(email)) {
    //     alert(`Please enter a valid e-mail address`);
    //     return false;
    // }

    // if (!patternPass.test(pass)) {
    //     alert(`Please enter your password. It must contain at least one number and one uppercase and lowercase letter, and contain between 8 and 32 characters. Only English letters and numbers are allowed`);
    //     return false;
    // }
    document.forms.loginForm.submit();
    return true;
}