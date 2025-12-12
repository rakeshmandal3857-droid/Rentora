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


// showing error on not matching passwords
const tenantCreatePass = document.querySelector('#tenant-create-pass');
const tenantConfirmPass = document.querySelector('#tenant-confirm-pass');

function checkPasswordMatch() {
    if (tenantCreatePass.value !== tenantConfirmPass.value) {
        tenantConfirmPass.parentElement.classList.add('error');
    } else {
        tenantConfirmPass.parentElement.classList.remove('error');
    }
}
if(tenantConfirmPass){
    tenantConfirmPass.addEventListener('input', checkPasswordMatch);
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