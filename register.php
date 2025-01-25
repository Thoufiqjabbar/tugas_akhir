<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $nama = $_POST["nama"];
  $alamat = $_POST["alamat"];
  $no_hp = $_POST["no_hp"];

  // Prepare the SQL statement
  $stmt = $conn->prepare("INSERT INTO user (username, password, nama, alamat, no_hp) VALUES (?, ?, ?, ?, ?)");
  $stmt->bind_param("sssss", $username, $password, $nama, $alamat, $no_hp);

  // Execute the statement
  if ($stmt->execute()) {
    echo "Registrasi berhasil!";
  } else {
    echo "Error: " . $stmt->error;
  }
  
  // Close the statement
  $stmt->close();
}
?>

<h2>Form Registrasi</h2>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  Username: <input type="text" name="username"><br><br>
  Password: <input type="password" name="password"><br><br>
  Nama: <input type="text" name="nama"><br><br>
  Alamat: <textarea name="alamat"></textarea><br><br>
  No. HP: <input type="text" name="no_hp"><br><br>
  <input type="submit" value="Register">
</form>