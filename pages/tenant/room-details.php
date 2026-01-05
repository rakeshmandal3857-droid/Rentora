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
            </div>
            <div class="img-section" >
        HTML;
        for($i=0; $i<$imgCount; $i++){
            $imgName = strtolower(str_replace(" ", "-", $name)) . $ownerId . "-img-" . $i . ".jpg";
            echo <<<HTML
            <img src="../owner/uploads/$imgName" alt="room-image">
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
                $imgPath = $row['room_image'];
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
                if ($row['bed_count'] > 0 && $row['bed_count'] > $availableBed) {
                    if ($availableBed === 0) {
                        echo '<p class="room-update">*No beds are currently available.</p>';
                    } elseif ($availableBed === 1) {
                        echo '<p class="room-update">*Only 1 bed is available</p>';
                    } else {
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
                    <img src="../owner/uploads/rooms/$imgPath" alt="room-img">
                </li>
                HTML;
                $roomNumber++;
            }
        }
        echo <<<HTML
            </ul>
        </section>
        HTML;
        if(isset($_SESSION['tenant'])){
            $sql = "SELECT * FROM `owners` WHERE user_id = $ownerId;";
            $result= mysqli_query($conn, $sql);
            if($result && mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_assoc($result);
                $mobile = $row['mobile'];
                $name = ucwords(strtolower($row['name']));
                $img_path = $row['img_path'];
                echo <<<HTML
                    <section class="section">
                        <div class="heading">Owner Details</div>
                        <div class="owner-details-section">
                            <div class="profile-picture">
                                <img src="$img_path" alt="profile-picture">
                            </div>
                            <div class="owner-info">
                                <div>$name</div>
                                <p><i class="fa-solid fa-phone-volume"></i> +91 $mobile</p>
                            </div>
                            <div class="buttons">
                                <a href="tel: {$mobile}"><button class="btn-primary" ><i class="fa-solid fa-phone-volume"></i> Call Now</button></a>
                                <!-- <button class="btn-primary" ><i class="fa-brands fa-facebook-messenger"></i>Massage Now</button> -->
                            </div>
                        </div>
                    </section>
                    HTML;
                }
            }else{
                echo<<<HTML
                <section class="section">
                    <div class="heading">Owner Details <p class="log-in-instraction">*You must be logged in to view owner details.</p></div>
                    <div class="owner-details-section">
                        <div class="profile-picture">
                            <img src="../../assets/images/user-profile-photo.png" alt="profile-picture">
                        </div>
                        <div class="owner-info">
                            <div>Owner Name</div>
                            <p><i class="fa-solid fa-phone-volume"></i> +91 XXXXXXXXXX</p>
                        </div>
                        <div class="buttons">
                            <button class="btn-primary" onclick = "showToastNotification('warning', 'You must be logged in to view owner details.')" ><i class="fa-solid fa-phone-volume"></i> Call Now</button>
                            <!-- <button class="btn-primary" onclick = "showToastNotification('warning', 'You must be logged in to view owner details.')" ><i class="fa-brands fa-facebook-messenger"></i>Massage Now</button> -->
                        </div>
                    </div>
                </section>
            HTML;
        }

        $reviewSql = "SELECT
                        COUNT(CASE WHEN `overall` = 1 THEN 1 END) AS `rating_1`,
                        COUNT(CASE WHEN `overall` = 2 THEN 1 END) AS `rating_2`,
                        COUNT(CASE WHEN `overall` = 3 THEN 1 END) AS `rating_3`,
                        COUNT(CASE WHEN `overall` = 4 THEN 1 END) AS `rating_4`,
                        COUNT(CASE WHEN `overall` = 5 THEN 1 END) AS `rating_5`,
                        COUNT(`overall`) AS `count_rating`,
                        ROUND(AVG(`overall`), 1)        AS `overall`,
                        ROUND(AVG(`amenities`), 1)      AS `amenities`,
                        ROUND(AVG(`cleanliness`), 1)    AS `cleanliness`,
                        ROUND(AVG(`communication`), 1)  AS `communication`,
                        ROUND(AVG(`location`), 1)       AS `location`,
                        ROUND(AVG(`value`), 1)          AS `value`
                    FROM accomodation_review
                    WHERE accommodation_id = $accomodationID;";

        $reviewResult = mysqli_query($conn, $reviewSql);
        
        if($reviewResult && mysqli_num_rows($reviewResult) >0){
            $reviewRow = mysqli_fetch_assoc($reviewResult);
            
            $countRating = intval($reviewRow['count_rating']);
            if ($countRating === 0){
                echo<<<HTML
                <section id="review-section" class="section">
                    <div class="review-header">
                        <div class="review-title">
                            <h2>Reviews</h2>
                        </div>
    
                        <div class="heading">No review yet. Be the first to write a review!</div>
                        
                        <button class="btn-primary" onclick="showReviewAccomodationForm()"> Write a Review</button>
                    </div>
                </section>
                HTML;
                break;
            }

            $rating_1 = (intval($reviewRow['rating_1']) / $countRating) * 100;
            $rating_2 = (intval($reviewRow['rating_2']) / $countRating) * 100;
            $rating_3 = (intval($reviewRow['rating_3']) / $countRating) * 100;
            $rating_4 = (intval($reviewRow['rating_4']) / $countRating) * 100;
            $rating_5 = (intval($reviewRow['rating_5']) / $countRating) * 100;

            $overall = number_format(round(floatval($reviewRow['overall']), 1),1);
            $overallPersent = abs(($overall / 5) * 100);
            $amenitiesRating = number_format(round(floatval($reviewRow['amenities']), 1),1);
            $cleanliness = number_format(round(floatval($reviewRow['cleanliness']), 1),1);
            $communication = number_format(round(floatval($reviewRow['communication']), 1),1);
            $location = number_format(round(floatval($reviewRow['location']), 1),1);
            $value = number_format(round(floatval($reviewRow['value']), 1),1);
            $countRating = formatNumber($countRating);

            echo<<<HTML
            <section id="review-section" class="section">
                <button class="btn-primary" onclick="showReviewAccomodationForm()" >Write a Review</button>
                <div>
                    <div class="heading">Reviews</div>
                    <div class="rating-box">
                        <div class="rating-num">$overall</div>
                        <div>
                            <div class="rating">
                                <div class="stars-bg"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                                <div class="stars-fill" style="width: $overallPersent%" ><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                            </div>
                            <p>$countRating Reviews</p>
                        </div>
                    </div>
                </div>
                <div class="rating-slider">
                    <div class="overall-rating">
                        <div>Overall Rating</div>
                        <div class="slider-wrapper">
                            <div>5 <div class="rating-shower"><div style="width: $rating_5%;"></div></div></div>
                            <div>4 <div class="rating-shower"><div style="width: $rating_4%;"></div></div></div>
                            <div>3 <div class="rating-shower"><div style="width: $rating_3%;"></div></div></div>
                            <div>2 <div class="rating-shower"><div style="width: $rating_2%;"></div></div></div>
                            <div>1 <div class="rating-shower"><div style="width: $rating_1%;"></div></div></div>
                        </div>
                    </div>
                    <div>
                        <div><i class="fa-brands fa-square-web-awesome-stroke"></i>Amenities
                            <div>$amenitiesRating</div>
                        </div>
                    </div>
                    <div>
                        <div><i class="fa-solid fa-hand-sparkles"></i>Cleanliness
                            <div>$cleanliness</div>
                        </div>
                    </div>
                    <div>
                        <div><i class="fa-regular fa-comments"></i>Communication
                            <div>$communication</div>
                        </div>
                    </div>
                    <div>
                        <div><i class="fa-solid fa-location-dot"></i>Location
                            <div>$location</div>
                        </div>
                    </div>
                    <div>
                        <div><i class="fa-regular fa-circle-check"></i>Value
                            <div>$value</div>
                        </div>
                    </div>

                </div>
            <ul class="reviews">
            HTML;
            $reviewSql = "SELECT `overall`, `review`, `writer_id`, `date` FROM `accomodation_review` WHERE `accommodation_id` = $accomodationID;";
            $reviewResult = mysqli_query($conn, $reviewSql);

            if($reviewResult && mysqli_num_rows($reviewResult)> 0){
                while($reviewRow = mysqli_fetch_assoc($reviewResult)){
                    $writerID = $reviewRow['writer_id'];
                    $overall = number_format($reviewRow['overall'], 1);
                    $review = $reviewRow['review'];
                    $date = date('d M Y', strtotime($reviewRow['date']));

                    $writerSql = "SELECT `name`,`img_path` FROM `tenants` WHERE `user_id` = $writerID;";
                    $writerResult = mysqli_query($conn, $writerSql);

                    if($writerResult && mysqli_num_rows($writerResult)> 0){
                        $writerRow = mysqli_fetch_assoc($writerResult);
                        $writerImg = $writerRow['img_path'];
                        $writername = ucwords(strtolower($writerRow['name']));

                        echo<<<HTML
                                <li class="review-card">
                                    <div class="review-card-header">
                                        <div class="profile-picture">
                                            <img src="$writerImg" alt="profile-picture">
                                        </div>
                                        <div>
                                            <div>$writername</div>
                                            <p>$date</p>
                                        </div>
                                        <div class="rating-num">$overall</div>
                                    </div>
                                    <p><i>"$review"</i></p>
                                </li>
                        HTML;
                    }
                }
            }
            echo<<<HTML
                </ul>
            </section>
            HTML;
        }else{
            echo "<h2>NO reviews yet!</h2>";
        }
    }
} else {
    echo "<script>console.log('cannot fetch data');</script>";
}
?>

<?php
include __DIR__ . '/../../Components/footer.php';
?>