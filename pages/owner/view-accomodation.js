const accomodationCard = document.querySelector('.accomodation-card');
const accomodationNav = document.querySelector('.accomodation-nav');

accomodationNav.children[0].classList.add('active');
let prev = accomodationNav.children[0];

accomodationNav.addEventListener('click', (e)=>{
    let li = e.target.closest('li');
    if(li){
        li.classList.add('active')
        prev.classList.remove('active');
        prev = li;
        let id = Number(li.dataset.id);
        updateAccomodation(id);
    }
})


//fetch data from db 
const id = Number(accomodationNav.children[0].dataset.ownerid);
let accData;

fetch("get-accomodation.php", {
  method: "POST",
  headers: {
    "Content-Type": "application/x-www-form-urlencoded"
  },
  body: "id=" + id
})
.then(res => res.json())
.then(data => {
    accData = data;
    let accid = accData[0].accommodation_id;
    updateAccomodation(accid)
});

const roomUl = document.querySelector(".rooms-ul");
function updateAccomodation(accid){
    accData.forEach(acc => {
        if(acc.accommodation_id === accid){
            let imagesHTML = '' ;
            for (let i = 1; i <= acc.img_count; i++) {
              imagesHTML += `
                <img src="../../assets/images/demo-room-img.jpg" alt="room image">
              `;
            }
            let sectionHTML =`
                <section id= '${acc.accommodation_id}'>
                    <div class="hero-section">
                        <div class="hero-section-header">
                            <div>
                                <div class="acomodation-name">
                                    ${acc.accommodation_name}
                                    <div class="acomodation-type">${acc.accommodation_type}</div>
                                </div>

                                <a href="${acc.google_map_link}" target="_blank" class="location">
                                    <i class="fa-solid fa-location-dot"></i>
                                    ${acc.address}
                                </a>
                            </div>
                        </div>

                        <div class="img-section">
                            ${imagesHTML}
                        </div>

                        <div class="hero-section-footer">
                            <div class="about">
                                <div class="heading">Accommodation Description & Rules:</div>
                                <div class="desc">
                                    ${acc.accommodation_description}
                                </div>
                            </div>
                        </div>

                        <div class="heading">Amenities :</div>
                        <div class="amenities">
                              ${
                                acc.amenities.map(amenity => `
                                  <div class="amenity">${amenity}</div>
                                `).join('')
                              }
                        </div>

                    </div>

                    <div class="button-wrapper">
                        <button class="btn-primary edit-accomodation" onclick = "showEditAccomodationPopup(${acc.accommodation_id})">Edit Accomodation</button>
                        <button onclick = "showDeletePopup('accomodation',${acc.accommodation_id})" class="btn-primary delete-accomodation">Delete Accommodation</button>
                    </div>
            `
            let roomsSectionHTML = '';
            let roomCount =1;
            acc.rooms.forEach(room =>{
                roomHTML = `
                            <div class="rooms-wrapper">
                                <li>
                                    <div class="rooms">
                                        <div class="room-details">
                                            <div class="heading">Room No. ${roomCount}</div>
                                            <div class="desc">Room size : ${room.roomSize} sqft approx</div>

                                            <div class="room-tags">
                                                <span><i class="fa-solid fa-bed"></i> ${room.bedCount} Beds</span>
                                            </div>
                                            <p class="room-update">*Only one bed is available</p>
                                        </div>

                                        <div class="price">
                                            ₹ ${room.rent}/- 
                                            ${
                                                room.extras.map(extra =>`
                                                    <p>+ ${extra} bill</p>
                                                    `)
                                            }
                                            <p>(per bed/month)</p>
                                        </div>
                                    </div>
                                    <img src="../../assets/images/demo-room-img.jpg" alt="room-img">
                                </li>
                                <div class="button-wrapper">
                                    <button class="btn-primary edit-accomodation">Edit Room</button>
                                    <button onclick="showDeletePopup('rooms', ${ room.roomID})" class="btn-primary delete-accomodation">Delete Room</button>
                                </div>
                            </div>`
                            roomCount++;
                            roomsSectionHTML += roomHTML;
            }) 
            accomodationCard.innerHTML = sectionHTML;
            roomUl.innerHTML = roomsSectionHTML;
        }
    });

}

function updateEditAccomodationpopup(id){
    accData.forEach(acc => {
        if(acc.accommodation_id === id){
            console.log(acc);
            editAccomodationPopup.innerHTML = `
                    <h2>Edit Accomodation</h2>
        
                    <form action="" method="POST" enctype="multipart/form-data">
        
                        <div class="form-group">
                            <label>Accommodation Name</label>
                            <input type="text" name="add-accomodation-name" value="${acc.accommodation_name}" required>
                        </div>
        
                        <div class="form-group">
                            <label>Accommodation Type</label>
                            <select name="add-accomodation-acc-type" value="${(acc.accommodation_type).toUpperCase()}" required>
                                <option value="Hostel/PG">Hostel/PG</option>
                                <option value="Apartment">Apartment</option>
                                <option value="House">House</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Accommodation For:</label>
                            <div class="options">
                                <label><input type="radio" name="add-accomodation-accommodation_for" value="Boys Students"> Boys Students</label>
                                <label><input type="radio" name="add-accomodation-accommodation_for" value="Girls Students"> Girls Students</label>
                                <label><input type="radio" name="add-accomodation-accommodation_for" value="Male Working Professionals"> Male Working Professionals</label>
                                <label><input type="radio" name="add-accomodation-accommodation_for" value="Female Working Professionals"> Female Working Professionals</label>
                                <label><input type="radio" name="add-accomodation-accommodation_for" value="Family"> Family</label>
                                <label><input type="radio" name="add-accomodation-accommodation_for" value="Anyone"> Anyone</label>
                                <label><input type="radio" name="add-accomodation-accommodation_for" value="Not Specified"> Not Specified</label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Street Address</label>
                            <input type="text" name="add-accomodation-street-add"  value="${(acc.streetAdd)}" required>
                        </div>
        
                        <div class="form-group">
                            <label>location(City)</label>
                            <select name="add-accomodation-location" class="add-accomodation-cities" value="${acc.location}" required>
                            </select>
                        </div>
        
                        <div class="form-group">
                            <label>Locality</label>
                            <select name="add-accomodation-locality" class="select-localities" value="${acc.locality}" required>
                                <option value="school Danga">School Danga</option>
                            </select>
                        </div>
        
                        <div class="form-group">
                            <label>Pincode</label>
                            <input type="text" pattern="[0-9]{6}" name="add-accomodation-pincode" value="${acc.pincode}" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Google Map Link</label>
                            <input type="url" name="add-accomodation-google_link" value="${acc.google_map_link}">
                        </div>
        
                        <div class="form-group">
                            <label>Description & Rules</label>
                            <textarea name="add-accomodation-description" rows="4">${acc.accommodation_description}</textarea>
                        </div>
        
                        <div class="form-group">
                            <label>Amenities</label>
                            <div class="checkbox-group">
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="High-speed Wi-Fi"> High-speed Wi-Fi</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="24x7 Water Supply"> 24×7 Water Supply</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="RO / Filtered Drinking Water"> RO / Filtered Drinking Water</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Electricity Backup / Inverter"> Electricity Backup / Inverter</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Power Backup"> Power Backup</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Parking"> Parking</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Hot Water (Geyser)"> Hot Water (Geyser)</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Air Conditioning (AC)"> Air Conditioning (AC)</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Ceiling Fan"> Ceiling Fan</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Lift / Elevator"> Lift / Elevator</label>
        
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Daily/Weekly Cleaning"> Daily/Weekly Cleaning</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Laundry Service"> Laundry Service</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Housekeeping Staff"> Housekeeping Staff</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Trash Disposal"> Trash Disposal</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Room Service"> Room Service</label>
        
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="CCTV Surveillance"> CCTV Surveillance</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Biometric / Smart Lock Entry"> Biometric / Smart Lock Entry</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Security Guard"> Security Guard</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Fire Safety System"> Fire Safety System</label>
        
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Mess / Meal Service"> Mess / Meal Service</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Community Kitchen"> Community Kitchen</label>
        
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Common Dining Area"> Common Dining Area</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Common Hall / Lounge"> Common Hall / Lounge</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Gym / Fitness Area"> Gym / Fitness Area</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Rooftop Access"> Rooftop Access</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Garden Area"> Garden Area</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Co-working Space"> Co-working Space</label>
                                <label><input type="checkbox" name="add-accomodation-amenities[]" value="Guest Allowance Policy"> Guest Allowance Policy</label>
                            </div>
                        </div>
        
                        <button type="submit" name="save-accomodation-submit" class="btn">Save Accommodation</button>
        
                    </form> 
            `
        }
    })
}