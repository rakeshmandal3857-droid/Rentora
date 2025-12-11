<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="../../assets/images/rentora-logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../../assets/css/main.css">
    <link rel="stylesheet" href="../../components/header.css">
    <link rel="stylesheet" href="../../components/footer.css">
    <link rel="stylesheet" href="./add-accomodation.css">
    <title>Rentora : Your Journey to a Better Stay Starts Here.</title>
</head>
<body>
    <header>
        <section class="header_offer_section">Book your bed/room directly with us and get flat 10% OFF.</section>

        <nav><a href="home.php"><div class="logo"><img src="../../assets/images/rentora-logo.png" alt="logo">Rentora</div></a>
            
            
            <section class="header-mid">
                <a href="../tenant/home.php">Home</a>
                <a class="active" href="owner-home.php">List your Property</a>
                <a href="../tenant/aboutUs.php">About Us</a>
                <a href="../tenant/home.php#footer">Contact</a>
            </section>
    
            <section class="header-right">
                <button class="round-button" id="menu-button"><i class="fa-solid icon fa-list"></i></button>
                <button class="round-button" id="massages-button"> <i class="fa-brands icon fa-facebook-messenger"></i></i></button>
                <button class="round-button" id="notification-button"><i class="fa-solid icon fa-bell"></i></button>
            </section>
        </nav>
    </header>

    <div class="body">
        <nav class="owner-nav">
            <ul>
                <a href="#"><li class="active">Add Accommodation</li></a>
            </ul>
        </nav>
        <div class="wrapper">
            <h2>Add Accommodation</h2>

            <form action="save_accommodation.php" method="POST" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Accommodation Name</label>
                    <input type="text" name="name" required>
                </div>

                <div class="form-group">
                    <label>Accommodation Images (Multiple)</label>
                    <input type="file" name="images[]" multiple required>
                </div>

                <div class="form-group">
                    <label>Accommodation Type</label>
                    <select name="type" required>
                        <option value="Hostel/PG">Hostel/PG</option>
                        <option value="Apartment">Apartment</option>
                        <option value="House">House</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Location</label>
                    <input type="text" name="location" required>
                </div>

                <div class="form-group">
                    <label>Google Map Link</label>
                    <input type="url" name="google_link">
                </div>

                <div class="form-group">
                    <label>Description & Rules</label>
                    <textarea name="description" rows="4"></textarea>
                </div>

                <div class="form-group">
                    <label>Amenities</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" name="amenities[]" value="High-speed Wi-Fi"> High-speed Wi-Fi</label>
                        <label><input type="checkbox" name="amenities[]" value="24x7 Water Supply"> 24×7 Water Supply</label>
                        <label><input type="checkbox" name="amenities[]" value="RO / Filtered Drinking Water"> RO / Filtered Drinking Water</label>
                        <label><input type="checkbox" name="amenities[]" value="Electricity Backup / Inverter"> Electricity Backup / Inverter</label>
                        <label><input type="checkbox" name="amenities[]" value="Power Backup"> Power Backup</label>
                        <label><input type="checkbox" name="amenities[]" value="Parking"> Parking</label>
                        <label><input type="checkbox" name="amenities[]" value="Hot Water (Geyser)"> Hot Water (Geyser)</label>
                        <label><input type="checkbox" name="amenities[]" value="Air Conditioning (AC)"> Air Conditioning (AC)</label>
                        <label><input type="checkbox" name="amenities[]" value="Ceiling Fan"> Ceiling Fan</label>
                        <label><input type="checkbox" name="amenities[]" value="Lift / Elevator"> Lift / Elevator</label>

                        <label><input type="checkbox" name="amenities[]" value="Daily/Weekly Cleaning"> Daily/Weekly Cleaning</label>
                        <label><input type="checkbox" name="amenities[]" value="Laundry Service"> Laundry Service</label>
                        <label><input type="checkbox" name="amenities[]" value="Housekeeping Staff"> Housekeeping Staff</label>
                        <label><input type="checkbox" name="amenities[]" value="Trash Disposal"> Trash Disposal</label>
                        <label><input type="checkbox" name="amenities[]" value="Room Service"> Room Service</label>

                        <label><input type="checkbox" name="amenities[]" value="CCTV Surveillance"> CCTV Surveillance</label>
                        <label><input type="checkbox" name="amenities[]" value="Biometric / Smart Lock Entry"> Biometric / Smart Lock Entry</label>
                        <label><input type="checkbox" name="amenities[]" value="Security Guard"> Security Guard</label>
                        <label><input type="checkbox" name="amenities[]" value="Fire Safety System"> Fire Safety System</label>

                        <label><input type="checkbox" name="amenities[]" value="Mess / Meal Service"> Mess / Meal Service</label>
                        <label><input type="checkbox" name="amenities[]" value="Community Kitchen"> Community Kitchen</label>

                        <label><input type="checkbox" name="amenities[]" value="Common Dining Area"> Common Dining Area</label>
                        <label><input type="checkbox" name="amenities[]" value="Common Hall / Lounge"> Common Hall / Lounge</label>
                        <label><input type="checkbox" name="amenities[]" value="Gym / Fitness Area"> Gym / Fitness Area</label>
                        <label><input type="checkbox" name="amenities[]" value="Rooftop Access"> Rooftop Access</label>
                        <label><input type="checkbox" name="amenities[]" value="Garden Area"> Garden Area</label>
                        <label><input type="checkbox" name="amenities[]" value="Co-working Space"> Co-working Space</label>
                        <label><input type="checkbox" name="amenities[]" value="Guest Allowance Policy"> Guest Allowance Policy</label>
                    </div>
                </div>

                <hr>

                <h3>Rooms</h3>
                <div id="roomContainer"></div>

                <button type="button" class="btn-primary" onclick="addRoom()">+ Add Room</button>

                <br><br>
                <button type="submit" class="btn">Save Accommodation</button>

            </form>        
        </div>
    </div>


    <script src="./add-accomodation.js"></script>

    <!-- pop ups -->

    <div class="popup-background"></div>
    
    <!-- massage pop up -->
    <div class="popup-card" id="massage-popup">
       <div class="popup-card-header">
           <span>Massages</span>
           <div>
               <i onclick="maximize()" class="fa-solid icon fa-maximize"></i>
               <i class="fa-solid icon fa-gear"></i>
               <i onclick="closePopup()" class="fa-solid icon fa-circle-xmark"></i>
           </div>
       </div> <hr>
       <div class="popup-card-body">
            <div class="card-aside">
                <div class="text-input">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search...">
                </div>
                <ul>
                    <li>
                        <div class="profile-picture"></div>
                        <div class="profile-info">
                            <div class="name">Rakesh Mandal</div>
                            <p class="last-message">kire bhai kemon achis ?</p>
                        </div>
                    </li>
                    <li class="active">
                        <div class="profile-picture"></div>
                        <div class="profile-info">
                            <div class="name">Rakesh Mandal</div>
                            <p class="last-message">kire bhai kemon achis ?</p>
                        </div>
                    </li>
                    <li>
                        <div class="profile-picture"></div>
                        <div class="profile-info">
                            <div class="name">Rakesh Mandal</div>
                            <p class="last-message">kire bhai kemon achis ?</p>
                        </div>
                    </li>
                    <li>
                        <div class="profile-picture"></div>
                        <div class="profile-info">
                            <div class="name">Rakesh Mandal</div>
                            <p class="last-message">kire bhai kemon achis ?</p>
                        </div>
                    </li>
                    <li>
                        <div class="profile-picture"></div>
                        <div class="profile-info">
                            <div class="name">Rakesh Mandal</div>
                            <p class="last-message">kire bhai kemon achis ?</p>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="chatbody">
                <div class="chatbody-header">
                    <div class="profile-picture"> <img src="../../assets/images/profile-picutre.jpeg" alt="profile picture"></div>
                    <div class="profile-info">
                        <div class="name">Rakesh Mandal</div>
                        <p>Active</p>
                    </div>
                    <i class="fa-solid icon fa-circle-xmark"></i>
                </div>
                <ul>
                    <li class="send">
                        <div class="profile-picture"></div>
                        <div class="message">Kire bhai kemon achis ?</div>
                    </li>
                    <li class="received">
                        <div class="profile-picture"></div>
                        <div class="message">hmm.. bhalo! tui kemon achis ? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit, deleniti. Laboriosam quis commodi fuga impedit placeat, consequatur aliquid molestiae aliquam excepturi explicabo facilis rem maiores accusamus ipsum perferendis autem et.</div>
                    </li>
                </ul>
                <form action="" method="_POST" class="chatbody-footer">
                    <div class="text-input">
                        <input type="text" placeholder="Type a message...">
                    </div>
                    <button type="submit" class="round-button"><i class="fa-solid fa-paper-plane"></i></button>
                </form>
            </div>
       </div>
    </div>
    
    <!-- notifications popup -->
    <div class="popup-card" id="notification-popup">
       <div class="popup-card-header">
           <span>Notifications</span>
           <i onclick="closePopup()" class="fa-solid icon fa-circle-xmark"></i>
       </div> <hr>
    </div>
    
         <!-- user login popup -->
    <div class="popup-card" id="login-popup">
       <div class="popup-card-header">
           <span class="popup-heading">Log in</span>
           <i onclick="closePopup()" class="fa-solid icon fa-circle-xmark"></i>
       </div> <hr>
       <div class="popup-card-body log-in-popup-card-body">
        <div class="login-section">
            <form action="" method="post">
                    <div class="text-input">
                        <i class="fa-solid fa-circle-user"></i>
                        <input type="number" required maxlength="10" name="user-id" id="user-id" placeholder="Enter your User ID">
                    </div>
                    
                    <div class="text-input">
                        <i class="fa-solid fa-key"></i>
                        <input type="password" required name="password" id="password" placeholder="Enter your password">
                        <i onclick="toggleVisibility(this)" class="fa-solid fa-eye-slash"></i>
                    </div>
                    
                    <button class="hero-button">LOG IN</button>
                </form>
                <div class="signup-link"><p>Not a member? <span onclick="slideToSignin()">Sign up now</span></p></div>
            </div>
            
            <div class="signUp-section">
                <form action="" method="post">
                    <div class="text-input">
                        <i class="fa-solid fa-circle-user"></i>
                        <input type="text" required name="user-name" id="user-name" placeholder="Enter your full name">
                    </div>
                    <div class="text-input">
                        <i class="fa-solid fa-circle-user"></i>
                        <input type="tel" required pattern="[0-9]{10}" name="mobile-number" id="mobile-number" placeholder="Enter your mobile number">
                    </div>
                    <div class="text-input">
                        <i class="fa-solid fa-circle-user"></i>
                        <input type="email" required name="email" id="email" placeholder="Enter your Email ID">
                    </div>

                    <div class="text-input">
                        <i class="fa-solid fa-key"></i>
                        <input type="password" required name="create-pass" id="create-pass" placeholder="Create your password">
                        <i onclick="toggleVisibility(this)" class="fa-solid fa-eye-slash"></i>
                    </div>
                    <div class="text-input">
                        <i class="fa-solid fa-key"></i>
                        <input type="password" required name="confirm-pass" id="confirm-pass" placeholder="Confirm your password">
                        <i onclick="toggleVisibility(this)" class="fa-solid fa-eye-slash"></i>
                    </div>

                    <div class="radio-input">
                        <label>Gender : </label>
                        <label for="male">
                            <input required type="radio" id="male" name="gender" value="male"> Male
                        </label>
                        <label for="female">
                            <input required type="radio" id="female" name="gender" value="female"> Female
                        </label>
                        <label for="other">
                            <input required type="radio" id="other" name="gender" value="other"> Other
                        </label>
                    </div>

                    <button type="submit" class="hero-button">SIGN UP</button>
            </form>
            <div class="signup-link"><p>Already have an account ?<span onclick="slideTologin()">Log In</span></p></div>
        </div>
       </div>
    </div>

    <footer id="footer">
        <section>
            <div>
                <a href="home.php"><div class="logo"><img src="../../assets/images/rentora-logo.png" alt="logo">Rentora</div></a>

                <p class="brand-description">Rentora delivers a transparent, tech-driven rental experience with verified properties, secure payments, and efficient management tools.</p>
                <div>
                    <ul class="social-links">
                        <li><a href=""><i class="fa-brands icon fa-facebook"></i> </a></li>
                        <li><a href=""><i class="fa-brands icon fa-twitter"></i></i> </a></li>
                        <li><a href=""><i class="fa-brands icon fa-instagram"></i> </a></li>
                        <li><a href=""><i class="fa-brands icon fa-linkedin"></i> </a></li>
                    </ul>
                </div>
            </div>

            <div>
                <div class="heading">Quick Links</div>
                <ul>
                    <li><a href="../tenant/home.php">Home</a></li>
                    <li><a href="./owner-home.php">List Your Property</a></li>
                    <li><a href="../tenant/aboutUs.php">About US</a></li>
                    <li><a href="../tenant/home.php#footer">Contact</a></li>
                </ul>
            </div>

            <div>
                <div class="heading">Support</div>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Blogs</a></li>
                </ul>
            </div>

            <div>
                <div class="heading" id="contact-us">Contact Us</div>
                <ul>
                    <li><a href="tel:+919547085012" target="_blank"><i class="fa-solid fa-phone-volume"></i> +91 9547085012</a></li>
                    <li><a href="mailto:rakeshmandal3857@gmail.com" target="_blank"><i class="fa-solid fa-envelope"></i> rakeshmandal3857@gmail.com</a></li>
                    <li><a href="https://maps.app.goo.gl/9GYHLKPfoUmU8eRn8" target="_blank"><i class="fa-solid fa-location-dot"></i>Ramananda Sarani, School Danga, Bankura, 722101</a></li>
                </ul>
            </div>
        </section>

        <div>
            <div>
                <p>©2025 Rentora. All rights reserved.</p>
            </div>
            <ul>
                <li><a href="">Privecy Policy</a></li>
                <li><a href="">Terms of Service</a></li>
                <li><a href="">Cookie Policy</a></li>
            </ul>
        </div>

    </footer>

    <script src="../../components//footer.js"></script>
    <script src="../../assets/js/main.js"></script>
</body>
</html>