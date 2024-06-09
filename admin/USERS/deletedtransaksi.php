<?php
include'koneksi1.php';

$id_transaksi = $_GET ['id'];

$hapus = mysqli_query ($mysqli, "DELETE FROM transaksi WHERE id_transaksi = '$id_transaksi' ") or die (mysqli_error($mysqli));

if($hapus){
    header ("location: transaksi.php");
    exit ();
}else{
    echo "gagal menghapus transaksi";
}