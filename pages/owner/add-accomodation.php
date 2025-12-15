<?php
session_start();
include __DIR__ . '/owner-header.php';
?>

<?php
if(isset($_POST['save-accomodation-submit'])){
    $name = strtoupper(clean($_POST['add-accomodation-name']));
    $accType = strtoupper(clean($_POST['add-accomodation-acc-type']));
    $accFor = strtoupper(clean($_POST['add-accomodation-accommodation_for']));
    $streetAdd = strtoupper(clean($_POST['add-accomodation-street-add']));
    $location = strtoupper(clean($_POST['add-accomodation-location']));
    $locality = strtoupper(clean($_POST['add-accomodation-locality']));
    $pincode = clean($_POST['add-accomodation-pincode']);
    $googleLink = clean($_POST['add-accomodation-google_link']);
    $accDesc = strtoupper(clean($_POST['add-accomodation-description']));
    $ownerID = $_SESSION['owner']['user_id'] ?? 0;

    $selectedAmemites = $_POST['add-accomodation-amenities'] ?? [];
    $cleanedAmenities = array_map("clean", $selectedAmemites);
    $accAmenities = implode(",", $cleanedAmenities);

    $demoName = strtolower(str_replace(" ", "-", $name)) . $ownerID;
    $uploadsPath = "uploads";
    
    if (!is_dir($uploadsPath)) {
        mkdir($uploadsPath, 0777, true);
    }

    $imgCount = 0;
    if(!empty($_FILES['add-accomodation-images']['tmp_name'][0])){
        foreach ($_FILES['add-accomodation-images']['tmp_name'] as $imgIndex => $tempname){
            $fileName = $_FILES['add-accomodation-images']['name'][$imgIndex];
            $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

            if($extension !== "jpg"){
                echo "<script>alert('Only JPG allowed!');</script>";
                return;
            }

            $newFileName =  $demoName ."-img-". $imgIndex . "." . "jpg";
            echo $newFileName;
            echo $tempName;
            move_uploaded_file($tempname, "$uploadsPath/$newFileName");
            $imgCount++;
        }
    }

    $sql = "INSERT INTO accommodation (accommodation_name, accommodation_description, owner_id, amenities, accommodation_type, accommodation_for, street_address, location, locality, pincode, google_map_link, img_count, img_path) VALUES ('$name', '$accDesc', '$ownerID', '$accAmenities', '$accType', '$accFor', '$streetAdd', '$location', '$locality', '$pincode', '$googleLink', '$imgCount', '$uploadsPath')";

    $result = mysqli_query($conn, $sql);
    if(!$result){
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = "Upload Failed! Try again.";
        echo "<script>window.location='owner-home.php';</script>";
        exit;
    }
    

    $acc_id = mysqli_insert_id($conn);

    // ---------- Insert Rooms ----------
    if(!empty($_POST['rooms'])){
        foreach($_POST['rooms'] as $index => $room){
            $size = clean($room['size']);
            $rent = clean($room['rent']);
            $bedCount = clean($room['bed_count']);
            $tags = isset($room['tags']) ? implode(",", array_map("clean", $room['tags'])) : "";
            $extras = isset($room['extras']) ? implode(",", array_map("clean", $room['extras'])) : "";

            $imageField = "rooms_image_" . $index;
            $uploadedImageName = "";
            if(isset($_FILES[$imageField]) && !empty($_FILES[$imageField]['tmp_name'])){
                $fileName = $_FILES[$imageField]['name'];
                $tempName = $_FILES[$imageField]['tmp_name'];
                $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                if($ext !== "jpg"){
                    echo "<script>alert('Only JPG images allowed for room!');</script>";
                    return;
                }

                $roomImgUploadPath = __DIR__ . "/uploads/room";
                if(!is_dir($roomImgUploadPath)){
                    mkdir($roomImgUploadPath, 0777, true);
                }

                $uploadedImageName = "room-" . $acc_id . "-" . $index . ".jpg";
                move_uploaded_file($tempName, $roomImgUploadPath . "/" . $uploadedImageName);
            }

            $sqlRoom = "INSERT INTO `rooms` (`accommodation_id`, `owner_id`, `room_size`, `rent`, `bed_count`, `occupied_beds`, `tags`, `extras`, `room_image`) VALUES ('$acc_id', '$ownerID', '$size', '$rent', '$bedCount', '0', '$tags', '$extras', '../../uploads/rooms/');";
            $resRoom = mysqli_query($conn, $sqlRoom);
            if(!$resRoom){
                $_SESSION['status'] = 'error';
                $_SESSION['message'] = "Upload Failed! Try again.";
                echo "<script>window.location='owner-home.php';</script>";
                exit;
            }
        }
    }

    $_SESSION['status'] = 'success';
    $_SESSION['message'] = "Your accommodation is successfully uploaded";
    echo "<script>window.location='owner-home.php';</script>";
    exit;
}

?>

    <div class="body">
        <nav class="owner-nav">
            <button class="round-button" onclick="closePopup()"><i class="fa-solid fa-angles-left"></i></button>
            <ul>
                <a href="./dashboard.php"><li >Dashboard</li></a>
                <a href="./view-accomodation.php"><li>View Accomodation</li></a>
                <a href="./manage-rooms.php"><li>Manage Rooms</li></a>
                <a href="./add-accomodation.php"><li class="active">Add Accommodation</li></a>
            </ul>
        </nav>
        <div class="wrapper">
            <h2>Add Accommodation</h2>

            <form action="" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Accommodation Name</label>
                    <input type="text" name="add-accomodation-name" required>
                </div>

                <div class="form-group">
                    <label>Accommodation Images (Multiple)</label>
                    <input type="file" name="add-accomodation-images[]" accept=".jpg" multiple required>
                </div>

                <div class="form-group">
                    <label>Accommodation Type</label>
                    <select name="add-accomodation-acc-type" required>
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
                    <input type="text" name="add-accomodation-street-add" required>
                </div>

                <div class="form-group">
                    <label>location(City)</label>
                    <select name="add-accomodation-location" class="add-accomodation-cities" required>
                    </select>
                </div>

                <div class="form-group">
                    <label>Locality</label>
                    <select name="add-accomodation-locality" class="select-localities" required>
                        <option value="school Danga">School Danga</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Pincode</label>
                    <input type="text" pattern="[0-9]{6}" name="add-accomodation-pincode" required>
                </div>
                
                <div class="form-group">
                    <label>Google Map Link</label>
                    <input type="url" name="add-accomodation-google_link">
                </div>

                <div class="form-group">
                    <label>Description & Rules</label>
                    <textarea name="add-accomodation-description" rows="4"></textarea>
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

                <hr>

                <h3>Rooms</h3>
                <div id="roomContainer"></div>

                <button type="button" class="btn-primary" name="add-room-button" onclick="addRoom()">+ Add Room</button>

                <br><br>
                <button type="submit" name="save-accomodation-submit" class="btn">Save Accommodation</button>

            </form>        
        </div>
    </div>

<?php
include __DIR__ . '/owner-footer.php';
?>