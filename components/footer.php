
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
                <form action="" method="post" class="chatbody-footer">
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

    
    <?php
    if(isset($_SESSION['tenant'])){
        $name   = ucfirst(strtolower($_SESSION['tenant']['name']));
        $mobile = $_SESSION['tenant']['mobile'];
        $email  = $_SESSION['tenant']['email'];
        $img    = $_SESSION['tenant']['img_path'];
        $checkedMale = (($_SESSION['tenant']['gender'] ?? '') === 'MALE') ? 'checked' : '';
        $checkedFeale = (($_SESSION['tenant']['gender'] ?? '') === 'FEMALE') ? 'checked' : '';
        $checkedOther = (($_SESSION['tenant']['gender'] ?? '') === 'OTHER') ? 'checked' : '';
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
                <!-- <li onclick="slidePofilePopup('wishlist')">
                    <i class="fa-regular fa-heart"></i> Wish Lists
                </li> -->
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
                        <label for="tenant-edit-user-name">Full Name: 
                            <div class="text-input">
                                <i class="fa-solid fa-circle-user"></i>
                                <input type="text" required name="tenant-edit-user-name" id="tenant-edit-user-name" value = "$name"  placeholder="Enter your full name">
                            </div>
                        </label>
                        <label for="tenant-edit-mobile-number">Mobile Number: 
                            <div class="text-input">
                                <i class="fa-solid fa-phone"></i>
                                <input type="tel" required pattern="[0-9]{10}" id="tenant-edit-mobile-number" name="tenant-edit-mobile-number" value = "$mobile" placeholder="Enter your mobile number">
                            </div>
                        </label>
                        <label for="tenant-edit-email">Email:
                            <div class="text-input">
                                <i class="fa-solid fa-envelope"></i>
                                <input type="email" required name="tenant-edit-email" id="tenant-edit-email" value = "$email" placeholder="Enter your Email ID">
                            </div>
                        </label>
            
                           <div class="radio-input">
                               <label>Gender : </label>
                               <label for="change-gender-male">
                                   <input required type="radio" id="change-gender-male" name="tenant-edit-gender" $checkedMale value="male"> Male
                               </label>
                               <label for="change-gender-female">
                                   <input required type="radio" id="change-gender-female" name="tenant-edit-gender" $checkedFemale value="female"> Female
                               </label>
                               <label for="change-gender-other">
                                   <input required type="radio" id="change-gender-other" name="tenant-edit-gender" $checkedOther value="other"> Other
                               </label>
                           </div>
            
                           <button type="submit" name="tenant-edit-submit" class="hero-button">Save Changes</button>
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
                               <input type="password" required name="tenant-old-pass" id="tenant-old-pass" placeholder="Enter your old password">
                               <i onclick="toggleVisibility(this)" class="fa-solid fa-eye-slash"></i>
                           </div>
                            <div class="text-input">
                               <i class="fa-solid fa-key"></i>
                               <input type="password" required name="tenant-change-create-pass" class="tenant-create-pass" placeholder="Enter a new password">
                               <i onclick="toggleVisibility(this)" class="fa-solid fa-eye-slash"></i>
                           </div>
                           <div class="text-input">
                               <i class="fa-solid fa-key"></i>
                               <input type="password" required name="tenant-change-confirm-pass" class="tenant-confirm-pass" placeholder="Confirm your new password">
                               <i onclick="toggleVisibility(this)" class="fa-solid fa-eye-slash"></i>
                           </div>
                           <button type="submit" name="change-password-submit" class="hero-button">Change password</button>
                   </form>
                </div>
                <!-- <div id="wishlistSlide">
                    <div class="popup-card-header">
                        <span>Wish Lists</span>
                        <i onclick="slideBackProfilePopup()" class="fa-solid fa-circle-left"></i>
                    </div>
                    <ul class="featured-properties-wrapper featured-properties-wrapper-wishlist-popup"></ul>
                </div> -->
                </div>
           </div>
        </div>
        HTML;
    }
    // change password php code starts from here 
    if(isset($_POST['change-password-submit'])){
        $userId = $_SESSION['tenant']['user_id'];

        $oldPass = $_POST['tenant-old-pass'];
        $newPass = $_POST['tenant-change-create-pass'];
        $newConfirmPass = $_POST['tenant-change-confirm-pass'];

        $sql = "SELECT * FROM `tenants` WHERE `user_id` = $userId;";
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

                $sql = "UPDATE `tenants` SET `pass` = '$newPassHash' WHERE `user_id` = $userId;";
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
    if(isset($_POST['tenant-edit-submit'])){
        $fullName = strtoupper(clean($_POST['tenant-edit-user-name']));
        $mobile = clean($_POST['tenant-edit-mobile-number']);
        $email = clean($_POST['tenant-edit-email']);
        $gender = strtoupper(clean($_POST['tenant-edit-gender']));
        $userId = (int)$_SESSION['tenant']['user_id'];

        if($fullName == strtoupper($_SESSION['tenant']['name']) && $mobile == $_SESSION['tenant']['mobile'] && strtoupper($email) == strtoupper($_SESSION['tenant']['email']) && $gender == strtoupper($_SESSION['tenant']['gender'])){
            $_SESSION['status'] = 'warning';
            $_SESSION['message'] = "Please update at least one personal detail to save changes.";
            echo "<script>window.location.href = window.location.href;</script>";
            exit;
        }

        $sql = "UPDATE `tenants` SET `name`= '$fullName',`email`= '$email' ,`mobile`= '$mobile',`gender`= '$gender' WHERE `user_id` = $userId";
        if(mysqli_query($conn, $sql)){
            $_SESSION['tenant']['name'] = ucwords(strtolower($fullName));
            $_SESSION['tenant']['email'] = $email;
            $_SESSION['tenant']['mobile'] = $mobile;
            $_SESSION['tenant']['gender'] = $gender;
            
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

    <!-- write a review form -->
    <div class="popup-card review-popup" id="review-popup">
       <div class="popup-card-header">
           <span>Share Your Experience</span>
           <i onclick="closePopup()" class="fa-solid icon fa-circle-xmark"></i>
       </div> <hr>
       <div class="popup-card-body">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <div class="rating-container">
                    <div class="stars">
                        <input type="radio" name="rating" id="star5" required value="5">
                        <label for="star5">★</label>

                        <input type="radio" name="rating" id="star4" required value="4">
                        <label for="star4">★</label>

                        <input type="radio" name="rating" id="star3" required value="3">
                        <label for="star3">★</label>

                        <input type="radio" name="rating" id="star2" required value="2">
                        <label for="star2">★</label>

                        <input type="radio" name="rating" id="star1" required value="1">
                        <label for="star1">★</label>
                    </div>

                    <textarea rows="4" cols="30" name="review" required placeholder="Share the details of your own experience."></textarea>
                    <div>
                        <button type="submit" name="review-button-submit" class="btn-primary">Submit Rating</button>
                    </div>
                </div>
            </form>
       </div>
    </div>
    
    <?php
    // write review php 
    if(isset($_POST['review-button-submit'])){
        if (isset($_SESSION['owner']) || isset($_SESSION['tenant'])){
            $rating = intval($_POST['rating']);
            $review = mysqli_real_escape_string($conn, $_POST['review']);
            if(isset($_SESSION['owner'])){
                $writerID = $_SESSION['owner']['user_id'];
                $userRole = 'owner';
            }elseif(isset($_SESSION['tenant'])){
                $writerID = $_SESSION['tenant']['user_id'];
                $userRole = 'tenant';
            }

            $sql = "INSERT INTO `testimonials` (`rating`, `review`, `writer_id`, `writer_role`) VALUES ('$rating', '$review', '$writerID', '$userRole');";
            if($result = mysqli_query($conn, $sql)){
                $_SESSION['status'] = 'success';
                $_SESSION['message'] = "Thank you for sharing your experience!";
                echo "<script>window.location.href = window.location.href;</script>";
                exit;
            }else{
                $_SESSION['status'] = 'error';
                $_SESSION['message'] = "Review submission failed. Please try again.";
                echo "<script>window.location.href = window.location.href;</script>";
                exit;
            }
        }else{
            $_SESSION['status'] = 'warning';
            $_SESSION['message'] = "Want to leave a review? Please log in first!";
            echo "<script>window.location.href = window.location.href;</script>";
            exit;
        }
    }
    
    ?>

    <div class="popup-card review-popup" id="review-accomodation-popup">
       <div class="popup-card-header">
           <span>Share Your Experience</span>
           <i onclick="closePopup()" class="fa-solid icon fa-circle-xmark"></i>
       </div> <hr>
       <div class="popup-card-body">
            <form action="" method="post">
                <div class="rating-container">
                    <div>For Amenities:
                        <div class="stars">
                            <input type="radio" name="amenities-rating" id="amenitiesStar5" required value="5">
                            <label for="amenitiesStar5">★</label>
    
                            <input type="radio" name="amenities-rating" id="amenitiesStar4" required value="4">
                            <label for="amenitiesStar4">★</label>
    
                            <input type="radio" name="amenities-rating" id="amenitiesStar3" required value="3">
                            <label for="amenitiesStar3">★</label>
    
                            <input type="radio" name="amenities-rating" id="amenitiesStar2" required value="2">
                            <label for="amenitiesStar2">★</label>
    
                            <input type="radio" name="amenities-rating" id="amenitiesStar1" required value="1">
                            <label for="amenitiesStar1">★</label>
                        </div>
                    </div>
                    <div>For Cleanliness:
                        <div class="stars">
                            <input type="radio" name="cleanliness-rating" id="cleanliness-star5" required value="5">
                            <label for="cleanliness-star5">★</label>
    
                            <input type="radio" name="cleanliness-rating" id="cleanliness-star4" required value="4">
                            <label for="cleanliness-star4">★</label>
    
                            <input type="radio" name="cleanliness-rating" id="cleanliness-star3" required value="3">
                            <label for="cleanliness-star3">★</label>
    
                            <input type="radio" name="cleanliness-rating" id="cleanliness-star2" required value="2">
                            <label for="cleanliness-star2">★</label>
    
                            <input type="radio" name="cleanliness-rating" id="cleanliness-star1" required value="1">
                            <label for="cleanliness-star1">★</label>
                        </div>
                    </div>
                    <div>For Communication:
                        <div class="stars">
                            <input type="radio" name="communication-rating" id="communication-star5" required value="5">
                            <label for="communication-star5">★</label>
    
                            <input type="radio" name="communication-rating" id="communication-star4" required value="4">
                            <label for="communication-star4">★</label>
    
                            <input type="radio" name="communication-rating" id="communication-star3" required value="3">
                            <label for="communication-star3">★</label>
    
                            <input type="radio" name="communication-rating" id="communication-star2" required value="2">
                            <label for="communication-star2">★</label>
    
                            <input type="radio" name="communication-rating" id="communication-star1" required value="1">
                            <label for="communication-star1">★</label>
                        </div>
                    </div>
                    <div>For Location:
                        <div class="stars">
                            <input type="radio" name="location-rating" id="location-star5" required value="5">
                            <label for="location-star5">★</label>
    
                            <input type="radio" name="location-rating" id="location-star4" required value="4">
                            <label for="location-star4">★</label>
    
                            <input type="radio" name="location-rating" id="location-star3" required value="3">
                            <label for="location-star3">★</label>
    
                            <input type="radio" name="location-rating" id="location-star2" required value="2">
                            <label for="location-star2">★</label>
    
                            <input type="radio" name="location-rating" id="location-star1" required value="1">
                            <label for="location-star1">★</label>
                        </div>
                    </div>
                    <div>For Value:
                        <div class="stars">
                            <input type="radio" name="value-rating" id="value-star5" required value="5">
                            <label for="value-star5">★</label>
    
                            <input type="radio" name="value-rating" id="value-star4" required value="4">
                            <label for="value-star4">★</label>
    
                            <input type="radio" name="value-rating" id="value-star3" required value="3">
                            <label for="value-star3">★</label>
    
                            <input type="radio" name="value-rating" id="value-star2" required value="2">
                            <label for="value-star2">★</label>
    
                            <input type="radio" name="value-rating" id="value-star1" required value="1">
                            <label for="value-star1">★</label>
                        </div>
                    </div>

                    <textarea rows="4" cols="30" name="accomodation-review" required placeholder="Share the details of your own experience."></textarea>
                    <div>
                        <button type="submit" name="accomodation-review-submit-button" class="btn-primary">Submit Rating</button>
                    </div>
                </div>
            </form>
       </div>
    </div>

    <!-- submittion of accomodation review is here  -->
    <?php
    if(isset($_POST['accomodation-review-submit-button'])){
        
        if(isset($_SESSION['tenant'])){
            $writerID = (int)$_SESSION['tenant']['user_id'];
            $accomodationID = (int)$_GET['id'];
            
            $sql = "SELECT `writer_id` FROM `accomodation_review` WHERE `accommodation_id`= $accomodationID AND `writer_id` = $writerID;";
            $result = mysqli_query($conn, $sql);
            
            if($result && mysqli_num_rows($result)> 0){
                $row = mysqli_fetch_assoc($result);
                if((int)$row['writer_id'] === $writerID){
                    $_SESSION['status'] = 'warning';
                    $_SESSION['message'] = "You’ve already shared your experience. Only one review is allowed.";
                    echo "<script>window.location.href = window.location.href;</script>";
                    exit;
                }
            }

            if(isset($_GET['id'])){
                $accomodationID = (int)$_GET['id'];
            }
            echo "<script>console.log(' called ');</script>";
            $writerID = (int)$_SESSION['tenant']['user_id'];
            $amenities = (int)$_POST['amenities-rating'];
            $cleanliness = (int)$_POST['cleanliness-rating'];
            $communication = (int)$_POST['communication-rating'];
            $location = (int)$_POST['location-rating'];
            $value = (int)$_POST['value-rating'];
            $overall = abs(($amenities + $cleanliness + $communication + $location + $value )/5);
            $review =($_POST['accomodation-review']);

            $sql = "INSERT INTO `accomodation_review`(`writer_id`, `amenities`, `cleanliness`, `communication`, `location`, `value`, `overall`, `accommodation_id`, `review`) VALUES ('$writerID','$amenities','$cleanliness','$communication','$location','$value','$overall','$accomodationID','$review')";

             if($result = mysqli_query($conn, $sql)){
                 $_SESSION['status'] = 'success';
                 $_SESSION['message'] = "Thank you for sharing your experience!";
                 echo "<script>window.location.href = window.location.href;</script>";
                 exit;
            }else{
                 $_SESSION['status'] = 'error';
                 $_SESSION['message'] = "Review submission failed. Please try again.";
                 echo "<script>window.location.href = window.location.href;</script>";
                 exit;
            }
        }else{
            $_SESSION['status'] = 'warning';
            $_SESSION['message'] = "Want to leave a review? Please log in first!";
            echo "<script>window.location.href = window.location.href;</script>";
            exit;
        }
    }
    ?>

    <?php 
    if(!isset($_SESSION['tenant'])){
        echo <<<HTML
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
                           <i class="fa-solid fa-phone"></i>
                           <input type="tel" required maxlength="10" name="tenant-login-mobile-number" placeholder="Enter your mobile number">
                       </div>
                       
                       <div class="text-input">
                           <i class="fa-solid fa-key"></i>
                           <input type="password" required name="tenant-login-password" id="tenant-login-password" placeholder="Enter your password">
                           <i onclick="toggleVisibility(this)" class="fa-solid fa-eye-slash"></i>
                       </div>
                       
                       <button class="hero-button" name="tenant-login-submit">LOG IN</button>
                   </form>
                   <div class="signup-link"><p>Not a member? <span onclick="slideToSignin()">Sign up now</span></p></div>
               </div>
               
               <div class="signUp-section">
                   <form action="" method="post">
                       <div class="text-input">
                           <i class="fa-solid fa-circle-user"></i>
                           <input type="text" required name="tenant-user-name" id="tenant-user-name" placeholder="Enter your full name">
                       </div>
                       <div class="text-input">
                           <i class="fa-solid fa-phone"></i>
                           <input type="tel" required pattern="[0-9]{10}" name="tenant-mobile-number" placeholder="Enter your mobile number">
                       </div>
                       <div class="text-input">
                           <i class="fa-solid fa-envelope"></i>
                           <input type="email" required name="tenant-email" id="tenant-email" placeholder="Enter your Email ID">
                       </div>
        
                       <div class="text-input">
                           <i class="fa-solid fa-key"></i>
                           <input type="password" required name="tenant-create-pass" class="tenant-create-pass" placeholder="Create your password">
                           <i onclick="toggleVisibility(this)" class="fa-solid fa-eye-slash"></i>
                       </div>
                       <div class="text-input">
                           <i class="fa-solid fa-key"></i>
                           <input type="password" required name="tenant-confirm-pass" class="tenant-confirm-pass" placeholder="Confirm your password">
                           <i onclick="toggleVisibility(this)" class="fa-solid fa-eye-slash"></i>
                       </div>
        
                       <div class="radio-input">
                           <label>Gender : </label>
                           <label for="male">
                               <input required type="radio" id="male" name="tenant-gender" value="male"> Male
                           </label>
                           <label for="female">
                               <input required type="radio" id="female" name="tenant-gender" value="female"> Female
                           </label>
                           <label for="other">
                               <input required type="radio" id="other" name="tenant-gender" value="other"> Other
                           </label>
                       </div>
        
                       <button type="submit" name="tenant-sign-up-submit" class="hero-button">SIGN UP</button>
               </form>
               <div class="signup-link"><p>Already have an account ?<span onclick="slideTologin()">Log In</span></p></div>
           </div>
          </div>
        </div>

        HTML;
    }
    ?>


    <!-- tenant login and sign up php starts here  -->

    <?php 

     function tenantLogin($conn, $mobile, $pass){
        $sql = "SELECT * FROM `tenants` WHERE mobile = '$mobile';";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);

            if(password_verify($pass, $row['pass'])){
                $_SESSION['tenant'] = $row;
                echo "<script>window.location.href = window.location.href;</script>";
                exit;
            }else{
                $_SESSION['status'] = 'error';
                $_SESSION['message'] = "Incorrect password. Please try again.";
                echo "<script>window.location.href = window.location.href;</script>";
                exit;
            }
        }else{
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = "Account not found. Please sign up to log in.";
            echo "<script>window.location.href = window.location.href;</script>";
            exit;
        }
     }

     //  tenant log in 

     if(isset($_POST['tenant-login-submit'])){
        $mobile = clean($_POST['tenant-login-mobile-number']);
        $pass = clean($_POST['tenant-login-password']);

        $_SESSION['status'] = 'success';
        $_SESSION['message'] = "You have logged in successfully.";
        tenantLogin($conn, $mobile, $pass);
     }

     // tenant sign up  

     if(isset($_POST['tenant-sign-up-submit'])){
        $name = strtoupper(clean($_POST['tenant-user-name']));
        $email = strtolower(clean($_POST['tenant-email']));
        $mobile = clean($_POST['tenant-mobile-number']);
        $pass = clean($_POST['tenant-create-pass']);
        $confirmPass = clean($_POST['tenant-confirm-pass']);
        $gender = strtoupper(clean($_POST['tenant-gender']));
        $profileImg = '../../assets/images/user-profile-photo.png';


        if (empty($name) || empty($email) || empty($mobile) || empty($pass) || empty($confirmPass)) {
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = "Please fill in all required fields to sign up.";
            echo "<script>window.location.href = window.location.href;</script>";
            exit;

        }

        if($pass !== $confirmPass){
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = "Passwords do not match.";
            echo "<script>window.location.href = window.location.href;</script>";
            exit;
        }
        $sql = "SELECT * FROM `tenants` WHERE mobile = '$mobile';";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0){
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = "Number already registered. Log in.";
            echo "<script>window.location.href = window.location.href;</script>";
            exit;
        }
        $sql = "SELECT * FROM `tenants` WHERE email = '$email';";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = "Email already registered. Log in.";
            echo "<script>window.location.href = window.location.href;</script>";
            exit;
        }

        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `tenants` (`name`, `email`, `mobile`, `gender`, `pass`, `img_path`) VALUES ('$name', '$email', '$mobile', '$gender', '$hashedPass', '$profileImg');";

        if(mysqli_query($conn, $sql)){
            echo "<script>console.log('called');</script>";
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = "Welcome! Your account has been created.";
            tenantLogin($conn, $mobile, $pass);
        }else{
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = "Unable to Register.";
            echo "<script>window.location.href = window.location.href;</script>";
            exit;
        }
     }
    ?>


    <footer id="footer">
        <section>
            <div>
                <a href="home.php"><div class="logo"><img src="../../assets/images/rentora-logo.png" alt="logo">Rentora</div></a>

                <p class="brand-description">Rentora delivers a transparent, tech-driven rental experience with verified properties and efficient management tools.</p>
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
                    <li><a href="#">Home</a></li>
                    <li><a target="_blank" href="../owner/owner-home.php">List Your Property</a></li>
                    <li><a href="./aboutUS.php">About US</a></li>
                    <li><a href="#footer">Contact</a></li>
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

