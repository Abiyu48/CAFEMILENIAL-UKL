<?php
include'koneksi1.php';

$id_menu = $_GET ['id'];

$hapus = mysqli_query ($mysqli, "DELETE FROM menu WHERE id_menu = '$id_menu' ") or die (mysqli_error($mysqli));

if($hapus){
    header ("location: menu.php");
    exit ();
}else{
    echo "gagal menghapus menu";
}
