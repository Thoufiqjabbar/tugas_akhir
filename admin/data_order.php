<?php
include "../koneksi.php";
include "index.php";

$sql = "SELECT o.*, u.nama as nama_pelanggan 
        FROM `order` o
        JOIN user u ON o.id_pelanggan = u.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table border='1'>
          <tr>
            <th>ID Order</th>
            <th>Nama Pelanggan</th>
            <th>Jenis Layanan</th>
            <th>Status Order</th>
            <th>Total Harga</th>
            <th>Aksi</th>
          </tr>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["nama_pelanggan"] . "</td>
            <td>" . $row["jenis_layanan"] . "</td>
            <td>" . $row["status_order"] . "</td>
            <td>" . $row["total_harga"] . "</td>
            <td>
              <a href='edit_order.php?id=" . $row["id"] . "'>Edit Status</a> | 
              <a href='cetak_invoice.php?id=" . $row["id"] . "'>Cetak Invoice</a>
            </td>
          </tr>";
  }
  echo "</table>";
} else {
  echo "Tidak ada data order.";
}
?>