const header = document.querySelector("header");
const popupBackgrund = document.querySelector(".popup-background");
const menuPopup = document.querySelector('.header-mid');
const massagePopup = document.querySelector("#massage-popup");
const notificationPopup = document.querySelector("#notification-popup");
const loginPopup = document.querySelector("#login-popup");

let openedPopup;
let fullScreenedPopup = false;

header.addEventListener('click', (e) => {
    if(e.target.closest('button')){
        popupBackgrund.classList.add('active');
        switch(e.target.closest('button').id){
            case 'menu-button' :
                menuPopup.classList.add('active');
                openedPopup = menuPopup;
                break;
            case 'massages-button' :
                massagePopup.classList.add('active');
                openedPopup = massagePopup;
                break;
            case 'notification-button' :
                notificationPopup.classList.add('active');
                openedPopup = notificationPopup;
                break;
            case 'login-button' :
                loginPopup.classList.add('active');
                openedPopup = loginPopup;
                break;
        }
    }
})

function closePopup(){
    popupBackgrund.classList.remove("active");
    openedPopup.classList.remove('active');
    if(fullScreenedPopup){
        maximize();
    }
}

popupBackgrund.addEventListener("click", closePopup);

const maximize = () =>{
    if(fullScreenedPopup){
        openedPopup.classList.remove('full-screen');
        fullScreenedPopup = false;
    }else{
        openedPopup.classList.add('full-screen');
        fullScreenedPopup = true;
    }
}


// wishlisting
function toggleWishlist(e){
    if(e.classList.contains('wishlisted')){
        e.children[0].className = "fa-regular fa-heart";
        e.classList.remove('wishlisted');
    } else {
        e.children[0].className = "fa-solid fa-heart";
        e.classList.add('wishlisted');
    }
}