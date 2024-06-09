<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Register</h1><br>
        <form class="form" action="register.php" method="post">
            <input type="email" name="email" placeholder="Email" required="required"> 
            <input type="text" name="username" placeholder="Username" required="required">
            <input type="password" name="password" placeholder="Password" required="required">
            <button class="button" name="sumbit" type="submit">Register</button>
            <?php
            include("koneksi.php");
            if(isset($_POST['sumbit'])){
                $email= $_POST['email'];
                $username= $_POST['username'];
                $password= $_POST['password'];
                $level='user';

                $result = mysqli_query($koneksi,
                "INSERT INTO users(email,username,password, level) VALUES ('$email','$username','$password', 'user')");

                header("location:admin/USERS/users.php");
            }
            ?>
        </form>
    </div>

</body>
</html>