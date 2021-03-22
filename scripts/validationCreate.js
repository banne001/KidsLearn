/**
 * Blezyl Santos and Sarah Mehri
 * Kids Learn Website
 * Version 1.0
 * Validation for Creation form. Validates name and type.
 */
//form
let formSignIn = document.getElementById("create");
formSignIn.onsubmit = validate;

/**
 * Clears the form with any errors
 */
function clearErrors(){
    let errors = document.getElementsByClassName("text-danger");
    for (let i = 0; i < errors.length; i++){
        errors[i].classList.add("d-none");
    }
}

function validate(){
    clearErrors();
    let isValid = true;

    let type =  document.getElementsByName("type");
    let count = 0;
    for(let i=0; i<type.length; i++){
        if(type[i].checked){
            count++;
        }
    }
    if(count ==0){
        document.getElementById("errType").classList.remove("d-none");
        isValid = false;
    }

    let name = document.getElementById("oname").value;
    if(name === "" || (!/^[a-zA-Z]+$/.test(name))){
        document.getElementById("errName").classList.remove("d-none");
        isValid = false;
    }

    return isValid;
}