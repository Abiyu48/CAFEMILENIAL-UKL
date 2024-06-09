<?php
include 'koneksi1.php';

if (isset($_GET['id'])) {
    $id_menu = $_GET['id'];

    if (isset($_POST['submit'])) {
        $nama_menu = $_POST['nama_menu'];
        $kategori = $_POST['kategori'];
        $harga_menu = $_POST['harga_menu'];
        $stok_menu = $_POST['stok_menu'];

        // Handle file upload
        if ($_FILES["gambar_menu"]["error"] == 4) {
            // No new image uploaded, use existing image
            $gambar_menu = $_POST['gambar_menu_existing'];
        } else {
            $fileName = $_FILES["gambar_menu"]["name"];
            $fileSize = $_FILES["gambar_menu"]["size"];
            $tmpName = $_FILES["gambar_menu"]["tmp_name"];

            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));
            if (!in_array($imageExtension, $validImageExtension)) {
                echo "<script> alert('Invalid Image Extension'); </script>";
            } else if ($fileSize > 1000000) {
                echo "<script> alert('Image Size Is Too Large'); </script>";
            } else {
                $newImageName = uniqid();
                $newImageName .= '.' . $imageExtension;

                move_uploaded_file($tmpName, '../../aset/' . $newImageName);
                $gambar_menu = $newImageName;
            }
        }

        $sql = "UPDATE menu SET nama_menu='$nama_menu', kategori='$kategori', harga_menu='$harga_menu', stok_menu='$stok_menu', gambar_menu='$gambar_menu' WHERE id_menu=$id_menu";
        $result = mysqli_query($mysqli, $sql);

        if ($result) {
            header("Location: menu.php");
            exit;
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    }

    $query = "SELECT * FROM menu WHERE id_menu=$id_menu";
    $result = mysqli_query($mysqli, $query);
    $data = mysqli_fetch_assoc($result);
} else {
    header("Location: menu.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Produk</title>
    <link rel="icon" type="image/png" href="../logotitle.png">
    <link rel="stylesheet" href="updatemenu.css">
</head>
<body>
    <div class="container">
        <header>
            <h1 class="title">Update Produk</h1>
        </header>
        <section class="form">
            <form method="POST" enctype="multipart/form-data">
                <label for="">Name Menu:</label>
                <input type="text" id="nama_menu" name="nama_menu" value="<?php echo $data['nama_menu']; ?>" required><br>

                <label for="">Category:</label>
                <select name="kategori" id="">
                    <option value="Juice">Juice</option>
                    <option value="Food">Food</option>
                </select> <br>

                <label for="">Price Menu:</label>
                <input type="text" id="harga_menu" name="harga_menu" value="<?php echo $data['harga_menu']; ?>" required><br>

                <label for="">Stock Menu:</label>
                <input type="number" id="stok_menu" name="stok_menu" value="<?php echo $data['stok_menu']; ?>" required><br>

                <label for="">Image Menu:</label>
                <input type="file" name="gambar_menu" accept=".jpg, .jpeg, .png"><br>
                <input type="hidden" name="gambar_menu_existing" value="<?php echo $data['gambar_menu']; ?>"><br>
                <input type="submit" name="submit" value="Update" class="button">
            </form>
        </section>
    </div>

    <script src="main.js"></script>
</body>
</html>
