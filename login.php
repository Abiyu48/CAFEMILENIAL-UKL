<?php
session_start();
include 'koneksi.php';

$username = $_POST['Username'];
$password = $_POST['Password'];

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = mysqli_query($koneksi, $sql);

if ($result) {
    $cek = mysqli_num_rows($result);

    if ($cek > 0) {
        $data = mysqli_fetch_assoc($result);

        if ($data['level'] == "admin") {
            $_SESSION['username'] = $username;
            header("Location: admin\USERS/users.php");
        } else if ($data['level'] == "user") {
            $_SESSION['username'] = $username;
            header("Location: index.php");
        // } else {
        //     header("Location: admin\USERS/users.php");
        }
     } else {
        echo "login dulu";
     } 
} 
else {
    echo "Error: " . mysqli_error($mysqli);
}
?>