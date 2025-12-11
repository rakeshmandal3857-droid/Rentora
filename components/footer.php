
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
                           <input type="password" required name="tenant-create-pass" id="tenant-create-pass" placeholder="Create your password">
                           <i onclick="toggleVisibility(this)" class="fa-solid fa-eye-slash"></i>
                       </div>
                       <div class="text-input">
                           <i class="fa-solid fa-key"></i>
                           <input type="password" required name="tenant-confirm-pass" id="tenant-confirm-pass" placeholder="Confirm your password">
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
                echo "<script>window.location.href = '/rentora/pages/tenant/home.php';</script>";
            }else{
                echo "<script>alert('Invalid Password!');</script>";
                echo "<script>window.location.href = '/rentora/pages/tenant/home.php';</script>";
            }
        }else{
            echo "<script>alert('Mobile number not found!');</script>";
            echo "<script>window.location.href = '/rentora/pages/tenant/home.php';</script>";
        }
     }

     //  tenant log in 

     if(isset($_POST['tenant-login-submit'])){
        $mobile = clean($_POST['tenant-login-mobile-number']);
        $pass = clean($_POST['tenant-login-password']);

        tenantLogin($conn, $mobile, $pass);
        $_SESSION['tenant-status'] = 'log-in';
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
            echo "<script>alert('All fields are required!');</script>";
            echo "<script>window.location.href = '/rentora/pages/tenant/home.php';</script>";
            exit;
        }

        if($pass !== $confirmPass){
            echo "<script>alert('Passwords do not matched! ');</script>";
            echo "<script>window.location.href = '/rentora/pages/tenant/home.php';</script>";
            exit;
        }

        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `tenants` (`name`, `email`, `mobile`, `gender`, `pass`, `img_path`) VALUES ('$name', '$email', '$mobile', '$gender', '$hashedPass', '$profileImg');";

        if(mysqli_query($conn, $sql)){
            tenantLogin($conn, $mobile, $pass);
            $_SESSION['tenant-status'] = 'sign-up';
        }else{
            echo "<script>alert('Error : Unable to Register.');</script>";
            echo "<script>window.location.href = '/rentora/pages/tenant/home.php';</script>";
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
                    <li><a href="../owner/owner-home.php">List Your Property</a></li>
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
</body>
</html>