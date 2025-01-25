<?php
include "koneksi.php";

$id = $_GET["id"];

$sql = "SELECT * FROM laundry WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $jumlah_pakaian = $_POST["jumlah_pakaian"];
  $berat = $_POST["berat"];
  $jenis_layanan = $_POST["jenis_layanan"];
  $harga_layanan = $_POST["harga_layanan"];
  $harga_antar = $_POST["harga_antar"];

  $sql = "UPDATE laundry SET 
          jumlah_pakaian='$jumlah_pakaian', 
          berat='$berat', 
          jenis_layanan='$jenis_layanan', 
          harga_layanan='$harga_layanan',
          harga_antar='$harga_antar'
          WHERE id=$id";

  if ($conn->query($sql) === TRUE) {
    echo "Data berhasil diupdate";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Fetch jenis layanan from database
$sql_layanan = "SELECT * FROM jenis_layanan";
$result_layanan = $conn->query($sql_layanan);
?>

<h2>Edit Data Laundry</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=$id"; ?>">
  Jumlah Pakaian: <input type="number" name="jumlah_pakaian" value="<?php echo $row["jumlah_pakaian"]; ?>"><br><br>
  Berat: <input type="number" name="berat" value="<?php echo $row["berat"]; ?>"><br><br>
  Jenis Layanan:
  <select name="jenis_layanan">
    <?php
    if ($result_layanan->num_rows > 0) {
      while ($row_layanan = $result_layanan->fetch_assoc()) {
        $selected = ($row_layanan["nama_layanan"] == $row["jenis_layanan"]) ? "selected" : "";
        echo "<option value='" . $row_layanan["nama_layanan"] . "' $selected>" . $row_layanan["nama_layanan"] . "</option>";
      }
    } else {
      echo "<option value=''>Tidak ada jenis layanan</option>";
    }
    ?>
  </select><br><br>
  Harga Layanan: <input type="number" name="harga_layanan" value="<?php echo $row["harga_layanan"]; ?>"><br><br>
  Harga Antar: <input type="number" name="harga_antar" value="<?php echo $row["harga_antar"]; ?>"><br><br>
  <input type="submit" value="Submit">
</form>