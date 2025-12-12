let roomIndex = 0;

function addRoom() {
    roomIndex++;

    let html = `
        <div class="room-box">
            <h4>Room ${roomIndex}</h4>

            <label>Room Size (sqft)</label>
            <input type="number" name="rooms[${roomIndex}][size]" required>


            <label>Rent</label>
            <input type="number" name="rooms[${roomIndex}][rent]" required>
            
            <label>Bed Count</label>
            <input type="number" name="rooms[${roomIndex}][bed_count]" required>

            <div class="form-group">
                <label>Tags</label><br>
                <div class="checkbox-group">
                    <label><input type="checkbox" name="rooms[${roomIndex}][tags][]" value="Attached Bathroom"> Attached Bathroom</label>
                    <label><input type="checkbox" name="rooms[${roomIndex}][tags][]" value="AC Room"> AC Room</label>
                    <label><input type="checkbox" name="rooms[${roomIndex}][tags][]" value="Fully Furnished"> Fully Furnished</label>
                    <label><input type="checkbox" name="rooms[${roomIndex}][tags][]" value="Partially Furnished"> Partially Furnished</label>
                    <label><input type="checkbox" name="rooms[${roomIndex}][tags][]" value="Unfurnished"> Unfurnished</label>
                    <label><input type="checkbox" name="rooms[${roomIndex}][tags][]" value="With Kitchen"> With Kitchen</label>
                    <label><input type="checkbox" name="rooms[${roomIndex}][tags][]" value="Without Kitchen"> Without Kitchen</label>
                    <label><input type="checkbox" name="rooms[${roomIndex}][tags][]" value="Study Table"> Study Table</label>
                    <label><input type="checkbox" name="rooms[${roomIndex}][tags][]" value="Wardrobe"> Wardrobe</label>
                    <label><input type="checkbox" name="rooms[${roomIndex}][tags][]" value="Balcony"> Balcony</label>
                </div>
            </div>

            <label>Extra Bills</label><br>
            <div class= "checkbox-group">
                <label><input type="checkbox" name="rooms[${roomIndex}][extras][]" value="Electricity"> Electricity</label>
                <label><input type="checkbox" name="rooms[${roomIndex}][extras][]" value="Wifi"> Wifi</label>
                <label><input type="checkbox" name="rooms[${roomIndex}][extras][]" value="Water"> Water</label>
            </div>
            <label>Room Image</label>
            <input type="file" name="rooms_image_${roomIndex}" required>
        </div>
    `;

    document.getElementById("roomContainer").innerHTML += html;
}


