<?php
include "../koneksi.php";
include "index.php";

$sql = "SELECT * FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  echo "<table border='1'>
          <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No. HP</th>
            <th>Aksi</th>
          </tr>";
  while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>" . $row["id"] . "</td>
            <td>" . $row["username"] . "</td>
            <td>" . $row["nama"] . "</td>
            <td>" . $row["alamat"] . "</td>
            <td>" . $row["no_hp"] . "</td>
            <td>
              <a href='edit_user.php?id=" . $row["id"] . "'>Edit</a> | 
              <a href='hapus_user.php?id=" . $row["id"] . "'>Hapus</a>
            </td>
          </tr>";
  }
  echo "</table>";
} else {
  echo "Tidak ada data user.";
}
?>