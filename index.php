<?php
include "koneksi.php";

if (isset($_GET["p"])) {
  $p = $_GET["p"];
  switch ($p) {
    case "logout":
      include "logout.php";
      break;
    case "login":
      include "login.php";
      break;
    case "add":
      include "add.php";
      break;
    case "register":
      include "register.php";
      break;
    case "edit":
      include "edit.php";
      break;
    case "admin":
      include "admin.php";
      break;
    case "home":
    default:
      include "home.php";
      break;
  }
} else {
  include "home.php";
}
?>