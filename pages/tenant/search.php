<?php
include __DIR__ . '/../../config-db.php';
include __DIR__ . '/../../Components/header.php';
?>
<!-- <link rel="stylesheet" href="./home.css"> -->
<link rel="stylesheet" href="./search.css">
    <section id="hero-section">
            <form class="search-form" action="search.php" method="get">
                <label for="location">Location <i class="fa-solid fa-caret-down"></i>
                    <div class="text-input">
                        <i class="fa-solid fa-location-dot"></i>
                        <input type="text" name="location" id="location" value="<?php echo $_GET['location'] ?>" placeholder="Location">
                    </div>
                </label>
                <label for="locality">Locality <i class="fa-solid fa-caret-down"></i>
                    <div class="text-input">
                        <script>
                            const PRESELECT_LOCALITY = <?= json_encode(strtoupper($_GET['locality'] ?? '')) ?>;
                        </script>
                        <i class="fa-solid fa-location-dot"></i>
                        <select name="locality" class="select-localities" id="locality">
                            
                            
                        </select>
                    </div>
                </label>
                <label for="acomodation-type">Acomodation Type <i class="fa-solid fa-caret-down"></i>
                    <div class="text-input">
                        <i class="fa-solid fa-house-chimney"></i>
                        <select name="acomodation-type" id="acomodation-type">
                            <option value="All" <?= ($_GET['acomodation-type'] ?? '') === 'All' ? 'selected' : '' ?>>All</option>
                            <option value="Hostel/PG" <?= ($_GET['acomodation-type'] ?? '') === 'Hostel/PG' ? 'selected' : '' ?>>Hostel/PG</option>
                            <option value="Apartment" <?= ($_GET['acomodation-type'] ?? '') === 'Apartment' ? 'selected' : '' ?>>Apartment</option>
                            <option value="House" <?= ($_GET['acomodation-type'] ?? '') === 'House' ? 'selected' : '' ?>>House</option>
                        </select>
                    </div>
                </label>
                <button class="btn-primary" name="search-button">Search</button>
            </form>
    </section>

        <div class="featured-properties-wrapper">
            <?php
            $location = strtoupper($_GET['location']);
            $locality = strtoupper($_GET['locality']);
            $accType = strtoupper($_GET['acomodation-type']);
            if($locality == "ALL" && $accType == 'ALL'){
                $sql = "SELECT * FROM accommodation WHERE location = '$location';";
            }elseif($accType == 'ALL'){
                $sql = "SELECT * FROM accommodation WHERE location = '$location' AND locality = '$locality';";
            }else{
                $sql = "SELECT * FROM accommodation WHERE location = '$location' AND locality = '$locality' AND accommodation_type = '$accType';";
            }
            $result = mysqli_query($conn, $sql);
            if($result && mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['accommodation_id'];
                    $accType = ucwords(strtolower($row['accommodation_type']));
                    $accName = ucwords(strtolower($row['accommodation_name']));
                    $accAdd = $add = ucwords(strtolower($row['street_address'])) .", " . ucwords(strtolower($row['locality'])) .", " . ucwords(strtolower($row['location']))  .", " . $row['pincode'];
                    $ownerId = $row['owner_id'];
                    $imgName = strtolower(str_replace(" ", "-", $accName)) . $ownerId . "-img-0.jpg";

                    echo<<<HTML
                    <div class="property-card" id ="$id">
                        <div class="img-holder">
                            <img src="../owner/uploads/$imgName" alt="room-images">
                            <!-- <button class="round-button" onclick="toggleWishlist(this)"><i class="fa-regular fa-heart"></i></button> -->
                            <p class="property-type">$accType</p>
                        </div>
                        <div class="info">
                            <div class="card-heading">$accName</div>
                    HTML;
                    $ratingSql = "SELECT `overall` FROM `accomodation_review` WHERE `accommodation_id` = $id;";
                    $ratingResult = mysqli_query($conn, $ratingSql);

                    $sumOfOverall = 0;
                    $count = 0;
                    $avgRatingPercent = 0;

                    if ($ratingResult && mysqli_num_rows($ratingResult) > 0) {
                        while ($ratingRow = mysqli_fetch_assoc($ratingResult)) {
                            $sumOfOverall += (float) $ratingRow['overall'];
                            $count++;
                        }
                        if ($sumOfOverall > 0) {
                            $avgRatingPercent = (($sumOfOverall / $count) / 5) * 100;
                        }
                    }
                    echo<<<HTML
                            <div class="rating">
                                <div class="stars-bg"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                                <div class="stars-fill" style="width: $avgRatingPercent%" ><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                            </div>
                            <p><i class="fa-solid fa-location-dot"></i> $accAdd</p>
                    HTML;
                    $priceSql ="SELECT MIN(`rent`) AS `min_rent` FROM `rooms` WHERE `accommodation_id` = $id;";
                    $priceResult = mysqli_query($conn, $priceSql);
                    if($priceResult && mysqli_num_rows($priceResult) == 1){
                        if($priceRow = mysqli_fetch_assoc($priceResult)){
                            echo '<div class="price">₹ '."{$priceRow['min_rent']}".' <p>/Month</p></div>';
                        }
                    }
                    echo<<<HTML
                        </div>
                        <a href="./room-details.php?id=$id"><button class="hero-button">View Details</button></a>
                    </div>
                    HTML;
                }
            }
            ?>
        </div>


<?php
include __DIR__ . '/../../Components/footer.php';
mysqli_close($conn);
?>
