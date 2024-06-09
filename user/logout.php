<?php
session_start(); // Mulai session

// Hapus semua data session
session_unset();

// Hancurkan session
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout - Cafe Milenial</title>
    <link rel="stylesheet" href="awalstyle.css"> <!-- Menggunakan CSS yang sudah ada -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
<header>
    <a href="#" class="logo"><i class="fas fa-utensils"></i>Cafe Milenial</a>
    <div id="menu-bar" class="fas fa-bars"></div>
    <nav class="navbar">
        <a href="../index.php">Home</a>
        <a href="menu.php">Menu</a>
        <a href="order.php">Order</a>
        <a href="riwayat.php">Purchase History</a>
        <a href="../loginusers.php">Login</a>
    </nav>
</header>

<section class="logout" id="logout">
    <h1 class="heading"> <span>Logout</span> Successful</h1>
    <div class="content">
        <p>You have successfully logged out.</p>
        <p>Thank you for visiting Cafe Millennial.</p>
        <a href="../loginusers.php" class="btn">Click here to login again</a>
    </div>
</section>

<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="social-links">
                <a href="https://wa.me/qr/SZNR52VJXXBVF1" class="social-link"><i class="fab fa-whatsapp"></i></a>
                <a href="https://www.tiktok.com/@axbyyu?_t=8myW3crvd7n&_r=1" class="social-link"><i class='fab fa-tiktok'></i></a>
                <a href="https://www.youtube.com/@abbiyuputrap2410" class="social-link"><i class='fab fa-youtube'></i></a>
                <a href="https://www.instagram.com/abyuptraa?igsh=eW02MHJ4bXVpZnZq" class="social-link"><i class='fab fa-instagram'></i></a>
            </div>
            <div class="footer-about">
                <h2>About Cafe Milenial</h2>
                <p>Your go-to spot for the best coffee and pastries in town. Join us for a warm and welcoming atmosphere, perfect for any time of the day.</p>
            </div>
            <div class="footer-contact">
                <h2>Contact Us</h2>
                <p>Email: cafemilenial@gmail.com</p>
                <p>Phone: +62 856 0451 5336</p>
                <p>Address: DPR Lot No.55, Pucang, Sidoarjo Sub-district, Sidoarjo Regency, East Java 61252</p>
            </div>
        </div>
        <div class="footer-credit">
            <p>Copyright © @2022. All Rights Reserved.Design By Abbiyu Putra.</p>
        </div>
    </div>
</footer>

</body>
</html>
