<h2>Tambah Pesanan Laundry</h2>

<form method="post" action="add.php">
    <label for="layanan">Jenis Layanan:</label><br>
    <select id="layanan" name="layanan">
        <option value="satuan">Cuci Satuan</option>
        <option value="kiloan">Cuci Kiloan</option>
        <option value="setrika">Cuci Kiloan dan Setrika</option>
    </select><br><br>

    <div id="form-satuan">
        <table>
            <thead>
                <tr>
                    <th>Jenis Pakaian</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Kemeja</td>
                    <td><input type="number" name="kemeja"></td>
                </tr>
                <tr>
                    <td>Celana Panjang</td>
                    <td><input type="number" name="celana_panjang"></td>
                </tr>
                </tbody>
        </table>
    </div>

    <div id="form-kiloan" style="display: none;">
        <label for="berat">Berat (Kg):</label><br>
        <input type="number" id="berat" name="berat"><br><br>
    </div>

    <div id="form-setrika" style="display: none;">
        <label for="berat_setrika">Berat (Kg):</label><br>
        <input type="number" id="berat_setrika" name="berat_setrika"><br><br>
    </div>

    <input type="submit" value="Tambah Pesanan">
</form>

<script>
    // JavaScript untuk menampilkan form input yang sesuai
    document.getElementById("layanan").addEventListener("change", function() {
        var layanan = this.value;
        if (layanan == "satuan") {
            document.getElementById("form-satuan").style.display = "block";
            document.getElementById("form-kiloan").style.display = "none";
            document.getElementById("form-setrika").style.display = "none";
        } else if (layanan == "kiloan") {
            document.getElementById("form-satuan").style.display = "none";
            document.getElementById("form-kiloan").style.display = "block";
            document.getElementById("form-setrika").style.display = "none";
        } else if (layanan == "setrika") {
            document.getElementById("form-satuan").style.display = "none";
            document.getElementById("form-kiloan").style.display = "none";
            document.getElementById("form-setrika").style.display = "block";
        }
    });
</script>
<?php
include "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id = 1;
    $jenis_layanan = $_POST["layanan"];
    $jumlah_pakaian = [];
    if ($jenis_layanan == "satuan") {
        $jumlah_pakaian["kemeja"] = $_POST["kemeja"];
        $jumlah_pakaian["celana_panjang"] = $_POST["celana_panjang"];
    }
    $berat = $_POST["berat"] ?? 0; // Menggunakan null coalescing operator
    $harga_layanan = $_POST["harga_layanan"];

    // Validasi input
    if (!is_numeric($berat) || $berat < 0 || !is_numeric($harga_layanan) || $harga_layanan < 0) {
        echo "Input tidak valid.";
        exit;
    }

    // Hitung harga total (contoh sederhana, perlu disesuaikan dengan logika bisnis)
    $harga_total = $harga_layanan * $berat;

    // Simpan data ke database
    $sql = "INSERT INTO pesanan (jenis_layanan, jumlah_pakaian, berat, harga_layanan, harga_total) 
            VALUES ('$jenis_layanan', '$jumlah_pakaian', $berat, $harga_layanan, $harga_total)";
    if (mysqli_query($conn, $sql)) {
        echo "Pesanan berhasil ditambahkan";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
