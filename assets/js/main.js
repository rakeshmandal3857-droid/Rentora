const header = document.querySelector("header");
const popupBackgrund = document.querySelector(".popup-background");
const overlay = document.querySelector(".overlay");
const menuPopup = document.querySelector('.header-mid');
const massagePopup = document.querySelector("#massage-popup");
const notificationPopup = document.querySelector("#notification-popup");
const loginPopup = document.querySelector("#login-popup");
const ownerLoginPopup =document.querySelector('#owner-login-popup')

let openedPopup;
let fullScreenedPopup = false;

header.addEventListener('click', (e) => {
    if(e.target.closest('button')){
        switch(e.target.closest('button').id){
            case 'menu-button' :
                menuPopup.classList.add('active');
                overlay.classList.add('active');
                openedPopup = menuPopup;
                break;
                case 'massages-button' :
                popupBackgrund.classList.add('active');
                massagePopup.classList.add('active');
                openedPopup = massagePopup;
                break;
                case 'notification-button' :
                popupBackgrund.classList.add('active');
                notificationPopup.classList.add('active');
                openedPopup = notificationPopup;
                break;
                case 'login-button' :
                popupBackgrund.classList.add('active');
                loginPopup.classList.add('active');
                openedPopup = loginPopup;
                break;
        }
    }
})

const profilePopup = document.querySelector('#profile-popup');
function showPofilePopup(){
    profilePopup.classList.add('active');
    popupBackgrund.classList.add('active');
    openedPopup = profilePopup;
}

function showOwnerLoginPopup(){
    popupBackgrund.classList.add('active');
    ownerLoginPopup.classList.add('active');
    openedPopup = ownerLoginPopup;
}

function closePopup(){
    popupBackgrund.classList.remove("active");
    if(openedPopup){openedPopup.classList.remove('active');}
    if( overlay && overlay.classList.contains('active')){
        overlay.classList.remove('active');
    }
    if(fullScreenedPopup){
        maximize();
    }
}

popupBackgrund.addEventListener("click", closePopup);
if(overlay){
    overlay.addEventListener('click', closePopup);
}

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

if (menuPopup) {
    const links = menuPopup.querySelectorAll('a');

    // 🔹 REMOVE ALL ACTIVE FIRST
    links.forEach(a => a.classList.remove('active'));

    // 🔹 RESTORE FROM localStorage
    const savedId = localStorage.getItem('activeNav');
    if (savedId) {
        const savedEl = document.getElementById(savedId);
        if (savedEl) {
            savedEl.classList.add('active');
            prevnav = savedEl;
        }
    }

    // 🔹 FALLBACK
    if (!prevnav) {
        prevnav = menuPopup.querySelector('.active');
    }

    // 🔹 NAV CLICK HANDLER
    menuPopup.addEventListener('click', (e) => {
        const link = e.target.closest('a');
        if (!link) return;

        e.preventDefault();

        if (prevnav) prevnav.classList.remove('active');

        link.classList.add('active');
        prevnav = link;

        if (link.id) {
            localStorage.setItem('activeNav', link.id);
        }

        window.location.href = link.href;
    });

    // 🔹 LOGO CLICK FIX
    const logo = document.querySelector('.logo');
    const homeLink = document.querySelector('#home');

    if (logo && homeLink) {
        logo.addEventListener('click', () => {
            links.forEach(a => a.classList.remove('active'));

            homeLink.classList.add('active');
            prevnav = homeLink;

            // 🔥 CRITICAL FIX
            localStorage.setItem('activeNav', 'home');

            window.location.href = homeLink.href;
        });
    }
}
// // wishlisting
// const popupWishlistUl = document.querySelector('.featured-properties-wrapper-wishlist-popup');
// function toggleWishlist(e){
//     if(e.classList.contains('wishlisted')){
//         e.children[0].className = "fa-regular fa-heart";
//         e.classList.remove('wishlisted');
//         // id = e.closest('li').id;
//         // removeFromWishlist(id);
//     } else {
//         e.children[0].className = "fa-solid fa-heart";
//         e.classList.add('wishlisted');
//         // let li = e.closest('li').cloneNode(true);
//         // li.id = `accomodation-${li.id}`;
//         // popupWishlistUl.appendChild(li);
//     }
// }


// // function removeFromWishlist(id){
// //     console.log('called');
// //     const li = popupWishlistUl.querySelector(`#accomodation-s${id}`);
// //     console.log(li);
// //     if(li){
// //         li.remove();
// //     }
// // }

// // function showerror(){
// //     const element = document.querySelector(`#${id}`);
// //     element.classList.add('error');
// // }

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
    
        setTimeout(closeToastNotification,20000);
    }, 100)
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
    if(locationSerchbar && locationSerchbar.value !== ""){
        validateLocation(locationSerchbar.value);
    }
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
    locationSerchbar.closest('form').addEventListener('submit',(e)=>{
        let matched = false;
        citiesTable.forEach(city =>{
            if(city.city_name == locationSerchbar.value.toUpperCase()){
                matched = true;
            }
        })
        if(!matched){
            e.preventDefault();
            showToastNotification('error', 'Please enter a valid location.');
        }
    })

    locationSerchbar.addEventListener('input', ()=>{
        validateLocation(locationSerchbar.value)
    })
}
function validateLocation(location){
    let matched = false;
    citiesTable.forEach(city =>{
        if(city.city_name == location.toUpperCase()){
            matched = true;
            showLocalities(city.city_id);
        }
    })
    if(matched){
        locationSerchbar.parentElement.classList.remove('error');
    }else{
        locationSerchbar.parentElement.classList.add('error');
    }
    return matched;
}

function showLocalities(id){
    localitiesDropdown.innerHTML = '';
    const allOption = document.createElement('option');
    allOption.value = 'ALL';
    allOption.textContent = 'All'
    localitiesDropdown.appendChild(allOption);
    
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
   if(typeof PRESELECT_LOCALITY !== 'undefined' && PRESELECT_LOCALITY){
    localitiesDropdown.value = PRESELECT_LOCALITY;
   }
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

const reviewAccomodationPopup = document.querySelector('#review-accomodation-popup');
function showReviewAccomodationForm(){
    popupBackgrund.classList.add('active');
    reviewAccomodationPopup.classList.add('active');
    openedPopup = reviewAccomodationPopup;
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
