<?php
include "koneksi.php";

$id = $_GET["id"];

$sql = "DELETE FROM laundry WHERE id=$id";

if ($conn->query($sql) === TRUE) {
  echo "Data berhasil dihapus";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

header("Location: index.php");
exit();
?>