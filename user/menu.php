<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="awalstyle.css">
    <title>Cafe Milenial</title>
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
    </nav>
</header>

<section class="menu" id="menu">
    <div class="heading">
        <h2><span>All</span> Menu</h2>
    </div>
    <br>
    <div class="search" id="search">
        <input type="search" id="search-input" placeholder="Cari menu disini..."> <br><br>
        <h3>CATEGORY</h3>
        <button class="btn active" data-filter="all">all menu</button>
        <button class="btn" data-filter="juice">Juice</button>
        <button class="btn" data-filter="food">Food</button>
    </div>

    <div class="box-container" id="menu-container">
    <?php
    include 'koneksi1.php';
    $sql = "SELECT * FROM menu";
    $result = mysqli_query($koneksi, $sql);
    $counter = 0; 
    while($data = mysqli_fetch_array($result)) { 
    if ($counter >= 30) break; 
    $counter++;
    ?>
    <div class="box" data-category="<?php echo strtolower($data['kategori']); ?>">
        <img src="../aset/<?php echo $data["gambar_menu"]; ?>" width="200" title="<?php echo $data['gambar_menu']; ?>">
        <h3><?php echo $data['nama_menu']; ?></h3>
        <p><?php echo $data['kategori']; ?></p>
        <h4>Rp <?php echo $data['harga_menu']; ?></h4><br>
        <?php if ($data['stok_menu'] > 0) { ?>
            <a href="order.php?nama_menu=<?php echo urlencode($data['nama_menu']); ?>" class="btn">order now</a>
        <?php } else { ?>
            <p class="out-of-stock">Stok Habis</p>
        <?php } ?>
    </div>
    <?php } ?>
    </div>
</section>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("search-input");
        const menuContainer = document.getElementById("menu-container");
        const menuItems = Array.from(menuContainer.getElementsByClassName("box"));
        const filterButtons = document.querySelectorAll(".search .btn");

        // Menampilkan semua item produk saat halaman dimuat
        menuItems.forEach(item => {
            item.style.display = "block";
        });

        searchInput.addEventListener("input", function() {
            const query = searchInput.value.toLowerCase();

            menuItems.forEach(item => {
                const menuNameElement = item.querySelector("h3");
                const menuCategoryElement = item.querySelector("p");
                const menuName = menuNameElement.textContent.toLowerCase();
                const menuCategory = menuCategoryElement.textContent.toLowerCase();

                if (menuName.includes(query) || menuCategory.includes(query)) {
                    item.style.display = "block";
                    highlightText(menuNameElement, query);
                    highlightText(menuCategoryElement, query);
                } else {
                    item.style.display = "none";
                }
            });
        });

        filterButtons.forEach(button => {
            button.addEventListener("click", function() {
                const filter = button.getAttribute("data-filter");

                filterButtons.forEach(btn => btn.classList.remove("active"));
                button.classList.add("active");

                menuItems.forEach(item => {
                    const menuCategory = item.getAttribute("data-category");

                    if (filter === "all" || menuCategory === filter) {
                        item.style.display = "block";
                    } else {
                        item.style.display = "none";
                    }
                });
            });
        });

        function highlightText(element, query) {
            const innerHTML = element.innerHTML;
            const cleanText = innerHTML.replace(/<\/?span[^>]*>/g, ''); 
            const regex = new RegExp(`(${query})`, 'gi');
            const newHTML = cleanText.replace(regex, `<span class="highlight">$1</span>`);
            element.innerHTML = newHTML;
        }
    });
</script>

<script src="main.js"></script>

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
