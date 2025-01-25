<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION["username"])) {
  header("Location: ../index.php?p=admin");
  exit();
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Dashboard Admin</title>
</head>

<body>

  <h2>Dashboard Admin</h2>
  <p>Selamat datang,
    <?php echo $_SESSION["username"]; ?>!
  </p>

  <nav>
    <ul>
      <li><a href="data_laundry.php">Data Laundry</a></li>
      <li><a href="data_order.php">Data Order</a></li>
      <li><a href="data_user.php">Data User</a></li>
      <li><a href="laporan.php">Laporan</a></li>
      <li><a href="../logout.php">Logout</a></li>
    </ul>
  </nav>

  <main>

  </main>

</body>

</html>