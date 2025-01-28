<h2>Selamat Datang di Laundry Online</h2>

<form method="post" action="login.php">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <input type="submit" value="Login">
</form>

<p>Belum punya akun? <a href="?p=register">Daftar di sini</a></p>
<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $error = array(); // Inisialisasi array untuk menyimpan pesan error

    // Validasi Username
    if (empty($username)) {
        $error[] = "Username tidak boleh kosong."; // Menggunakan array untuk menyimpan pesan error
    }

    // Validasi Password
    if (empty($password)) {
        $error[] = "Password tidak boleh kosong."; // Menggunakan array untuk menyimpan pesan error
    }

    // Jika tidak ada error, proses login
    if (empty($error)) {
        // Mencegah SQL Injection dengan prepared statements
        $sql = "SELECT * FROM user WHERE username=? AND password=?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            // Login berhasil
            $_SESSION["username"] = $username; // Simpan username di session
            header("Location: beranda.php"); // Arahkan ke halaman utama
            exit(); // Tambahkan exit setelah header untuk menghentikan eksekusi
        } else {
            // Login gagal
            $error[] = "Username atau password salah."; // Menggunakan array untuk menyimpan pesan error
        }
    }

    // Tampilkan pesan error jika ada
    if (!empty($error)) {
        echo "<ul>";
        foreach ($error as $msg) {
            echo "<li>" . $msg . "</li>";
        }
        echo "</ul>";
    }
}
?>

