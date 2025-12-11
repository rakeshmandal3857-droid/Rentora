<?php

session_start();
include __DIR__ . '/../../config-db.php';
// session_unset();
// session_destroy();
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
        <section class="header_offer_section">Book your bed/room directly with us and get flat 10% OFF.</section>

        <nav><a href="home.php"><div class="logo"><img src="../../assets/images/rentora-logo.png" alt="logo">Rentora</div></a>
            
            
            <section class="header-mid">
                <a class="active" href="home.php">Home</a>
                <a href="../owner/owner-home.php" id="owner-login-button">List your Property</a>
                <a href="/aboutUs.php">About Us</a>
                <a href="#footer">Contact</a>
            </section>
    
            <section class="header-right">
                <button class="round-button" id="menu-button"><i class="fa-solid icon fa-list"></i></button>

                <?php 
                if(!isset($_SESSION['tenant'])){
                    echo <<<HTML
                    <button class="btn-primary" id="login-button">Log in / Sign up</button>
                    HTML;
                }else{
                    echo <<<HTML
                    <button class="round-button" id="massages-button"> <i class="fa-brands icon fa-facebook-messenger"></i></i></button>
                    <button class="round-button" id="notification-button"><i class="fa-solid icon fa-bell"></i></button>
                    HTML;
                }
                ?>
            </section>
        </nav>
    </header>

