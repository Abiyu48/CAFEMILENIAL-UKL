<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="user/awalstyle.css">
    <title>Cafe Milenial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
<header>
    <a href="#" class="logo"><i class="fas fa-utensils"></i>Cafe Milenial</a>
    <div id="menu-bar" class="fas fa-bars"></div>
    <nav class="navbar">
        <a href="#home">Home</a>
        <a href="user/menu.php">Menu</a>
        <a href="user/order.php">Order</a>
        <a href="user/riwayat.php">Purchase History</a>
        <?php if (!isset($_SESSION['username'])): ?>
            <a href="loginusers.php">Login</a>
        <?php else: ?>
            <a href="user/logout.php">Logout</a>
        <?php endif; ?>
    </nav>
</header>

<section class="home" id="home">
    <div class="content">
        <h3>food made with love</h3>
        <p>“The best moments of our lives, we're conditional on being together and experiencing the happiness we've been hoping for.”</p>
    </div>
    <div class="image">
        <img src="user/aset/home 1.png" alt="">
    </div>
</section>

<section class="about" id="about">
    <div class="about-img">
        <img src="user/aset/pizza.jpg" alt="">
    </div>
    <div class="about-text">
        <h2> <span>about</span> us</h2>
        <p>Welcome to Cafe Millennial, a place where modern flavors meet local warmth. We serve delicious dishes with high quality ingredients, in a friendly and cozy atmosphere. Enjoy special moments with us.</p><br>
</section>

<section class="products" id="products">
    <div class="heading">
        <h2>most <span>populer</span> menu</h2>
    </div><br>
    <div class="products-container" id="products-container">
        <?php
        include 'koneksi.php';
        $sql = "SELECT * FROM menu";
        $result = mysqli_query($koneksi, $sql);
        $counter = 0; 
        while($data = mysqli_fetch_array($result)) { 
            if ($counter >= 3) break; 
            $counter++;
        ?>
        <div class="box" data-category="<?php echo strtolower($data['kategori']); ?>">
            <td><img src="aset/<?php echo $data["gambar_menu"]; ?>" width="200" title="<?php echo $data['gambar_menu']; ?>"></td>
            <h3><?php echo $data['nama_menu']; ?></h3>
            <p><?php echo $data['kategori']; ?></p>
            <h4>Rp <?php echo $data['harga_menu']; ?></h4><br>
            <div class="content">
                <h3><a href="user/order.php?nama_menu=<?php echo urlencode($data['nama_menu']); ?>" class="btn">Order Now</a></h3>
            </div>
        </div>
        <?php } ?>
    </div>
    <br><br>
    <a href="user/menu.php" class="btn">view all menu</a>
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
