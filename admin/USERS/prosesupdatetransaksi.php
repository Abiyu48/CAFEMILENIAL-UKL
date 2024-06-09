<?php
include("koneksi1.php");

if(isset($_POST['simpan'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $username = $_POST['username'];
    $nama_menu = $_POST['nama_menu'];
    $quantity = $_POST['quantity'];
    $transaction_method = $_POST['transaction_method'];
    $total_transaction = $_POST['total_transaction'];
    $calender_transaction = $_POST['calender_transaction']; 
    $time_transaction = $_POST['time_transaction']; 

    $result = mysqli_query($mysqli, "UPDATE transaksi SET username='$username', nama_menu='$nama_menu', quantity='$quantity', transaction_method='$transaction_method', total_transaction='$total_transaction', calender_transaction='$calender_transaction', time_transaction='$time_transaction' WHERE id_transaksi='$id_transaksi'");

    if($result) {
        header("Location: transaksi.php");
        exit; 
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }
} else {
    echo "Data tidak ditemukan.";
}
?>
