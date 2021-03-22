/**
 * Blezyl Santos and Sarah Mehri
 * Kids Learn Website
 * Version 1.0
 * Validation for Sign Up form
 */
//form
let formSignUp = document.getElementById("signUp");
formSignUp.onsubmit = validateSignUp;

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
 * Checks Sign up form for any invalidation.
 * @returns {boolean} true if all input is valid, false otherwise
 */
function validateSignUp(){
    clearErrors();
    let isValid = true;

    let username = document.getElementById("username").value;
    let first = document.getElementById("fname").value;
    let last = document.getElementById("lname").value;
    let age = document.getElementById("age").value;
    let grade = document.getElementById("grade").value;
    let cpassword = document.getElementById("cpassword").value;
    let password = document.getElementById("password").value;

    if(username === "" || (!/^[a-zA-Z]+$/.test(username))){
        document.getElementById("errUsername").classList.remove("d-none");
        isValid = false;
    }
    if(first === "" || (!/^[a-zA-Z]+$/.test(first))){
        document.getElementById("errFirst").classList.remove("d-none");
        isValid = false;
    }
    if(last === "" || (!/^[a-zA-Z]+$/.test(last))){
        document.getElementById("errLast").classList.remove("d-none");
        isValid = false;
    }
    if(age === "" || age > 118){
        document.getElementById("errAge").classList.remove("d-none");
        isValid = false;
    }
    if(grade === "" || grade > 12){
        document.getElementById("errGrade").classList.remove("d-none");
        isValid = false;
    }
    if(password === "" || password.length < 8){
        document.getElementById("errPassword").classList.remove("d-none");
        isValid = false;
    }
    if(cpassword === "" || cpassword!==password){
        document.getElementById("errCPassword").classList.remove("d-none");
        isValid = false;
    }

    return isValid;
}
