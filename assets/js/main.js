const header = document.querySelector("header");
const popupBackgrund = document.querySelector(".popup-background");
const menuPopup = document.querySelector('.header-mid');
const massagePopup = document.querySelector("#massage-popup");
const notificationPopup = document.querySelector("#notification-popup");
const loginPopup = document.querySelector("#login-popup");
const ownerLoginPopup =document.querySelector('#owner-login-popup')

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

function showOwnerLoginPopup(){
    ownerLoginPopup.classList.add('active');
    openedPopup = ownerLoginPopup;
}

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

//nav activation (show only)
let prevnav;
if(menuPopup){
    prevnav = menuPopup.querySelector('.active');
    
    menuPopup.addEventListener('click', (e)=>{
        if(e.target.tagName === "A"){ 
            e.preventDefault();          
    
            prevnav.classList.remove('active');
            e.target.classList.add('active');
            prevnav = e.target;
    
            window.location.href = e.target.href;
        }
    });
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

function showerror(id){
    const element = document.querySelector('[name="tenant-email"]');
    element.classList.add('error');
}

//toast notification
const toastNotification = document.querySelector(".toast-notification");

function showToastNotification(type, massege){
    setTimeout(()=>{
        switch (type){
            case "success":
                toastNotification.innerHTML =`
                <i class="fa-solid fa-circle-check"></i>
                <div class="massege">Success: ${massege}</div>
                <i class="fa-solid fa-xmark" onclick="closeToastNotification()"></i>`
                toastNotification.classList.add('success');
                break;
            case 'error':
                toastNotification.innerHTML =`
                <i class="fa-solid fa-circle-check"></i>
                <div class="massege">Error: ${massege}</div>
                <i class="fa-solid fa-xmark" onclick="closeToastNotification()"></i>`
                toastNotification.classList.add('danger');
                break;
            case 'warning':
                toastNotification.innerHTML =`
                <i class="fa-solid fa-circle-check"></i>
                <div class="massege">Warning: ${massege}</div>
                <i class="fa-solid fa-xmark" onclick="closeToastNotification()"></i>`
                toastNotification.classList.add('warning');
                break;
        }
        toastNotification.classList.add('active');
    
        setTimeout(closeToastNotification,3500);
    },100);
}

function closeToastNotification(){
    toastNotification.className = "toast-notification"
}



//fetching the city table data from php code and dynamicaly showing the cities and localities; 
const selectCitiesDropdown = document.querySelector('.add-accomodation-cities');
const localitiesDropdown = document.querySelector('.select-localities');
const locationSerchbar = document.querySelector('#location');

let citiesTable ;
fetch('../../pages/owner/getCities.php')
.then(res => res.json())
.then(data =>{
    citiesTable = data;
    if(selectCitiesDropdown){
        showLocalities(data[0].city_id);
    }
    data.forEach(city =>{
        if(selectCitiesDropdown){
            const option = document.createElement('option');
            option.id= city.city_id;
            option.value = city.city_name;
            option.textContent = city.city_name;
            selectCitiesDropdown.appendChild(option);
        }
    })
});

if(selectCitiesDropdown){
    selectCitiesDropdown.addEventListener('change',(e)=>{
        const selectedOption = e.target.options[e.target.selectedIndex];
        showLocalities(selectedOption.id);
        return;
    })
}

if(locationSerchbar){
    locationSerchbar.addEventListener('input', ()=>{
        citiesTable.forEach(city =>{
            if(city.city_name == locationSerchbar.value.toUpperCase()){
                showLocalities(city.city_id);
                return;
            }
        })
    })
}

function showLocalities(id){
    localitiesDropdown.innerHTML = '';
   citiesTable.forEach(city=>{
    if(city.city_id == id){
        const str = city["locality"];

        const localities = str.split(',').map(item =>item.trim());
        localities.forEach(locality =>{
            const option = document.createElement('option');
            option.value = locality;
            option.textContent = locality;
            localitiesDropdown.appendChild(option);
        })
    }
   })
}


//owner-side nav showing and closing
const ownerNav = document.querySelector(".owner-nav");
function showSideNav(){
    popupBackgrund.classList.add('active');
    ownerNav.classList.add('active');
    openedPopup = ownerNav;
}

const reviewPopup = document.querySelector('#review-popup');
function showReviewForm(){
    popupBackgrund.classList.add('active');
    reviewPopup.classList.add('active');
    openedPopup = reviewPopup;
}

const deleteConfirmPopup = document.querySelector('#delete-confirmation-popup');
// const deleteConfirmbutton = document.querySelector('#delete-confirmation-button');
// if(deleteConfirmPopup){
//     deleteConfirmbutton.addEventListener('click', showDeletePopup)
// }
function showDeletePopup(table, id){
    popupBackgrund.classList.add('active');
    deleteConfirmPopup.classList.add('active');
    openedPopup = deleteConfirmPopup;
    updateDeletePopup(table,id);
}

function updateDeletePopup(table,id){
    deleteConfirmPopup.innerHTML =`
        <i class="fa-solid fa-triangle-exclamation"></i>
        <div class="heading">Are you sure?</div>
        <p>This action will delete all your informations about this accomodation, You won't be able to revert it.</p>
        <div class="buttons">
         <button onclick="closePopup()" class="btn-primary">Cancel</button>
         <form action="view-accomodation.php" method="post">
            <button class="btn-primary delete-accomodation" name="confirmed-delete" value = "${table}-${id}">Confirm</button>
         </form>
        </div>
    ` 
}

const editAccomodationPopup = document.querySelector('#edit-accomodation-popup')
function showEditAccomodationPopup(id){
    popupBackgrund.classList.add('active');
    editAccomodationPopup.classList.add('active');
    openedPopup = editAccomodationPopup;
    updateEditAccomodationpopup(id);
}
