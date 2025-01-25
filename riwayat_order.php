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

// Ambil data order dari database
$id_pelanggan = $user["id"];
$sql = "SELECT * FROM `order` WHERE id_pelanggan=$id_pelanggan";
$result = $conn->query($sql);

?>

<h2>Riwayat Order Laundry</h2>

<?php
if ($result->num_rows > 0) {
  echo "<table border='1'>
          <tr>
            <th>ID Order</th>
            <th>Jenis Layanan</th>
            <th>Berat (kg)</th>
            <th>Harga Layanan</th>
            <th>Harga Antar</th>
            <th>Total Harga</th>
            <th>Status Order</th>
          </tr>";
  while($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>".$row["id"]."</td>
            <td>".$row["jenis_layanan"]."</td>
            <td>".$row["berat"]."</td>
            <td>".$row["harga_layanan"]."</td>
            <td>".$row["harga_antar"]."</td>
            <td>".$row["total_harga"]."</td>
            <td>".$row["status_order"]."</td>
          </tr>";
  }
  echo "</table>";
} else {
  echo "Tidak ada riwayat order.";
}
?>