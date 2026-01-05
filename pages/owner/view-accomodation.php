<?php
include __DIR__ . '/owner-header.php';
?>
<?php
if(isset($_POST['confirmed-delete'])){
    $str = $_POST['confirmed-delete'];
    [$table, $id] = explode('-', $str);
    $id = (int)$id;
   
    if($table == 'accomodation'){
        $roomSql = "DELETE FROM `rooms` WHERE `accommodation_id` = $id;";
        if(!($result = mysqli_query($conn, $roomSql))){
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = "Unable to delete. Please try again.";
            echo "<script>window.location='view-accomodation.php';</script>";
            exit;
        }

        $sql = "DELETE FROM `accommodation` WHERE `accommodation_id` = $id;";
    }else{
        $sql = "DELETE FROM `rooms` WHERE `room_id` = $id;";
    }
    if($result = mysqli_query($conn, $sql)){
        $_SESSION['status'] = 'success';
        if($table == 'accomodation'){
            $_SESSION['message'] = "Accomodation deleted permanently.";
        }else{
            $_SESSION['message'] = "Room deleted permanently.";
        }
    }else{
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = "Unable to delete. Please try again.";
    }
    echo "<script>window.location='view-accomodation.php';</script>";
    exit;
}
?>
    <link rel="stylesheet" href="./view-accomodation.css">
    <link rel="stylesheet" href="../tenant/room-details.css">
    <div class="body">
        <nav class="owner-nav">
            <button class="round-button" onclick="closePopup()"><i class="fa-solid fa-angles-left"></i></button>
            <ul>
                <!-- <a href="./dashboard.php"><li >Dashboard</li></a> -->
                <a href="./view-accomodation.php"><li class="active">View Accomodation</li></a>
                <a href="./manage-rooms.php"><li >Manage Rooms</li></a>
                <a href="./add-accomodation.php"><li >Add Accommodation</li></a>
            </ul>
        </nav>
        <div class="wrapper">
            <ul class="accomodation-nav">
                <?php 
                $ownerID = $_SESSION['owner']['user_id'];
                $sql = "SELECT `accommodation_id`, `accommodation_name` FROM `accommodation` WHERE `owner_id` = $ownerID;";
                if(!($result = mysqli_query($conn, $sql))){
                    echo<<<HTML
                    <h1>You have not register any accomodation!</h1>
                    HTML;
                }

                if ($result && mysqli_num_rows($result) > 0) {
                    $index = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $accId = $row['accommodation_id'];
                        $name = ucwords(strtolower($row['accommodation_name']));
                        echo<<<HTML
                            <li data-id="$accId" data-ownerid = '$ownerID'>$name</li>
                        HTML;
                    }
                }
                ?>
            </ul>
        <div>
                <div class="accomodation-card-holder">
                    <div class="accomodation-card">

                    </div>
                    <section class="section room-details-section">
                        <div class="heading">Choose your room</div>

                        <ul class="rooms-ul">
                            
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <!-- edit accomodation popup  -->
    <!-- <div class="popup-card" id="edit-accomodation-popup">
       
    </div> -->
    
    <!-- edit room popup  -->
    <div class="popup-card" id="add-room-popup">
        
    </div>


    <script src="./view-accomodation.js"></script>

<?php
if (isset($_POST['save-room-submit'])) {

    $acc_id  = (int) $_POST['save-room-submit'];
    $ownerID = (int) $_SESSION['owner']['user_id'];

    $size     = clean($_POST['size']);
    $rent     = clean($_POST['rent']);
    $bedCount = clean($_POST['bed_count']);

    $tags   = isset($_POST['tags']) ? implode(",", array_map("clean", $_POST['tags'])) : "";
    $extras = isset($_POST['extras']) ? implode(",", array_map("clean", $_POST['extras'])) : "";

    $uploadedImageName = "";

    if (isset($_FILES['room_image']) && !empty($_FILES['room_image']['tmp_name'])) {

        $fileName = $_FILES['room_image']['name'];
        $tempName = $_FILES['room_image']['tmp_name'];
        $ext      = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($ext !== "jpg") {
            $_SESSION['status']  = 'error';
            $_SESSION['message'] = "Only JPG images are allowed for rooms.";
            header("Location: owner-home.php");
            exit;
        }

        $roomImgUploadPath = __DIR__ . "/uploads/rooms";
        if (!is_dir($roomImgUploadPath)) {
            mkdir($roomImgUploadPath, 0777, true);
        }

        $uploadedImageName = "room-" . $acc_id . "-" . "image" . ".jpg";
        move_uploaded_file($tempName, $roomImgUploadPath . "/" . $uploadedImageName);
    }

    /* ---------- Insert Room ---------- */
    $sqlRoom = "
        INSERT INTO rooms 
        (accommodation_id, owner_id, room_size, rent, bed_count, occupied_beds, tags, extras, room_image)
        VALUES
        ('$acc_id', '$ownerID', '$size', '$rent', '$bedCount', '0', '$tags', '$extras', '$uploadedImageName')
    ";

    if (!mysqli_query($conn, $sqlRoom)) {
        $_SESSION['status']  = 'error';
        $_SESSION['message'] = "Room upload failed. Please try again.";
        header("Location: " . $_SERVER['REQUEST_URI']);
        exit;
    }

    $_SESSION['status']  = 'success';
    $_SESSION['message'] = "Room added successfully.";
    header("Location: " . $_SERVER['REQUEST_URI']);
    exit;
}
?>

<?php
include __DIR__ . '/owner-footer.php';
?>