<?php
include("koneksi1.php");

if(isset($_POST['submit'])) {
    $id_menu = $_POST['id_menu'];
    $nama_menu = $_POST['nama_menu'];
    $harga_menu = $_POST['harga_menu'];
    $kategori = $_POST['kategori'];
    $stok_menu = $_POST['stok_menu'];
    $gambar = $_POST['gambar_menu'];

    $result = mysqli_query($mysqli, "UPDATE menu SET nama_menu='$nama_menu', harga_menu='$harga_menu', kategori='$kategori', stok_menu='$stok_menu', gambar_menu='$gambar_menu' WHERE id_menu='$id_menu'");

    if($result) {
        header("Location: menu.php");
        exit; 
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }
} else {
    echo "Data tidak ditemukan.";
}
?>
