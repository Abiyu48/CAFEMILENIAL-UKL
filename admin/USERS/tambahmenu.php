<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu</title>
    <link rel="stylesheet" href="tambahmenu.css"> <!-- Make sure this path is correct -->
</head>
<body>
    <header>
        <h1>Add Menu</h1>
    </header>

    <section>
        <h3>DATA MENU</h3>
        <form action="tambahmenu.php" method="post" name="form1" enctype="multipart/form-data">
            <table width="25%" border="0" class="table">
                <tr>
                    <td>Nama Menu</td>
                    <td><input type="text" name="nama_menu" required></td>
                </tr>
                <tr>
                    <td>Kategori</td>
                    <td><input type="text" name="kategori" required></td>
                </tr>
                <tr>
                    <td>Harga Menu</td>
                    <td><input type="number" name="harga_menu" required></td>
                </tr>
                <tr>
                    <td>Stok Menu</td>
                    <td><input type="number" name="stok_menu" required></td>
                </tr>
                <tr>
                    <td>Foto</td>
                    <td><input type="file" id="foto" name="gambar_menu" accept=".jpg, .jpeg, .png" required></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="Submit" value="Add" class="btn"></td>
                </tr>
            </table>
        </form>
    </section>
    <?php
    if (isset($_POST['Submit'])) {
        $nama_menu = $_POST['nama_menu'];
        $harga_menu = $_POST['harga_menu'];
        $kategori = $_POST['kategori'];
        $stok_menu = $_POST['stok_menu'];
        $gambar_menu = $_POST['gambar_menu'];

        if ($_FILES["gambar_menu"]["error"] == 4) {
            echo "<script>alert('Image Does Not Exist');</script>";
        } else {
            $fileName = $_FILES["gambar_menu"]["name"];
            $fileSize = $_FILES["gambar_menu"]["size"];
            $tmpName = $_FILES["gambar_menu"]["tmp_name"];

            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $fileName);
            $imageExtension = strtolower(end($imageExtension));
            
            if (!in_array($imageExtension, $validImageExtension)) {
                echo "<script>alert('Invalid Image Extension');</script>";
            } else if ($fileSize > 1000000) {
                echo "<script>alert('Image Size Is Too Large');</script>";
            } else {
                $newImageName = uniqid();
                $newImageName .= '.' . $imageExtension;

                move_uploaded_file($tmpName, '../../aset/' . $newImageName);
                
                require ("koneksi1.php");
                $sql="INSERT INTO menu (nama_menu, kategori, harga_menu, stok_menu, gambar_menu) VALUES('$nama_menu','$kategori','$harga_menu','$stok_menu','$newImageName')";
                $result = mysqli_query($mysqli,$sql);

                header("location: menu.php");
            }
        }
    }
    ?>
</body>
</html>
