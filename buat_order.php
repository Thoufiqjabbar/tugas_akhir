<?php
session_start();
include "koneksi.php";



// Ambil data user dari database
$username = $_SESSION["username"];
$sql = "SELECT * FROM user WHERE username='$username'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();

// Proses pembuatan order
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_pelanggan = $_POST["id"];
  $jumlah_pakaian = $_POST["jumlah_pakaian"];
  $jenis_layanan = $_POST["jenis_layanan"];
 

  $sql = "INSERT INTO `order` (id_pelanggan, jumlah_pakaian, jenis_layanan) 
          VALUES ('$id_pelanggan', '$jumlah_pakaian', '$jenis_layanan')";

  if (var_dump($conn->query($sql)) === TRUE) {
    echo "Order berhasil dibuat.";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

// Fetch jenis layanan from database
$sql_layanan = "SELECT * FROM jen";
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
    echo "<option value='cuci_satuan'>Cuci Satuan</option>
          <option value='cuci_perkilo'>Cuci Perkilo</option>
          <option value='cuci_perkilo_dan_gosok'>Cuci Perkilo dan Gosok</option>";
  }
  ?>
  </select><br><br>
  
  <input type="submit" value="Buat Order">
</form>
<?php
var_dump($_POST);
?>