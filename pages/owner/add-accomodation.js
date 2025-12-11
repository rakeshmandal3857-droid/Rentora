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
