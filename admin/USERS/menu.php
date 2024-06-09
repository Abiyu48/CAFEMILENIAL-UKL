<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Room</title>
    <link rel="stylesheet" href="menu.css">
</head>
<body>
    <header>
        <h1>Admin Room</h1>
    </header>
    <nav>
        <a href="users.php">USERS</a>
        <a href="transaksi.php">TRANSAKSI</a>
        <a href="menu.php">MENU</a>
    </nav>
    <section>
        
        <h2>Welcome to the Admin Panel</h2>
        <p>Welcome to the admin space, change to add something new.</p>

        <a href="tambahmenu.php" class="btn">Tambah Menu</a>
        <a href="../../index.php" class="btn">Keluar</a>
        <br>
        <br>
        
        <table border="1" class="table">
            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Kategori</th>
                <th>Harga Menu</th>
                <th>Stok Menu</th>
                <th>Gambar Menu</th>
                <th>Edit</th>
            </tr>
            <?php
            include 'koneksi1.php';
            $query_mysql = mysqli_query($mysqli, "SELECT * FROM menu") or die(mysqli_error($mysqli));
            $nomor = 1;
            while($data = mysqli_fetch_array($query_mysql)) { 
            ?>
            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $data['nama_menu']; ?></td>
                <td><?php echo $data['kategori']; ?></td>
                <td><?php echo $data['harga_menu']; ?></td>
                <td><?php echo $data['stok_menu']; ?></td>
                <td><img src="../../aset/<?php echo $data["gambar_menu"]; ?>" width="200" title="<?php echo $data['gambar_menu']; ?>"></td>
                <td>
                    <a href="deletedmenu.php?id=<?php echo $data['id_menu']; ?>" class="btn-hapus">Hapus</a> 
                    <a href="updatemenu.php?id=<?php echo $data['id_menu']; ?>" class="btn-update">Update</a> 
                </td>
            </tr>
            <?php } ?>
        </table>
        <br>
        <br>

    </section>


</body>
</html>
