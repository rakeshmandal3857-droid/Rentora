<?php
session_start();
include __DIR__ . '/../../config-db.php';
// session_unset();
// session_destroy();

if(isset($_SESSION['owner'])){
    echo "<script>window.location.href = '/rentora/pages/owner/add-accomodation.php';</script>";
    exit;
}
?>

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
    <link rel="stylesheet" href="./owner-home.css">
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
    <div class="toast-notification">
        
    </div>


    <button class="btn-primary" onclick="showOwnerLoginPopup()">List Your Property</button>

    <!-- owner log in popup  -->
    <div class="popup-card" id="owner-login-popup">
       <div class="popup-card-header">
           <span class="popup-heading">Log in</span>
           <i onclick="closePopup()" class="fa-solid icon fa-circle-xmark"></i>
       </div> <hr>
       <div class="popup-card-body log-in-popup-card-body">
        <div class="login-section">
            <form action="" method="post">
                    <div class="text-input">
                        <i class="fa-solid fa-phone"></i>
                        <input type="number" required maxlength="10" name="owner-log-in-mobile-number"placeholder="Enter your mobile number">
                    </div>
                    
                    <div class="text-input">
                        <i class="fa-solid fa-key"></i>
                        <input type="password" required name="owner-log-in-password" id="owner-log-in-password" placeholder="Enter your password">
                        <i onclick="toggleVisibility(this)" class="fa-solid fa-eye-slash"></i>
                    </div>
                    
                    <button class="hero-button" name="owner-log-in-submit">LOG IN</button>
                </form>
                <div class="signup-link"><p>Not a member? <span onclick="slideToSignin()">Sign up now</span></p></div>
            </div>
            
            <div class="signUp-section">
                <form action="" method="post">
                    <div class="text-input">
                        <i class="fa-solid fa-circle-user"></i>
                        <input type="text" required name="owner-name" id="owner-name" placeholder="Enter your full name">
                    </div>
                    <div class="text-input">
                        <i class="fa-solid fa-phone"></i>
                        <input type="tel" required pattern="[0-9]{10}" name="owner-mobile-number"placeholder="Enter your mobile number">
                    </div>
                    <div class="text-input">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" required name="owner-email" id="owner-email" placeholder="Enter your Email ID">
                    </div>

                    <div class="text-input">
                        <i class="fa-solid fa-key"></i>
                        <input type="password" required name="owner-create-pass" id="owner-create-pass" placeholder="Create your password">
                        <i onclick="toggleVisibility(this)" class="fa-solid fa-eye-slash"></i>
                    </div>
                    <div class="text-input">
                        <i class="fa-solid fa-key"></i>
                        <input type="password" required name="owner-confirm-pass" id="owner-confirm-pass" placeholder="Confirm your password">
                        <i onclick="toggleVisibility(this)" class="fa-solid fa-eye-slash"></i>
                    </div>

                    <button type="submit" name="owner-sign-up-submit" class="hero-button">SIGN UP</button>
            </form>
            <div class="signup-link"><p>Already have an account ?<span onclick="slideTologin()">Log In</span></p></div>
        </div>
       </div>
    </div>


    <!-- owner log in php code starts here  -->
     <?php 

     function ownerLogin($conn, $mobile, $pass){
        $sql = "SELECT * FROM `owners` WHERE mobile = '$mobile';";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);

            if(password_verify($pass, $row['pass'])){
                $_SESSION['owner'] = $row;
                echo "<script>window.location.href = '/rentora/pages/owner/add-accomodation.php';</script>";
                exit;
            }else{
                $_SESSION['status'] = 'error';
                $_SESSION['message'] = "Incorrect password. Please try again.";
                echo "<script>window.location.href = '/rentora/pages/owner/owner-home.php';</script>";
                exit;
            }
        }else{
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = "Account not found. Please sign up to log in.";
            echo "<script>window.location.href = '/rentora/pages/owner/owner-home.php';</script>";
            exit;
        }
     }

    //  owner log in 

    if(isset($_POST['owner-log-in-submit'])){
        $mobile = clean($_POST['owner-log-in-mobile-number']);
        $pass = clean($_POST['owner-log-in-password']);

        $_SESSION['status'] = 'success';
        $_SESSION['message'] = "You have logged in successfully.";

        ownerLogin($conn, $mobile, $pass);
    }

    //  owner sign up  

     if(isset($_POST['owner-sign-up-submit'])){
        $name = strtoupper(clean($_POST['owner-name']));
        $email = strtolower(clean($_POST['owner-email']));
        $mobile = clean($_POST['owner-mobile-number']);
        $pass = clean($_POST['owner-create-pass']);
        $confirmPass = clean($_POST['owner-confirm-pass']);
        $profileImg = '../../assets/images/user-profile-photo.png';


        if (empty($name) || empty($email) || empty($mobile) || empty($pass) || empty($confirmPass)) {
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = "Please fill in all required fields to sign up.";
            echo "<script>window.location.href = '/rentora/pages/owner/owner-home.php';</script>";
            exit;
        }

        if($pass !== $confirmPass){
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = "Passwords do not match.";
            echo "<script>window.location.href = '/rentora/pages/owner/owner-home.php';</script>";
            exit;
        }
        $sql = "SELECT * FROM `owners` WHERE mobile = $mobile;";
        $result = mysqli_query($conn, $sql);
        
        if(mysqli_num_rows($result) > 0){
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = "Number already registered. Log in.";
            echo "<script>window.location.href = '/rentora/pages/owner/owner-home.php';</script>";
            exit;
        }
        $sql = "SELECT * FROM `owners` WHERE email = '$email';";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = "Email already registered. Log in.";
            echo "<script>window.location.href = '/rentora/pages/owner/owner-home.php';</script>";
            exit;
        }

        $hashedPass = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `owners` (`name`, `email`, `mobile`, `pass`, `img_path`) VALUES ('$name', '$email', '$mobile', '$hashedPass', '$profileImg');";

        if(mysqli_query($conn, $sql)){
            $_SESSION['status'] = 'success';
            $_SESSION['message'] = "Welcome! Your account has been created.";

            ownerLogin($conn, $mobile, $pass);
        }else{
            $_SESSION['status'] = 'error';
            $_SESSION['message'] = "Error: Unable to Register.";
            echo "<script>window.location.href = '/rentora/pages/owner/owner-home.php';</script>";
            exit;
        }
     }
     ?>


    <script src="./owner-home.js"></script>

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

    <?php  
    if(isset($_SESSION['status'])){
        echo "<script>showToastNotification('".$_SESSION['status'] ."','". $_SESSION['message']."');</script>";
        unset($_SESSION['status']);
        unset($_SESSION['message']);
    }
    ?>
    
</body>
</html>