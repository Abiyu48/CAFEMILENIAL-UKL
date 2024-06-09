<?php
session_start();
include 'koneksi1.php';

if (!isset($_SESSION['username'])) {
    header("Location: ../loginusers.php");
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM menu ORDER BY id_menu";
$result = mysqli_query($koneksi, $sql);

$prices = [
    'Burger' => 25000,
    'Cake' => 15000,
    'French Fries' => 15000,
    'Pizza' => 45000,
    'Choco Brownies' => 15000,
    'Croffle' => 15000,
    'Orange Juice' => 18000,
    'Strawberry Juice' => 18000,
    'Avocado Juice' => 18000,
];

if (isset($_POST['confirm_order'])) {
    foreach ($_SESSION['cart'] as $item) {
        $sql_user = "SELECT id_users FROM users WHERE username = '$username'";
        $result_user = mysqli_query($koneksi, $sql_user);
        $data_user = mysqli_fetch_assoc($result_user);
        $id_users = $data_user['id_users'];

        $nama_menu = $item['nama_menu'];
        $sql_menu = "SELECT id_menu, stok_menu FROM menu WHERE nama_menu = '$nama_menu'";
        $result_menu = mysqli_query($koneksi, $sql_menu);
        $data_menu = mysqli_fetch_assoc($result_menu);
        $id_menu = $data_menu['id_menu'];
        $stok_menu = $data_menu['stok_menu'];

        // Kurangi stok menu
        $quantity = $item['quantity'];
        $stok_baru = $stok_menu - $quantity;

        if ($stok_baru < 0) {
            // Jika stok tidak cukup, tampilkan pesan error
            echo "Stok tidak cukup untuk menu: " . $nama_menu;
            exit();
        } else {
            // Update stok menu di database
            $sql_update_stok = "UPDATE menu SET stok_menu = '$stok_baru' WHERE id_menu = '$id_menu'";
            mysqli_query($koneksi, $sql_update_stok);

            // Masukkan data transaksi ke dalam tabel transaksi
            $sql = "INSERT INTO transaksi (id_users, id_menu, username, nama_menu, quantity, transaction_method, total_transaction, calender_transaction, time_transaction)
                    VALUES ('$id_users', '$id_menu', '$username', '{$item['nama_menu']}', '{$item['quantity']}', '{$item['transaction_method']}', '{$item['total_transaction']}', '{$item['calender_transaction']}', '{$item['time_transaction']}')";
            mysqli_query($koneksi, $sql);
        }
    }
    $_SESSION['cart'] = [];
    header("Location: riwayat.php");
    exit();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['clear_cart']) && !isset($_POST['confirm_order'])) {
    $item = [
        'name' => $_POST['name'],
        'nama_menu' => $_POST['nama_menu'],
        'quantity' => $_POST['quantity'],
        'transaction_method' => $_POST['transaction_method'],
        'total_transaction' => $prices[$_POST['nama_menu']] * $_POST['quantity'],
        'calender_transaction' => $_POST['calender_transaction'],
        'time_transaction' => $_POST['time_transaction'],
    ];
    $_SESSION['cart'][] = $item;
}

if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = [];
}

$totalCost = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalCost += $item['total_transaction'];
}

$selectedMenu = isset($_GET['nama_menu']) ? $_GET['nama_menu'] : (isset($_SESSION['cart'][0]['nama_menu']) ? $_SESSION['cart'][0]['nama_menu'] : '');

if (isset($_POST['confirm_order'])) {
    foreach ($_SESSION['cart'] as $item) {
        $sql_user = "SELECT id_users FROM users WHERE username = '$username'";
        $result_user = mysqli_query($koneksi, $sql_user);
        $data_user = mysqli_fetch_assoc($result_user);
        $id_users = $data_user['id_users'];

        $nama_menu = $item['nama_menu'];
        $sql_menu = "SELECT id_menu FROM menu WHERE nama_menu = '$nama_menu'";
        $result_menu = mysqli_query($koneksi, $sql_menu);
        $data_menu = mysqli_fetch_assoc($result_menu);
        $id_menu = $data_menu['id_menu'];

        $sql = "INSERT INTO transaksi (id_users, id_menu, username, nama_menu, quantity, transaction_method, total_transaction, calender_transaction, time_transaction)
                VALUES ('$id_users', '$id_menu', '$username', '{$item['nama_menu']}', '{$item['quantity']}', '{$item['transaction_method']}', '{$item['total_transaction']}', '{$item['calender_transaction']}', '{$item['time_transaction']}')";
        mysqli_query($koneksi, $sql);
    }
    $_SESSION['cart'] = [];
    header("Location: riwayat.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="awalstyle.css">
    <title>Cafe Milenial</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script>
        window.addEventListener('load', () => {
            const now = new Date();
            const dateInput = document.getElementById('calender_transaction');
            const timeInput = document.getElementById('time_transaction');
            
            const year = now.getFullYear();
            const month = ('0' + (now.getMonth() + 1)).slice(-2);
            const day = ('0' + now.getDate()).slice(-2);
            dateInput.value = `${year}-${month}-${day}`;
            
            const hours = ('0' + now.getHours()).slice(-2);
            const minutes = ('0' + now.getMinutes()).slice(-2);
            timeInput.value = `${hours}:${minutes}`;
        });
    </script>
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
        <?php if (!isset($_SESSION['username'])): ?>
            <a href="loginusers.php">Login</a>
        <?php else: ?>
            <a href="logout.php">Logout</a>
        <?php endif; ?>
    </nav>
</header>

<section class="order" id="order">
    <h1 class="heading"> <span>Order</span> Now</h1>
    <div class="row">
        <div class="image">
            <img src="aset/waiters.jpg" alt="">
        </div>
        <form action="order.php" method="post">
            <div class="inputbox">
                <input type="text" name="name" placeholder="Name" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" required readonly>
                <select name="nama_menu" required>
                    <?php while($data = mysqli_fetch_array($result)) { ?>
                        <option value="<?php echo $data['nama_menu']; ?>" <?php echo ($data['nama_menu'] == $selectedMenu) ? 'selected' : ''; ?>>
                            <?php echo $data['nama_menu']; ?>
                        </option>
                    <?php } ?>
                </select>
                <input type="number" name="quantity" placeholder="Quantity" required>
            </div>
            <div class="inputbox">
                <select name="transaction_method" required>
                    <option value="Cashless">Cashless</option>
                    <option value="Cash">Cash</option>
                </select>
            </div>

            <div class="inputbox">
                <input type="date" id="calender_transaction" name="calender_transaction" required readonly>
            </div>

            <div class="inputbox">
                <input type="time" id="time_transaction" name="time_transaction" readonly>
            </div>

            <input type="submit" value="Add to Cart" class="btn">
        </form>
    </div>

    <h2 class="heading">Your Cart</h2>
    <?php if (empty($_SESSION['cart'])): ?>
        <p>Your cart is empty</p>
    <?php else: ?>
        <ul>
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <li>
                    <p><strong>Name:</strong> <?= htmlspecialchars($item['name']) ?></p>
                    <p><strong>Menu:</strong> <?= htmlspecialchars($item['nama_menu']) ?> (<?= htmlspecialchars($item['quantity']) ?>) - Rp <?= number_format($item['total_transaction'], 0, ',', '.') ?></p>
                    <p><strong>Transaction Method:</strong> <?= htmlspecialchars($item['transaction_method']) ?></p>
                    <p><strong>Date:</strong> <?= htmlspecialchars($item['calender_transaction']) ?></p>
                    <p><strong>Time:</strong> <?= htmlspecialchars($item['time_transaction']) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
        <h3>Total Cost: Rp <?= number_format($totalCost, 0, ',', '.') ?></h3>
        <form action="order.php" method="post">
            <input type="hidden" name="clear_cart" value="1">
            <input type="submit" value="Clear Cart" class="btn">
        </form>
        <form action="order.php" method="post">
            <input type="hidden" name="confirm_order" value="1">
            <input type="submit" value="Confirm Order" class="btn">
        </form>
    <?php endif; ?>
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
