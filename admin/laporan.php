<?php
include "../koneksi.php";
include "index.php";

// Contoh query untuk menampilkan laporan penjualan
$sql = "SELECT 
          DATE(tanggal_order) AS tanggal, 
          SUM(total_harga) AS total_penjualan 
        FROM `order` 
        GROUP BY tanggal";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<h2>Laporan Penjualan</h2>";
  echo "<table border='1'>
          <tr>
            <th>Tanggal</th>
            <th>Total Penjualan</th>
          </tr>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row["tanggal"] . "</td>
            <td>" . $row["total_penjualan"] . "</td>
          </tr>";
  }
  echo "</table>";
} else {
  echo "Tidak ada data penjualan.";
}
?>