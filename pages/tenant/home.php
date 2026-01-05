<?php
include __DIR__ . '/../../config-db.php';
include __DIR__ . '/../../Components/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <section id="hero-section">
        <video autoplay muted loop playsinline>
            <source src="../../assets/images/0_Real_Estate_Property_3840x2160.mp4" type="video/mp4">
        </video>

        <div class="hero-section-text">
            <div class="badge">
                <i class="fa-solid fa-star"></i>
                <p>#1 Rental Management Platform</p>
            </div>
            <div class="section-heading">Find the Perfect <span>Rental Home</span> With Ease </div>
            <div class="desc">Smart, fast and transparent rental accommodation management for owners and tenants. Experience hassle-free living today.</div>
            <button class="hero-button"> Start your search</button>
            <div class="bottom-badges"><div><i class="fa-solid fa-circle-check"></i>Varified Owners</div><div><i class="fa-solid fa-circle-check"></i>No Hidden Fees</div></div>
        </div>
        <div class="glass-section">
            <form action="search.php" method="get">
                <label for="location">Location <i class="fa-solid fa-caret-down"></i>
                    <div class="text-input">
                        <i class="fa-solid fa-location-dot"></i>
                        <input type="text" name="location" id="location" required placeholder="Location">
                    </div>
                </label>
                <label for="locality">Locality <i class="fa-solid fa-caret-down"></i>
                    <div class="text-input">
                        <i class="fa-solid fa-location-dot"></i>
                        <select name="locality" class="select-localities" required id="locality">
                            <option value="ALL">All</option>
                        </select>
                    </div>
                </label>
                <label for="acomodation-type">Acomodation Type <i class="fa-solid fa-caret-down"></i>
                    <div class="text-input">
                        <i class="fa-solid fa-house-chimney"></i>
                        <select name="acomodation-type" required id="acomodation-type">
                            <option value="ALL">All</option>
                            <option value="Hostel/PG">Hostel/PG</option>
                            <option value="Apartment">Apartment</option>
                            <option value="House">House</option>
                        </select>
                    </div>
                </label>
                <button class="btn-primary" name="search-button">Search</button>
            </form>

            <div class="service-location-section">
                <div class="section-heading">Where Our Rentals Are Available :</div>
                <div class="slider-wrapper">
                    <button class="round-button left-button" onclick="scrollToRight()"><i class="fa-solid fa-angle-left"></i></button>
                    <button class="round-button right-button" onclick="scrollToLeft()"><i class="fa-solid fa-angle-right"></i></button>

                    <div class="slider">
                        <?php
                        $quary = "SELECT * FROM `city`;";
                        $result = mysqli_query($conn, $quary);

                        while($row = mysqli_fetch_assoc($result)){
                            $cityName = ucfirst(strtolower($row['city_name']));
                        echo <<<HTML
                        <a href="./search.php?location=$cityName&locality=All&acomodation-type=All&search-button=">
                            <div class="city-card" id = "city-id-{$row['city_id']}">
                                <img src="{$row['city_img_path']}" alt="city name">
                                <div class="card-heading"> $cityName</div>
                            </div>
                        </a>
                        HTML;
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="features-section">
        <div class="section-heading">Everything You Need in One Platform</div>
        <div class="desc">We streamline the entire rental journey, making it simple, secure, and satisfying for everyone involved.</div>

        <div class="card-wrapper">
            <div class="card">
                <div class="icon-container"><i class="fa-solid fa-magnifying-glass"></i></div>
                <div class="card-heading">Smart Search</div>
                <p>Advanced filters to help you find the exact property that fits your lifestyle and budget.</p>
            </div>
            <div class="card">
                <div class="icon-container"><i class="fa-solid fa-wallet"></i></div>
                <div class="card-heading">Detailed Property Profiles</div>
                <p>High-quality photos, amenities, rules, and full descriptions to help you make informed decisions.</p>
            </div>
            <div class="card">
                <div class="icon-container"><i class="fa-solid fa-shield-halved"></i></div>
                <div class="card-heading">Varified Listings</div>
                <p>All properties are verified to ensure authenticity and quality.</p>
            </div>
            <div class="card">
                <div class="icon-container"><i class="fa-solid fa-file-invoice"></i></div>
                <div class="card-heading"> Real User Reviews</div>
                <p>Read honest reviews from previous tenants to better understand the living experience.</p>
            </div>
        </div>

    </section>

    <section id="working-process-section">
        <div class="blue-container">
            <div class="section-heading">How It Works</div>
            <div class="desc">Three simple steps to your new home.</div>
            
            <div class="wrapper">
                <div class="connector"></div>
                <div class="step">
                    <div class="round-button">1</div>
                    <div class="step-info">
                        <div class="card-heading">Browse Listings</div>
                        <p>Explore thousands of verified properties with detailed photos and amenities.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="round-button">2</div>
                    <div class="step-info">
                        <div class="card-heading">Connect & Visit</div>
                        <p>Call property owners directly to schedule visits at your convenience.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="round-button">3</div>
                    <div class="step-info">
                        <div class="card-heading">Move In</div>
                        <p>Finalize the agreement offline and move into your new home without any hassle.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="featured-properties">
        <div class="section-heading">Featured Properties</div>
        <div class="desc">Handpicked properties for you.</div>
        <ul class="featured-properties-wrapper">
            <?php
            $sql = "SELECT * FROM `accommodation` GROUP BY `location` LIMIT 4;";
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
                    <li class="property-card" id ="$id">
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
                        }else{
                            $avgRatingPercent = 0;
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
                    </li>
                    HTML;
                }
            }
            ?>
        </ul>
    </section>

    <section id="testimonials-section">
        <div>
            <div class="section-heading">Loved by Tenants and Landlords Alike</div>
            <p>Don't just take our word for it. See what our community has to say about their experience with Rentora.</p>
            <div class="card-holder">
                <div class="card-2">
                    <?php
                    $sql ="SELECT COUNT(`accommodation_id`) AS acc_count FROM `accommodation`;";
                    $result = mysqli_query($conn, $sql);
                    if($result && mysqli_num_rows($result)){
                        if($row = mysqli_fetch_assoc($result)){
                            $num = formatNumber($row['acc_count']);
                            echo<<<HTML
                            <div>$num</div>
                            HTML;
                        }
                    }
                    ?>
                    <p>properties Listed</p>
                </div>
                <div class="card-2">
                    <?php
                    $sql ="SELECT AVG(`rating`) AS `avg_rating` FROM `testimonials`;";
                    $result = mysqli_query($conn, $sql);
                    if($result && mysqli_num_rows($result)){
                        if($row = mysqli_fetch_assoc($result)){
                            $satisfactionRate = abs((($row['avg_rating'])/5)*100);
                            echo<<<HTML
                            <div>$satisfactionRate%</div>
                            HTML;
                        }
                    }
                    ?>
                    <p>Satisfaction Rate</p>
                </div>
            </div>
            <button class="btn-primary" onclick="showReviewForm()" >Write a Review</button>
        </div>
        <div class="slider-wrapper carousel">
            <button class="round-button left-button" onclick="prevSlide()"><i class="fa-solid fa-angle-left"></i></button>
            <button class="round-button right-button" onclick="nextSlide()"><i class="fa-solid fa-angle-right"></i></button>

            <ul class="testimonials-slider">
                <?php
                $sql = "SELECT * FROM `testimonials`;";
                $result = mysqli_query($conn, $sql);

                if($result && mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        $writerRole = $row['writer_role'];
                        $writerID = (int)$row['writer_id'];
                        $rating = (int)$row['rating'];
                        if(strlen($row['review']) > 200){
                            $reviewWords = explode(" " ,$row['review']);
                            $review = implode(" ", array_slice($reviewWords, 0, 25)) . "...";
                        }else{
                            $review = $row['review'];
                        }
                        $persentage = (($rating/5)*100);
                        if($writerRole == "owner"){
                            $writerSql = "SELECT `name`,`img_path` FROM `owners` WHERE `user_id` = $writerID;";
                            $writerRole = "Property Owner";
                        }else{
                            $writerSql = "SELECT `name`,`img_path` FROM `tenants` WHERE `user_id` = $writerID;";
                            $writerRole = "User";
                        }

                        $writerResult = mysqli_query($conn, $writerSql);

                        if($writerResult && mysqli_num_rows($writerResult) == 1){
                            $writerRow = mysqli_fetch_assoc($writerResult);
                            $writerName = ucwords(strtolower($writerRow['name']));
                            $writerImg = $writerRow['img_path'];
                            echo<<<HTML
                            <li class="slide">
                                <div class="testimonials-card">
                                    <div class="rating">
                                        <div class="stars-bg"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                                        <div class="stars-fill" style="width: {$persentage}%" ><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></div>
                                    </div>
                                    <p> <i>"$review"</i> </p>
                                    <div>
                                        <div class="profile-picture">
                                            <img src="$writerImg" alt="profile-picture">
                                        </div>
                                        <div>
                                            <div>$writerName</div>
                                            <p>$writerRole</p>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            HTML;
                        }
                    }
                }
                ?>
            </ul>
        </div>
    </section>

    <section id="CTA-banner">
        <section>
            <div class="section-heading">Ready to find Your Next Home?</div>
            <div class="desc">Join thousands of happy tenants and landlords. Start exploring properties or list your own today.</div>
            <div class="buttons">
                <button onclick="scrollToTop()" id="browse-listing"><i class="fa-solid fa-magnifying-glass"></i> Browse Listings</button>
                <a href="../owner/owner-home.php"><button id="list-your-property"><i class="fa-solid fa-plus"></i> List Your Property</button></a>
            </section>
        </div>
    </section>

    <script src="./home.js"></script>
</body>
</html>


<?php
include __DIR__ . '/../../Components/footer.php';
mysqli_close($conn);
?>
