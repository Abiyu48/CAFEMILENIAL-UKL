<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Room</title>
    <link rel="stylesheet" href="admin.css">
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

        <br>
        <a href="../../register.php" class="btn">Tambah User</a>
        <a href="../../index.php" class="btn">Keluar</a>
        <br>
        <br>
        
        <table border="1" class="table">
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <!-- <th>Level</th> -->
                <th>Edit</th>
            </tr>
            <?php
            include 'koneksi1.php';
            $query_mysql = mysqli_query($mysqli, "SELECT * FROM users") or die(mysqli_error($mysqli));
            $nomor = 1;
            while($data = mysqli_fetch_array($query_mysql)) { 
            ?>
            <tr>
                <td><?php echo $nomor++; ?></td>
                <td><?php echo $data['username']; ?></td>
                <td><?php echo $data['password']; ?></td>
                <td><?php echo $data['email']; ?></td>
                <!-- <td><?php echo $data['level']; ?></td> -->
                <td>
                    <a href="deleted.php?id=<?php echo $data['id_users']; ?>" class="btn-hapus">Hapus</a> 
                    <a href="updateusers.php?id=<?php echo $data['id_users']; ?>" class="btn-update">Update</a> 
                </td>
            </tr>
            <?php } ?>
        </table>

    </section>

</body>
</html>
