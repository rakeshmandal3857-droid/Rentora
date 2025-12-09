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
            <form action="" method="get">
                <label for="location">Location <i class="fa-solid fa-caret-down"></i>
                    <div class="text-input">
                        <i class="fa-solid fa-location-dot"></i>
                        <input type="text" name="location" id="location" placeholder="Location">
                    </div>
                </label>
                <label for="locality">Locality <i class="fa-solid fa-caret-down"></i>
                    <div class="text-input">
                        <i class="fa-solid fa-location-dot"></i>
                        <select name="locality" id="locality">
                            <option value="School Danga">School Danga</option>
                        </select>
                    </div>
                </label>
                <label for="acomodation-type">Acomodation Type <i class="fa-solid fa-caret-down"></i>
                    <div class="text-input">
                        <i class="fa-solid fa-location-dot"></i>
                        <select name="acomodation-type" id="acomodation-type">
                            <option value="Apertment">Apertment</option>
                        </select>
                    </div>
                </label>
                <button class="btn-primary">Search</button>
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
                        echo <<<HTML
                        <div class="city-card" id = "city-id-{$row['city_id']}">
                            <img src="{$row['city_img_path']}" alt="city name">
                            <div class="card-heading"> {$row['city_name'] }</div>
                        </div>
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
                <div class="card-heading">Secure Payments</div>
                <p>Integrated payment gateway for rent and deposits ensuring safety for both parties.</p>
            </div>
            <div class="card">
                <div class="icon-container"><i class="fa-solid fa-shield-halved"></i></div>
                <div class="card-heading">Varified Listings</div>
                <p>All properties are verified to ensure authenticity and quality.</p>
            </div>
            <div class="card">
                <div class="icon-container"><i class="fa-solid fa-file-invoice"></i></div>
                <div class="card-heading">Automated Monthly Bills</div>
                <p>Automatically generated monthly bills with clear breakdowns and easy transaction history access.</p>
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
                        <p>Chat directly with owners and schedule visits at your convenience.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="round-button">3</div>
                    <div class="step-info">
                        <div class="card-heading">Move In</div>
                        <p>Sign digital contracts, pay securely, and get the keys to your new home.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="featured-properties">
        <div class="section-heading">Featured Properties</div>
        <div class="desc">Handpicked properties for you.</div>
        <div class="featured-properties-wrapper">
            <div class="property-card">
                <div class="img-holder">
                    <img src="../../assets/images/demo-room-img.jpg" alt="room-images">
                    <button class="round-button" onclick="toggleWishlist(this)"><i class="fa-regular fa-heart"></i></button>
                    <p class="property-type">PG/Hostel</p>
                </div>
                <div class="info">
                    <div class="card-heading">Santra Mess</div>
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <p><i class="fa-solid fa-location-dot"></i> Ramananda Sarani, School Danga, Bankura</p>
                    <div class="price">₹ 1200 <p>/Month</p></div>
                    
                </div>
                <a href="./room-details.php?id=1"><button class="hero-button">View Details</button></a>
            </div>
            <div class="property-card">
                <div class="img-holder">
                    <img src="../../assets/images/demo-room-img.jpg" alt="room-images">
                    <button class="round-button" onclick="toggleWishlist(this)"><i class="fa-regular fa-heart"></i></button>
                    <p class="property-type">PG/Hostel</p>
                </div>
                <div class="info">
                    <div class="card-heading">Santra Mess</div>
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <p><i class="fa-solid fa-location-dot"></i> Ramananda Sarani, School Danga, Bankura</p>
                    <div class="price">₹ 1200 <p>/Month</p></div>
                    
                </div>
                <a href="./room-details.php?id=1"><button class="hero-button">View Details</button></a>
            </div>
            <div class="property-card">
                <div class="img-holder">
                    <img src="../../assets/images/demo-room-img.jpg" alt="room-images">
                    <button class="round-button" onclick="toggleWishlist(this)"><i class="fa-regular fa-heart"></i></button>
                    <p class="property-type">PG/Hostel</p>
                </div>
                <div class="info">
                    <div class="card-heading">Santra Mess</div>
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <p><i class="fa-solid fa-location-dot"></i> Ramananda Sarani, School Danga, Bankura</p>
                    <div class="price">₹ 1200 <p>/Month</p></div>
                    
                </div>
                <a href="./room-details.php?id=1"><button class="hero-button">View Details</button></a>
            </div>
            <div class="property-card">
                <div class="img-holder">
                    <img src="../../assets/images/demo-room-img.jpg" alt="room-images">
                    <button class="round-button" onclick="toggleWishlist(this)"><i class="fa-regular fa-heart"></i></button>
                    <p class="property-type">PG/Hostel</p>
                </div>
                <div class="info">
                    <div class="card-heading">Santra Mess</div>
                    <div class="rating">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <p><i class="fa-solid fa-location-dot"></i> Ramananda Sarani, School Danga, Bankura</p>
                    <div class="price">₹ 1200 <p>/Month</p></div>
                    
                </div>
                <a href="./room-details.php?id=1"><button class="hero-button">View Details</button></a>
            </div>

        </div>
    </section>
    <section id="testimonials-section">
        <div>
            <div class="section-heading">Loved by Tenants and Landlords Alike</div>
            <p>Don't just take our word for it. See what our community has to say about their experience with Rentora.</p>
            <div class="card-holder">
                <div class="card-2">
                    <div>15k+</div>
                    <p>properties Listed</p>
                </div>
                <div class="card-2">
                    <div>98%</div>
                    <p>Satisfaction Rate</p>
                </div>
            </div>
            <button class="btn-primary">Read More Stories</button>
        </div>
        <div class="slider-wrapper carousel">
            <button class="round-button left-button" onclick="prevSlide()"><i class="fa-solid fa-angle-left"></i></button>
            <button class="round-button right-button" onclick="nextSlide()"><i class="fa-solid fa-angle-right"></i></button>

            <div class="testimonials-slider">
                <div class="slide">
                    <div class="testimonials-card">
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <p> <i>"Rentora completely transformed how I manage my properties. The automated rent collection and maintenance tracking saves me hours every week. Highly recommended!"</i> </p>
                        <div>
                            <div class="profile-picture"></div>
                            <div>
                                <div>Rakesh Mandal</div>
                                <p>Property Owner</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="slide">
                    <div class="testimonials-card">
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <p> <i>"Rentora completely transformed how I manage my properties. The automated rent collection and maintenance tracking saves me hours every week. Highly recommended!"</i> </p>
                        <div>
                            <div class="profile-picture"></div>
                            <div>
                                <div>Rakesh Mandal</div>
                                <p>Property Owner</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="slide">
                    <div class="testimonials-card">
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <p> <i>"Rentora completely transformed how I manage my properties. The automated rent collection and maintenance tracking saves me hours every week. Highly recommended!"</i> </p>
                        <div>
                            <div class="profile-picture"></div>
                            <div>
                                <div>Rakesh Mandal</div>
                                <p>Property Owner</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="slide">
                    <div class="testimonials-card">
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <p> <i>"Rentora completely transformed how I manage my properties. The automated rent collection and maintenance tracking saves me hours every week. Highly recommended!"</i> </p>
                        <div>
                            <div class="profile-picture"></div>
                            <div>
                                <div>Rakesh Mandal</div>
                                <p>Property Owner</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="slide">
                    <div class="testimonials-card">
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <p> <i>"Rentora completely transformed how I manage my properties. The automated rent collection and maintenance tracking saves me hours every week. Highly recommended!"</i> </p>
                        <div>
                            <div class="profile-picture"></div>
                            <div>
                                <div>Rakesh Mandal</div>
                                <p>Property Owner</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="slide">
                    <div class="testimonials-card">
                        <div class="rating">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-regular fa-star"></i>
                        </div>
                        <p> <i>"Rentora completely transformed how I manage my properties. The automated rent collection and maintenance tracking saves me hours every week. Highly recommended!"</i> </p>
                        <div>
                            <div class="profile-picture"></div>
                            <div>
                                <div>Rakesh Mandal</div>
                                <p>Property Owner</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <section id="CTA-banner">
        <section>
            <div class="section-heading">Ready to find Your Next Home?</div>
            <div class="desc">Join thousands of happy tenants and landlords. Start exploring properties or list your own today.</div>
            <div class="buttons">
                <button id="browse-listing"><i class="fa-solid fa-magnifying-glass"></i> Browse Listings</button>
                <button id="list-your-property"><i class="fa-solid fa-plus"></i> List Your Property</button>
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
