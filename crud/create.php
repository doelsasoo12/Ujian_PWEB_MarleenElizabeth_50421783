<!DOCTYPE html>
<html>
<head>
    <title>Form Pendaftaran Peserta</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php

    // Include file koneksi, untuk koneksikan ke database
    include "koneksi.php";

    // Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Cek apakah ada kiriman form dari method post
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nama = input($_POST["nama"]);
        $universitas = input($_POST["universitas"]);
        $jurusan = input($_POST["jurusan"]);
        $no_hp = input($_POST["no_hp"]);
        $email = input($_POST["email"]);
        $alamat = input($_POST["alamat"]);
        
        // Gunakan pernyataan yang sudah disiapkan untuk memasukkan data ke dalam tabel peserta
        $sql = "INSERT INTO peserta (nama, universitas, jurusan, no_hp, email, alamat) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        // Menyiapkan pernyataan
        $stmt = mysqli_prepare($kon, $sql);

        // Mengikat parameter ke pernyataan yang telah disiapkan
        mysqli_stmt_bind_param($stmt, "ssssss", $nama, $universitas, $jurusan, $no_hp, $email, $alamat);

        // Jalankan pernyataan tersebut
        $hasil = mysqli_stmt_execute($stmt);

        // Periksa apakah operasi berhasil dilakukan
        if ($hasil) {
            header("Location: index.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }

        // Menutup pernyataan
        mysqli_stmt_close($stmt);
    }

    ?>
    <h2>Input Data</h2>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="form-group">
            <label>Nama :</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required />
        </div>
        <div class="form-group">
            <label>Universitas :</label>
            <input type="text" name="universitas" class="form-control" placeholder="Masukan Nama Universitas" required/>
        </div>
       <div class="form-group">
            <label>Jurusan :</label>
            <input type="text" name="jurusan" class="form-control" placeholder="Masukan Jurusan" required/>
        </div>
        <div class="form-group">
            <label>No HP :</label>
            <input type="text" name="no_hp" class="form-control" placeholder="Masukan No HP" required/>
        </div>
        <div class="form-group">
            <label>Email :</label>
            <input type="text" name="email" class="form-control" placeholder="Masukan Email" required/>
        </div>
        <div class="form-group">
            <label>Alamat :</label>
            <textarea name="alamat" class="form-control" rows="5"placeholder="Masukan Alamat" required></textarea>
        </div>  

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        
    </form>
</div>
</body>
</html>