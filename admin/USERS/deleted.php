<?php
include'koneksi1.php';

$id_users = $_GET ['id'];

$hapus = mysqli_query ($mysqli, "DELETE FROM users WHERE id_users = '$id_users' ") or die (mysqli_error($mysqli));

if($hapus){
    header ("location: users.php");
    exit ();
}else{
    echo "gagal menghapus users";
}
