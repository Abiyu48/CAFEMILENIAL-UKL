<?php 
include("koneksi1.php");

if(!isset($_GET['id'])){
    header('Location: users.php');
    exit; 
}

$id_users = $_GET['id'];
$result = mysqli_query($mysqli, "SELECT * FROM users WHERE id_users=$id_users");

if(!$result) {
    echo "Error: " . mysqli_error($mysqli);
    exit;   
}

if(mysqli_num_rows($result) === 0) {
    echo "Data user tidak ditemukan.";
    exit; 
}

$user_data = mysqli_fetch_array($result);
$id_users = $user_data['id_users']; 
$username = $user_data['username']; 
$password = $user_data['password']; 
$email = $user_data['email']; 
$level = $user_data['level']; 
?>

<body>
    <link rel="stylesheet" href="updateusers.css">
    <header>
        <h3>Formulir Edit User</h3>
    </header>
    <form method="post" action="prosesupdate.php">
        <table>
            <tr>
                <td>Username</td> 
                <td><input type="text" name="username" value="<?php echo $username ?>"></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password" value="<?php echo $password ?>"></td>
            </tr>
            <tr>
                <td>Level</td>
                <td>
                    <select name="level" id="level" required>
                        <option value="admin" <?php if($level == 'admin') echo 'selected'; ?>>Admin</option>
                        <option value="user" <?php if($level == 'user') echo 'selected'; ?>>User</option>
                    </select>
                </td>
            </tr>
            <input type="hidden" name="id" value="<?php echo $id_users; ?>">
            <tr>
                <td><input type="submit" name="simpan" value="Simpan"></td>
            </tr>
        </table>
    </form>
</body>
