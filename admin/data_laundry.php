<?php
include "../koneksi.php";
include "index.php";

$sql = "SELECT * FROM laundry";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table border='1'>
          <tr>
            <th>ID</th>
            <th>Jumlah Pakaian</th>
            <th>Berat</th>
            <th>Jenis Layanan</th>
            <th>Harga Layanan</th>
            <th>Harga Antar</th>
            <th>Aksi</th>
          </tr>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["jumlah_pakaian"] . "</td>
            <td>" . $row["berat"] . "</td>
            <td>" . $row["jenis_layanan"] . "</td>
            <td>" . $row["harga_layanan"] . "</td>
            <td>" . $row["harga_antar"] . "</td>
            <td>
              <a href='edit_laundry.php?id=" . $row["id"] . "'>Edit</a> | 
              <a href='hapus_laundry.php?id=" . $row["id"] . "'>Hapus</a>
            </td>
          </tr>";
  }
  echo "</table>";
} else {
  echo "Tidak ada data laundry.";
}
?>