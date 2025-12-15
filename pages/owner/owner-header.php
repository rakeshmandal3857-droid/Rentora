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
    <link rel="stylesheet" href="./add-accomodation.css">
    <title>Rentora : Your Journey to a Better Stay Starts Here.</title>
</head>
<body>
    <header>

        <nav><a href="../tenant/home.php"><div class="logo"><img src="../../assets/images/rentora-logo.png" alt="logo">Rentora</div></a>
            
    
            <section class="header-right">
                <!-- <button class="round-button" id="massages-button"> <i class="fa-brands icon fa-facebook-messenger"></i></i></button>
                <button class="round-button" id="notification-button"><i class="fa-solid icon fa-bell"></i></button> -->
                <button class="round-button owner-side-bar-button" onclick="showSideNav()"><i class="fa-solid icon fa-bars"></i></button>
                <!-- <form action="" method="post"><button class="round-button" name="logout-button" type="submit"><i class="fa-solid fa-right-from-bracket"></i></button></form>÷ -->
            <?php 
            if(!isset($_SESSION['owner'])){
                // echo <<<HTML
                // <button class="btn-primary" id="login-button">Log in / Sign up</button>
                // HTML;
            }else{
                echo <<<HTML
                <!-- <button class="round-button" id="massages-button"> <i class="fa-brands icon fa-facebook-messenger"></i></i></button>
                <button class="round-button" id="notification-button"><i class="fa-solid icon fa-bell"></i></button> -->
                <form action="" method="post"><button class="round-button" name="logout-button" type="submit"><i class="fa-solid fa-right-from-bracket"></i></button></form>
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
    unset($_SESSION['owner']);
    $_SESSION['status'] = 'success';
    $_SESSION['message'] = "Logged out successfully";
    echo "<script>window.location='owner-home.php';</script>";
    exit;
}
?>