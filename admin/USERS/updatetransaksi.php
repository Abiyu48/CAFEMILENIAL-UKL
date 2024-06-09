<?php
include("koneksi1.php");

if(!isset($_GET['id'])){
    header('Location: transaksi.php');
    exit; 
}

$id_transaksi = $_GET['id'];
$result = mysqli_query($mysqli, "SELECT * FROM transaksi WHERE id_transaksi=$id_transaksi");

if(!$result) {
    echo "Error: " . mysqli_error($mysqli);
    exit;   
}

if(mysqli_num_rows($result) === 0) {
    echo "Data user tidak ditemukan.";
    exit; 
}

$transaksi_data = mysqli_fetch_array($result);
$id_transaksi = $transaksi_data['id_transaksi']; 
$username = $transaksi_data['username']; 
$nama_menu = $transaksi_data['nama_menu']; 
$quantity = $transaksi_data['quantity']; 
$transaction_method = $transaksi_data['transaction_method']; 
$total_transaction = $transaksi_data['total_transaction']; 
$calender_transaction = $transaksi_data['calender_transaction']; 
$time_transaction = $transaksi_data['time_transaction']; 
?>

<body>
    <link rel="stylesheet" href="updateusers.css">
    <header>
        <h3>Formulir Edit Transaksi</h3>
    </header>
    <form method="post" action="prosesupdatetransaksi.php">
        <table>
            <tr>
                <td>Name</td> 
                <td><input type="text" name="username" value="<?php echo $username ?>"></td>
            </tr>
            <tr>
                <td>Name Menu</td>
                <td><input type="text" name="nama_menu" value="<?php echo $nama_menu ?>"></td>
            </tr>
            <tr>
                <td>Quantity</td>
                <td><input type="number" name="quantity" value="<?php echo $quantity ?>"></td>
            </tr>
            <tr>
                <td>Metode Transaksi</td>
                <td>
                    <select name="transaction_method" required>
                        <option value="Cashless" <?php if($transaction_method == 'Cashless') echo 'selected'; ?>>Cashless</option>
                        <option value="Cash" <?php if($transaction_method == 'Cash') echo 'selected'; ?>>Cash</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Total Transaksi</td>
                <td><input type="number" name="total_transaction" value="<?php echo $total_transaction ?>"></td>
            </tr>
            <tr>
                <td>Tanggal Transaksi</td>
                <td><input type="date" name="calender_transaction" value="<?php echo $calender_transaction ?>"></td>
            </tr>
            <tr>
                <td>Waktu Transaksi</td>
                <td><input type="time" name="time_transaction" value="<?php echo $time_transaction ?>"></td>
            </tr>
            <input type="hidden" name="id_transaksi" value="<?php echo $id_transaksi; ?>">
            <tr>
                <td><input type="submit" name="simpan" value="Simpan"></td>
            </tr>
        </table>
    </form>
</body>