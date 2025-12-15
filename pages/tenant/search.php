<?php
include __DIR__ . '/../../config-db.php';
include __DIR__ . '/../../Components/header.php';
?>
<link rel="stylesheet" href="./home.css">
<link rel="stylesheet" href="./search.css">
    <section id="hero-section">
            <form class="search-form" action="search.php" method="get">
                <label for="location">Location <i class="fa-solid fa-caret-down"></i>
                    <div class="text-input">
                        <i class="fa-solid fa-location-dot"></i>
                        <input type="text" name="location" id="location" placeholder="Location">
                    </div>
                </label>
                <label for="locality">Locality <i class="fa-solid fa-caret-down"></i>
                    <div class="text-input">
                        <i class="fa-solid fa-location-dot"></i>
                        <select name="locality" class="select-localities" id="locality">
                            
                        </select>
                    </div>
                </label>
                <label for="acomodation-type">Acomodation Type <i class="fa-solid fa-caret-down"></i>
                    <div class="text-input">
                        <i class="fa-solid fa-house-chimney"></i>
                        <select name="acomodation-type" id="acomodation-type">
                            <option value="All">All</option>
                            <option value="Hostel/PG">Hostel/PG</option>
                            <option value="Apartment">Apartment</option>
                            <option value="House">House</option>
                        </select>
                    </div>
                </label>
                <button class="btn-primary" name="search-button">Search</button>
            </form>
    </section>

        <div class="featured-properties-wrapper">
            <?php
            $location = $_GET['location'];
            $locality = $_GET['locality'];
            $accType = $_GET['acomodation-type'];
            $sql = "SELECT * FROM accommodation WHERE location = '$location' AND locality = '$locality' AND accommodation_type = '$accType';";
            $result = mysqli_query($conn, $sql);
            if($result && mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){
                    $id = $row['accommodation_id'];
                    $accType = ucwords(strtolower($row['accommodation_type']));
                    $accName = ucwords(strtolower($row['accommodation_name']));
                    $accAdd = $add = ucwords(strtolower($row['street_address'])) .", " . ucwords(strtolower($row['locality'])) .", " . ucwords(strtolower($row['location']))  .", " . $row['pincode'];
                    echo<<<HTML
                    <div class="property-card" id ="$id">
                        <div class="img-holder">
                            <img src="../../assets/images/demo-room-img.jpg" alt="room-images">
                            <button class="round-button" onclick="toggleWishlist(this)"><i class="fa-regular fa-heart"></i></button>
                            <p class="property-type">$accType</p>
                        </div>
                        <div class="info">
                            <div class="card-heading">$accName</div>
                            <div class="rating">
                                <div class="stars-bg"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                                <div class="stars-fill" style="width: 60%" ><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
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
