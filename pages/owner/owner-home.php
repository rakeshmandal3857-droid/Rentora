<?php
session_start();
include __DIR__ . '/owner-header.php';
// session_unset();
// session_destroy();

if(isset($_SESSION['owner'])){
    echo "<script>window.location.href = '/rentora/pages/owner/add-accomodation.php';</script>";
    exit;
}
?>
    <link rel="stylesheet" href="./owner-home.css">
    <div class="hero-section">
        <img src="../../assets/images/building-view-from-sunset.jpg" alt="">

        <div class="heroText">
            <div class="heading">List Your Property for Free & Boost Your Earnings Instantly</div>
            <div class="desc">Register your hotel on EaseMyTrip and enjoy profitability with global reach today.</div>
            <button class="property-button" onclick="showOwnerLoginPopup()">List Your Property</button>
        </div>
    </div>

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
<?php
include __DIR__ . "/owner-footer.php";
?>