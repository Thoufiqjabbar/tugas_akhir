<?php
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

// Proses pembuatan order
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_pelanggan = $user["id"];
  $jumlah_pakaian = $_POST["jumlah_pakaian"];
  $berat = $_POST["berat"];
  $jenis_layanan = $_POST["jenis_layanan"];
  $harga_layanan = $_POST["harga_layanan"];
  $harga_antar = $_POST["harga_antar"];
  $total_harga = $harga_layanan + $harga_antar;

  $sql = "INSERT INTO `order` (id_pelanggan, jumlah_pakaian, berat, jenis_layanan, harga_layanan, harga_antar, total_harga, status_order) 
          VALUES ('$id_pelanggan', '$jumlah_pakaian', '$berat', '$jenis_layanan', '$harga_layanan', '$harga_antar', '$total_harga', 'pending')";

  if ($conn->query($sql) === TRUE) {
    echo "Order berhasil dibuat.";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Fetch jenis layanan from database
$sql_layanan = "SELECT * FROM jenis_layanan";
$result_layanan = $conn->query($sql_layanan);
?>

<h2>Buat Order Laundry</h2>

<form method="post" action="">
  Jumlah Pakaian: <input type="number" name="jumlah_pakaian"><br><br>
  Berat (kg): <input type="number" name="berat"><br><br>
  Jenis Layanan:
  <select name="jenis_layanan">
  <?php
  if ($result_layanan->num_rows > 0) {
    while($row_layanan = $result_layanan->fetch_assoc()) {
      echo "<option value='".$row_layanan["nama_layanan"]."'>".$row_layanan["nama_layanan"]."</option>";
    }
  } else {
    echo "<option value=''>Tidak ada jenis layanan</option>";
  }
  ?>
  </select><br><br>
  Harga Layanan: <input type="number" name="harga_layanan"><br><br>
  Harga Antar: <input type="number" name="harga_antar"><br><br>
  <input type="submit" value="Buat Order">
</form>