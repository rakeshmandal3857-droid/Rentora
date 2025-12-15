<?php
include __DIR__ . '/../../Components/header.php';
include __DIR__ . '/../../config-db.php';
?>
<link rel="stylesheet" href="./room-details.css">
<?php
$accomodationID = $_GET['id'];

$sql = "SELECT * FROM accommodation WHERE accommodation_id = $accomodationID";
$result = mysqli_query($conn, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $name = ucwords(strtolower($row['accommodation_name']));
        $acctype = ucwords(strtolower($row['accommodation_type']));
        $add = ucwords(strtolower($row['street_address'])) .", " . ucwords(strtolower($row['locality'])) .", " . ucwords(strtolower($row['location']))  .", " . $row['pincode']; 
        $googleLink = $row['google_map_link'];
        $imgCount = $row['img_count'];
        $accDesc = ucfirst(strtolower($row['accommodation_description']));
        $amenities = explode(',', $row['amenities']);
        $ownerId = $row['owner_id'];
        echo <<<HTML
        <div class="hero-section">
            <div class="hero-section-header">
                <div>
                    <div class="acomodation-name">$name
                        <div class="acomodation-type">$acctype</div>
                    </div>
                    <a href="$googleLink" target="_blank" class="location"><i class="fa-solid fa-location-dot"></i>$add</a>
                </div>
                <div class="rating-box">
                    <div class="rating-num">4.5</div>
                    <div>
                        <div class="rating">
                            <div class="stars-bg"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                            <div class="stars-fill" style="width: 60%" ><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                        </div>
                        <p>23000 Reviews</p>
                    </div>
                </div>
            </div>
            <div class="img-section" >
        HTML;
        for($i=0; $i<6; $i++){
            echo <<<HTML
            <img src="../../assets/images/demo-room-img.jpg" alt="room-image">
            HTML;
        }
        echo <<<HTML
            </div>
            <div class="hero-section-footer">
                <div class="about">
                    <div class="heading">Accommodation Description & Rules:</div>
                    <div class="desc">$accDesc</div>
                </div>
            </div>
        
            <div class="heading">Amenities :</div>
            <div class="amenities">
            HTML;
            foreach($amenities as $amenity){
                echo <<<HTML
                <div class="amenity">
                    $amenity
                </div>
                HTML;
            }
            echo <<<HTML
            </div>
        </div>
        
        <section class="section room-details-section">
            <div class="heading">Choose your room</div>
        
            <ul>
        HTML;
        $sql = "SELECT * FROM `rooms` WHERE accommodation_id = $accomodationID;";
        $result = mysqli_query($conn, $sql);
        $roomNumber = 1;
        if($result && mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $extras = explode(",", $row['extras']);
                $availableBed = $row['bed_count'] - $row['occupied_beds'];
                echo <<<HTML
                <li>
                    <div class="rooms">
                        <div class="room-details">
                            <div class="heading">Room No. $roomNumber</div>
                            <div class="desc">Room size : {$row['room_size']} sqft approx</div>
        
                            <div class="room-tags">
                                <span><i class="fa-solid fa-bed"></i> {$row['bed_count']} Beds</span>
                            </div>
                HTML;
                if($row['bed_count'] > $availableBed && $row['bed_count'] !== 0){
                    if($availableBed == 1){
                        echo '<p class="room-update">*Only ' . $availableBed . ' bed is available</p>';
                    }else{
                        echo '<p class="room-update">*Only ' . $availableBed . ' beds are available</p>';
                    }
                }
                echo<<<HTML
                        </div>
                        
                        <div class="price">
                            ₹ {$row['rent']}/- 
                HTML;

                foreach($extras as $extra){
                    echo "<p>+ {$extra} bill</p>";
                }

                echo <<<HTML
                            <p>(per bed/month)</p>
                        </div>
                    </div>
                    <img src="../../assets/images/demo-room-img.jpg" alt="room-img">
                </li>
                HTML;
                $roomNumber++;
            }
        }
        echo <<<HTML
            </ul>
        HTML;
        $sql = "SELECT * FROM `owners` WHERE user_id = $ownerId;";
        $result= mysqli_query($conn, $sql);
        if($result && mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $mobile = $row['mobile'];
            echo <<<HTML
                <a href="tel:$mobile">
                    <button class="btn-primary">Call the Owner : +91 $mobile</button>
                </a>
            </section>
            HTML;
        }
    }
} else {
    echo "<script>console.log('cannot fetch data');</script>";
}
?>

<script src="./room-details.js"></script>
<?php
include __DIR__ . '/../../Components/footer.php';
?>