// log in pop to sign up pop up 
const loginPopupCardBody = document.querySelector('.log-in-popup-card-body');
const popUpHeading = document.querySelector('.popup-heading');
const signUpSection = document.querySelector('.signUp-section');

function slideToSignin(){
    loginPopupCardBody.style.transform = "translateX(-350px)";
    popUpHeading.innerHTML = "Sign Up";
    signUpSection.style.display = 'flex';
}
function slideTologin(){
    loginPopupCardBody.style.transform = "translateX(0px)";
    popUpHeading.innerHTML = "Log In";
    signUpSection.style.display = 'none';
}



// password visibility

function toggleVisibility(e){
    if(e.classList.contains('fa-eye-slash')){
        e.className = 'fa-solid fa-eye';
        e.previousElementSibling.type = 'text';
    }else{
        e.className = "fa-solid fa-eye-slash";
        e.previousElementSibling.type = 'password';
    }
}