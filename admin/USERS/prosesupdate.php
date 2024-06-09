<?php
include("koneksi1.php");

if(isset($_POST['simpan'])) {
    $id_users = $_POST['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    $result = mysqli_query($mysqli, "UPDATE users SET username='$username', password='$password', level='$level' WHERE id_users='$id_users'");

    if($result) {
        header("Location: users.php");
        exit; 
    } else {
        echo "Error: " . mysqli_error($mysqli);
    }
} else {
    echo "Data tidak ditemukan.";
}
?>
