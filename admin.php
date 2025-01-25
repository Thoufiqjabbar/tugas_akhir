<?php
session_start();

include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $_SESSION["username"] = $username;
    echo "Login berhasil!";
  } else {
    echo "Username atau password salah!";
  }
}

if (isset($_SESSION["username"])) {
?>
  <h2>Halaman Admin</h2>
  <a href="admin/index.php">Dashboard Admin</a>
<?php
} else {
?>
  <h2>Login Admin</h2>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Username: <input type="text" name="username"><br><br>
    Password: <input type="password" name="password"><br><br>
    <input type="submit" value="Login">
  </form>
<?php
}
?>