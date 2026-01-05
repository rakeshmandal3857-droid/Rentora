<?php
session_start();
include __DIR__ . '/../../config-db.php';
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
    <title>Rentora : Your Journey to a Better Stay Starts Here.</title>
</head>
<body>
    <header>
        <!-- <section class="header_offer_section">Book your bed/room directly with us and get flat 10% OFF.</section> -->

        <nav><a href="home.php"><div class="logo"><img src="../../assets/images/rentora-logo.png" alt="logo">Rentora</div></a>
            
            <div class="overlay">
                <section class="header-mid">
                    <a id="home" class="active" href="home.php">Home</a>
                    <a href="../owner/owner-home.php" id="owner-login-button">List your Property</a>
                    <a id="about-us" href="./aboutUs.php">About Us</a>
                    <a id="contact" href="#footer">Contact</a>
                </section>
            </div>
    
            <section class="header-right">
                <button class="round-button" id="menu-button"><i class="fa-solid icon fa-list"></i></button>

                <?php 
                if(!isset($_SESSION['tenant'])){
                    echo <<<HTML
                    <button class="btn-primary" id="login-button">Log in / Sign up</button>
                    HTML;
                }else{
                    $profilePhoto = $_SESSION['tenant']['img_path'];
                    echo <<<HTML
                    <!-- <button class="round-button" id="massages-button"> <i class="fa-brands icon fa-facebook-messenger"></i></i></button>
                    <button class="round-button" id="notification-button"><i class="fa-solid icon fa-bell"></i></button> -->
                    <div class="profile-picture" onclick = "showPofilePopup()">
                        <img src="$profilePhoto" alt="profile-picture">
                    </div>
                    HTML;
                }
                ?>
            </section>
        </nav>
    </header>

    <div class="toast-notification">
        
    </div>

    <?php
    if(isset($_POST['logout-button'])){
        session_start();
        unset($_SESSION['tenant']);
        $_SESSION['status'] = 'success';
        $_SESSION['message'] = "Logged out successfully";
        echo "<script>window.location.href = window.location.href;</script>";
        exit;
    }
    ?>
