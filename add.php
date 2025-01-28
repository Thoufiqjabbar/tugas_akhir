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
    $id_laundry = $_POST["id_laundry"];
    $jumlah_pakaian = $_POST["jumlah_pakaian"];
    $berat = $_POST["berat"];
    $jenis_layanan = $_POST["jenis_layanan"];
    $harga_layanan = $_POST["harga_layanan"];
    $harga_antar = $_POST["harga_antar"]; 

  

    $sql = "INSERT INTO laundry (id_laundry,jumlah_pakaian, berat, jenis_layanan, harga_layanan, harga_antar) 
            VALUES ('$id_laundry','$jumlah_pakaian', '$berat', '$jenis_layanan', '$harga_layanan', '$harga_antar')";

    if (mysqli_query($conn, $sql)) {
        echo "Pesanan berhasil ditambahkan.";
      
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
