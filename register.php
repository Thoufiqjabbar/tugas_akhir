<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Form Registrasi</h2>
    <form method="post" action="" enctype="multipart/form-data"> 
        <label for="nama">Nama Lengkap:</label><br>
        <input type="text" id="nama" name="nama" required><br><br>

        <label for="alamat">Alamat:</label><br>
        <textarea id="alamat" name="alamat" required></textarea><br><br>

        <label for="no_telp">No. Telepon:</label><br>
        <input type="text" id="no_telp" name="no_telp" required><br><br>

        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <input type="submit" value="Daftar">
    </form>

    <script>
    
    
</body>
</html>

<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $nama = $_POST["nama"];
    $alamat = $_POST["alamat"];
    $no_hp = $_POST["no_telp"];

   
    $sql = "INSERT INTO user (username, password, nama, alamat, no_hp) VALUES ('$username', '$password', '$nama', '$alamat', '$no_hp')";

    if (mysqli_query($conn, $sql)) {
        echo "Registrasi berhasil.";
        header("Location: login.php"); 
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>