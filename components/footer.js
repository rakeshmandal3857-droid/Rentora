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
const tenantCreatePass = document.querySelector('.tenant-create-pass');
const tenantConfirmPass = document.querySelector('.tenant-confirm-pass');

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

const ProfilePopupContainer = document.querySelector("#Profile-popup-container");
if(ProfilePopupContainer){
    const profileSlide = ProfilePopupContainer.querySelector('.profile-slide');
    function slidePofilePopup(type){
        profileSlide.style.display = 'block';
        updateSlide(type);
        ProfilePopupContainer.scrollBy({
            left: 320,
            behavior: 'smooth'
        });
    }
    
    const changePersonalDataSlide = profileSlide.querySelector('#changePersonalDataSlide');
    const changePassowrdSlide = profileSlide.querySelector('#changePasswordSlide');
    const wishlistSlide = profileSlide.querySelector('#wishlistSlide');
    let prevslide = '';
    function updateSlide(type){
        switch(type){
            case "editPesonalData" :
                changePersonalDataSlide.style.display = 'block';
                prevslide = "editPesonalData";
                break;
            case "changePassowrd" :
                changePassowrdSlide.style.display = 'block';
                prevslide = "changePassowrd";
                break;
            case "wishlist" :
                wishlistSlide.style.display = 'block';
                prevslide = "wishlist";
                break;
        }
    }
    
    function slideBackProfilePopup(){
        profileSlide.style.display = 'none';
        ProfilePopupContainer.scrollTo({
            left: 0,
            behavior: 'smooth'
        });
        if(prevslide === 'editPesonalData'){
            changePersonalDataSlide.style.display = 'none';
        }else if(prevslide === 'changePassowrd'){
            changePassowrdSlide.style.display = 'none';
        }else if(prevslide === 'wishlist'){
            wishlistSlide.style.display = 'none';
        }
    }
}