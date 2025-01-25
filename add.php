<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $jumlah_pakaian = $_POST["jumlah_pakaian"];
  $berat = $_POST["berat"];
  $jenis_layanan = $_POST["jenis_layanan"];
  $harga_layanan = $_POST["harga_layanan"];
  $harga_antar = $_POST["harga_antar"];

  $sql = "INSERT INTO laundry (jumlah_pakaian, berat, jenis_layanan, harga_layanan, harga_antar) 
          VALUES ('$jumlah_pakaian', '$berat', '$jenis_layanan', '$harga_layanan', '$harga_antar')";

  if ($conn->query($sql) === TRUE) {
    echo "Data berhasil ditambahkan";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Fetch jenis layanan from database
$sql_layanan = "SELECT * FROM jenis_layanan";
$result_layanan = $conn->query($sql_layanan);
?>

<h2>Tambah Data Laundry</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  Jumlah Pakaian: <input type="number" name="jumlah_pakaian"><br><br>
  Berat: <input type="number" name="berat"><br><br>
  Jenis Layanan:
  <select name="jenis_layanan">
    <?php
    if ($result_layanan->num_rows > 0) {
      while ($row_layanan = $result_layanan->fetch_assoc()) {
        echo "<option value='" . $row_layanan["nama_layanan"] . "'>" . $row_layanan["nama_layanan"] . "</option>";
      }
    } else {
      echo "<option value=''>Tidak ada jenis layanan</option>";
    }
    ?>
  </select><br><br>
  Harga Layanan: <input type="number" name="harga_layanan"><br><br>
  Harga Antar: <input type="number" name="harga_antar"><br><br>
  <input type="submit" value="Submit">
</form>