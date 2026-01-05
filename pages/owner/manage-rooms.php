<?php
include __DIR__ . '/owner-header.php';
?>

<div class="body">
    <link rel="stylesheet" href="./manage-accomodation.css">
    <nav class="owner-nav">
        <button class="round-button" onclick="closePopup()"><i class="fa-solid fa-angles-left"></i></button>
        <ul>
            <!-- <a href="./dashboard.php"><li >Dashboard</li></a> -->
            <a href="./view-accomodation.php"><li>View Accomodation</li></a>
            <a href="./manage-rooms.php"><li class="active">Manage Rooms</li></a>
            <a href="./add-accomodation.php"><li >Add Accommodation</li></a>
        </ul>
    </nav>
    <div class="wrapper">
        <div class="table-wrapper">
            <?php
                $index = 0;
                $ownerId = (int)$_SESSION['owner']['user_id'];
                $accSql = "SELECT `accommodation_id`, `accommodation_name` FROM `accommodation` WHERE `owner_id` = $ownerId;";
                $accResult = mysqli_query($conn, $accSql);
                if($accResult && mysqli_num_rows($accResult)){
                    while($row = mysqli_fetch_assoc($accResult)){
                        $accomodationId = $row['accommodation_id'];
                        if($accomodationId){
                            echo<<<HTML
                            <table>
                            <h2>{$row['accommodation_name']}:</h2>
                            <tr>
                                <th>Sl.</th>
                                <th>Room</th>
                                <th>Area</th>
                                <th>Rent<p>(Per Month)</p></th>
                                <th>Total Bed</th>
                                <th>Occupied Bed</th>
                                <th>Button</th>
                            </tr>
                            HTML;

                            $sql = "SELECT `room_id`, `accommodation_id`, `room_size`, `rent`, `bed_count`, `occupied_beds`FROM `rooms` WHERE `accommodation_id` = $accomodationId;";
                            $result = mysqli_query($conn, $sql);

                            if($result && mysqli_num_rows($result)){
                                $count = 0;

                                while($row = mysqli_fetch_assoc($result)){
                                    $roomId = $row['room_id'];
                                    // $roomNo = 
                                    $count ++;
                                    $index ++;
                                    $area = $row['room_size'];
                                    $rent = $row['rent'];
                                    $bedCount = $row['bed_count'];
                                    $occupiedBed = (int)$row['occupied_beds'];
                                    echo<<<HTML
                                        <tr>
                                            <td>$index.</td>
                                            <td>Room - $count</td>
                                            <td>$area sqft</td>
                                            <td>$rent /-</td>
                                            <td class = "bedCount">$bedCount</td>
                                            <td>
                                                <div>
                                                    <button class="round-button minus"><i class="fa-solid icon fa-minus"></i></button>
                                                    <div class="occupied-bed-count">$occupiedBed</div>
                                                    <button class="round-button plus"><i class="fa-solid icon fa-plus"></i></button>
                                                </div>
                                            </td>
                                            <td>
                                                <form action="" method="post">
                                                    <!-- <input type="hidden" class="Ocupied-bed" value= 'form_ID_$index' name="Ocupied-bed"> -->
                                                    <input type="hidden" class="Ocupied-bed" value= '$occupiedBed' name="ocupied-bed">
                                                    <button class="btn-primary" type="submit" name = "update_button" value= '$roomId' >Update</button>
                                                </form>
                                            </td>
                                        </tr>
                                        HTML;
                                    }
                                echo "</table>";
                            }
                        }else{
                            echo "<h3> No Rooms listed yet!</h3>";
                        }
                    }
                }
                ?>
           
        </div>
    </div>
</div>
<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $roomID = $_POST['update_button'];
    $occupiedBed = $_POST['ocupied-bed'];

    $sql = "UPDATE `rooms` SET `occupied_beds`='$occupiedBed' WHERE `room_id` = $roomID;";
    if(mysqli_query($conn, $sql)){
        $_SESSION['status'] = 'success';
        $_SESSION['message'] = "Bed occupancy has been updated successfully.";
        echo "<script>window.location.href = window.location.href;</script>";
        exit;
    }else{
        $_SESSION['status'] = 'error';
        $_SESSION['message'] = "Bed occupancy has been updated successfully.";
        echo "<script>window.location.href = window.location.href;</script>";
        exit;
    }
}
?>
<script src="./manage-room.js"></script>

<?php
include __DIR__ . '/owner-footer.php';
?>