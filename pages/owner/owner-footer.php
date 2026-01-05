
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
    
    <!-- delete confirmation popup  -->
    <div class="popup-card" id="delete-confirmation-popup">
       
    </div>
    <?php
    if(isset($_SESSION['owner'])){
        $name   = ucfirst(strtolower($_SESSION['owner']['name']));
        $mobile = $_SESSION['owner']['mobile'];
        $email  = $_SESSION['owner']['email'];
        $img    = $_SESSION['owner']['img_path'];
        $checkedMale = (($_SESSION['owner']['gender'] ?? '') === 'MALE') ? 'checked' : '';
        $checkedFeale = (($_SESSION['owner']['gender'] ?? '') === 'FEMALE') ? 'checked' : '';
        $checkedOther = (($_SESSION['owner']['gender'] ?? '') === 'OTHER') ? 'checked' : '';
        echo<<<HTML
        <!-- profile popup  -->
        <div class="popup-card" id="profile-popup">
           <div class="popup-card-header">
                <div class="profile-picture">
                    <img src="$img" alt="profile-photo">
                </div>
                <div class="profile-info">
                    <div class="name">$name</div>
                    <p>$mobile</p>
                </div>
               <i onclick="closePopup()" class="fa-solid icon fa-circle-xmark"></i>
           </div> <hr>
           <div class="container" id="Profile-popup-container">
               <ul class="profile-card-options">
                <li onclick="slidePofilePopup('editPesonalData')">
                    <i class="fa-regular fa-circle-user"></i></i> Edit Personal Data
                </li>
                <li onclick="slidePofilePopup('changePassowrd')">
                    <i class="fa-solid fa-pen-to-square"></i> Change Password
                </li>
                <li>
                    <form action="" method="post"><button class="log-out-button" name="logout-button" type="submit"><i class="fa-solid fa-right-from-bracket"></i> Log out</button></form>
                </li>
               </ul>
               <div class="profile-slide">
                <div id="changePersonalDataSlide">
                    <div class="popup-card-header">
                        <span>Edit Personal data</span>
                        <i onclick="slideBackProfilePopup()" class="fa-solid fa-circle-left"></i>
                    </div>
                    <form action="" method="post">
                        <label for="owner-edit-user-name">Full Name: 
                            <div class="text-input">
                                <i class="fa-solid fa-circle-user"></i>
                                <input type="text" required name="owner-edit-user-name" id="owner-edit-user-name" value = "$name"  placeholder="Enter your full name">
                            </div>
                        </label>
                        <label for="owner-edit-mobile-number">Mobile Number: 
                            <div class="text-input">
                                <i class="fa-solid fa-phone"></i>
                                <input type="tel" required pattern="[0-9]{10}" id="owner-edit-mobile-number" name="owner-edit-mobile-number" value = "$mobile" placeholder="Enter your mobile number">
                            </div>
                        </label>
                        <label for="owner-edit-email">Email:
                            <div class="text-input">
                                <i class="fa-solid fa-envelope"></i>
                                <input type="email" required name="owner-edit-email" id="owner-edit-email" value = "$email" placeholder="Enter your Email ID">
                            </div>
                        </label>
            
                           <button type="submit" name="owner-edit-submit" class="hero-button">Save Changes</button>
                   </form>
                </div>
                <div id="changePasswordSlide">
                    <div class="popup-card-header">
                        <span>Change Password</span>
                        <i onclick="slideBackProfilePopup()" class="fa-solid fa-circle-left"></i>
                    </div>
                    <form action="" method="post">
                            <div class="text-input">
                               <i class="fa-solid fa-key"></i>
                               <input type="password" required name="owner-old-pass" id="owner-old-pass" placeholder="Enter your old password">
                               <i onclick="toggleVisibility(this)" class="fa-solid fa-eye-slash"></i>
                           </div>
                            <div class="text-input">
                               <i class="fa-solid fa-key"></i>
                               <input type="password" required name="owner-change-create-pass" class="owner-create-pass" placeholder="Enter a new password">
                               <i onclick="toggleVisibility(this)" class="fa-solid fa-eye-slash"></i>
                           </div>
                           <div class="text-input">
                               <i class="fa-solid fa-key"></i>
                               <input type="password" required name="owner-change-confirm-pass" class="owner-confirm-pass" placeholder="Confirm your new password">
                               <i onclick="toggleVisibility(this)" class="fa-solid fa-eye-slash"></i>
                           </div>
                           <button type="submit" name="change-password-submit" class="hero-button">Change password</button>
                   </form>
                </div>
                </div>
           </div>
        </div>
        HTML;
    }
    // change password php code starts from here 
    if(isset($_POST['change-password-submit'])){
        $userId = $_SESSION['owner']['user_id'];

        $oldPass = $_POST['owner-old-pass'];
        $newPass = $_POST['owner-change-create-pass'];
        $newConfirmPass = $_POST['owner-change-confirm-pass'];

        $sql = "SELECT * FROM `owners` WHERE `user_id` = $userId;";
        $result = mysqli_query($conn, $sql);

        if($result && mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);

            if(password_verify($oldPass, $row['pass'])){
                if($newPass !== $newConfirmPass){
                    $_SESSION['status'] = 'error';
                    $_SESSION['message'] = "Your new passwords do not match.";
                    echo "<script>window.location.href = window.location.href;</script>";
                    exit;
                }
        
                if(password_verify($newPass, $row['pass'])){
                    $_SESSION['status'] = 'warning';
                    $_SESSION['message'] = "Your new password must be different from your current password.";
                    echo "<script>window.location.href = window.location.href;</script>";
                    exit;
                }
                
                $newPassHash = password_hash($newPass, PASSWORD_DEFAULT);

                $sql = "UPDATE `owners` SET `pass` = '$newPassHash' WHERE `user_id` = $userId;";
                if(mysqli_query($conn, $sql)){
                    $_SESSION['status'] = 'success';
                    $_SESSION['message'] = "Your password has been changed successfully.";
                    echo "<script>window.location.href = window.location.href;</script>";
                    exit;
                }else{
                    $_SESSION['status'] = 'error';
                    $_SESSION['message'] = "Can't change your password. Try again!";
                    echo "<script>window.location.href = window.location.href;</script>";
                    exit;
                }
                
            }else{
                $_SESSION['status'] = 'error';
                $_SESSION['message'] = "Incorrect password. Please try again.";
                echo "<script>window.location.href = window.location.href;</script>";
                exit;
            }
        }


    }

    // change profile details section 
    if(isset($_POST['owner-edit-submit'])){
        $fullName = strtoupper(clean($_POST['owner-edit-user-name']));
        $mobile = clean($_POST['owner-edit-mobile-number']);
        $email = clean($_POST['owner-edit-email']);
        $userId = (int)$_SESSION['owner']['user_id'];

        if($fullName == strtoupper($_SESSION['owner']['name']) && $mobile == $_SESSION['owner']['mobile'] && strtoupper($email) == strtoupper($_SESSION['owner']['email']) && $gender == strtoupper($_SESSION['owner']['gender'])){
            $_SESSION['status'] = 'warning';
            $_SESSION['message'] = "Please update at least one personal detail to save changes.";
            echo "<script>window.location.href = window.location.href;</script>";
            exit;
        }

        $sql = "UPDATE `owners` SET `name`= '$fullName',`email`= '$email' ,`mobile`= '$mobile' WHERE `user_id` = $userId";
        if(mysqli_query($conn, $sql)){
            $_SESSION['owner']['name'] = ucwords(strtolower($fullName));
            $_SESSION['owner']['email'] = $email;
            $_SESSION['owner']['mobile'] = $mobile;
            
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = "Your personal information was updated successfully.";
            echo "<script>window.location.href = window.location.href;</script>";
            exit;
        }else{
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = "We couldn’t update your information. Please try again later.";
            echo "<script>window.location.href = window.location.href;</script>";
            exit;
        }
    }

    ?>

    <footer id="footer">
        <section>
            <div>
                <a href="home.php"><div class="logo"><img src="../../assets/images/rentora-logo.png" alt="logo">Rentora</div></a>

                <p class="brand-description">Rentora delivers a transparent, tech-driven rental experience with verified properties, secure payments, and efficient management tools.</p>
                <div>
                    <ul class="social-links">
                        <li><a href=""><i class="fa-brands icon fa-facebook"></i> </a></li>
                        <li><a href=""><i class="fa-brands icon fa-twitter"></i> </a></li>
                        <li><a href=""><i class="fa-brands icon fa-instagram"></i> </a></li>
                        <li><a href=""><i class="fa-brands icon fa-linkedin"></i> </a></li>
                    </ul>
                </div>
            </div>

            <div>
                <div class="heading">Quick Links</div>
                <ul>
                    <li><a href="../owner/home.php">Home</a></li>
                    <li><a href="./owner-home.php">List Your Property</a></li>
                    <li><a href="../owner/aboutUs.php">About US</a></li>
                    <li><a href="../owner/home.php#footer">Contact</a></li>
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
    <?php  
    if(isset($_SESSION['status'])){
        echo "<script>showToastNotification('".$_SESSION['status'] ."','". $_SESSION['message']."');</script>";
        unset($_SESSION['status']);
        unset($_SESSION['message']);
    }
    ?>
</body>
</html>

<?php
mysqli_close($conn);
?>