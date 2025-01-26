<h2>Selamat Datang di Laundry Online</h2>
<a href="?p=login">Login</a> | <a href="?p=register">Register</a>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); 
include "koneksi.php"; 

// Cek apakah user sudah login
if (!isset($_SESSION["username"])) {
  header("Location: index.php?p=login"); 
  exit();
}

// Ambil data user dari database
$username = $_SESSION["username"];
$sql = "SELECT * FROM user WHERE username='$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Halaman Beranda</title>
  <style>
    body {
      font-family: sans-serif;
    }
    nav ul {
      list-style: none;
      padding: 0;
      margin: 0;
      background-color: #f0f0f0; 
    }
    nav li {
      display: inline;
      margin-right: 20px;
    }
  </style>
</head>
<body>

<h2>Selamat datang, <?php echo $user["nama"]; ?>!</h2>

<nav>
  <ul>
    <li><a href="buat_order.php">Buat Order</a></li>
    <li><a href="riwayat_order.php">Riwayat Order</a></li>
    <li><a href="edit_profil.php">Edit Profil</a></li>
    <li><a href="logout.php">Logout</a></li>
  </ul>
</nav>

<main>
  <h3>Layanan Laundry Kami</h3>
  <p>Kami menyediakan berbagai layanan laundry berkualitas untuk memenuhi kebutuhan Anda:</p>
  <ul>
    <?php
    // Ambil data jenis layanan dari database
    $sql_layanan = "SELECT * FROM jen";
    $result_layanan = $conn->query($sql_layanan); 

    if ($result_layanan->num_rows > 0) {
      while($row_layanan = $result_layanan->fetch_assoc()) {
        echo "<li>".$row_layanan["nama_layanan"]." - Harga: Rp ".$row_layanan["harga"]."/kg</li>";
      }
    } else {
      echo "<li>Tidak ada jenis layanan tersedia.</li>";
    }
    ?>
  </ul>

  </main>

</body>
</html>