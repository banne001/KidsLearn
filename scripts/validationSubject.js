/**
 * Blezyl Santos and Sarah Mehri
 * Kids Learn Website
 * Version 1.0
 * Validation for Subject form for proUser
 */
//form
let formSignIn = document.getElementById("pro");
formSignIn.onsubmit = validateSubject;

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
 * Validate the subject for pro user
 * @returns {boolean} true if subject is valid, false otherwise
 */
function validateSubject(){
    clearErrors();

    let subject = document.getElementById("subject").value;
    let subjects = ["math", "english", "science", "history", "business", "social studies", "psychology", "economics", "art", "theater", "music", "language arts", "home economics"];
    if(!subjects.includes(subject)){
        document.getElementById("errSubject").classList.remove("d-none");
        return false;
    }
    return true;
}