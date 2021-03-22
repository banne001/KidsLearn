/**
 * Blezyl Santos and Sarah Mehri
 * Kids Learn Website
 * Version 1.0
 * Validation for Sign In form
 */
//form
let formSignIn = document.getElementById("signIn");
formSignIn.onsubmit = validateSignIn;

/**
 * Clears the form with any errors
 */
function clearErrors(){
    let errors = document.getElementsByClassName("text-danger");
    for (let i = 0; i < errors.length; i++){
        errors[i].classList.add("d-none");
    }
}

/**
 * Checks Sign in form for any invalidation.
 * @returns {boolean} true if all input is valid, false otherwise
 */
function validateSignIn(){
    clearErrors();
    let isValid = true;

    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    if(username === "" || (!/^[a-zA-Z]+$/.test(username))){
        document.getElementById("errUsername").classList.remove("d-none");
        isValid = false;
    }

    if(password === "" || password.length < 8){
        document.getElementById("errPassword").classList.remove("d-none");
        isValid = false;
    }
    return isValid;
}
