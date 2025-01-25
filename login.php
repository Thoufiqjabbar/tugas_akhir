<?php
session_start();
include "koneksi.php";

$error_message = ""; // Variabel untuk menyimpan pesan error

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $remember = isset($_POST["remember"]) ? true : false; // Cek apakah checkbox "ingat saya" dicentang

  $sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    $_SESSION["username"] = $username;

    // Jika "ingat saya" dicentang, set cookie
    if ($remember) {
      setcookie("username", $username, time() + (86400 * 30), "/"); // Cookie berlaku 30 hari
      setcookie("password", $password, time() + (86400 * 30), "/");
    }

    header("Location: home.php"); // Redirect ke halaman home setelah login berhasil
  
  } else {
    $error_message = "Username atau password salah!";
    header("Location: login.php"); // Redirect ke halaman login jika login gagal
    
  }
}

// Jika cookie ada, isi field username dan password
if (isset($_COOKIE["username"])) {
  $username = $_COOKIE["username"];
  $password = $_COOKIE["password"];
} else {
  $username = "";
  $password = "";
}
?>

<h2>Form Login</h2>

<?php if ($error_message): ?>
<p style="color: red;"><?php echo $error_message; ?></p>
<?php endif; ?>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
  Username: <input type="text" name="username" value="<?php echo $username; ?>"><br><br>
  Password: <input type="password" name="password" value="<?php echo $password; ?>"><br><br>
  <input type="checkbox" name="remember" id="remember"> <label for="remember">Ingat Saya</label><br><br>
  <input type="submit" value="Login">
</form>

<script>
  // Validasi JavaScript untuk memastikan field tidak kosong
  function validateForm() {
    var username = document.forms["loginForm"]["username"].value;
    var password = document.forms["loginForm"]["password"].value;

    if (username == "" || password == "") {
      alert("Harap isi username dan password.");
      return false;
    }
  }
</script>