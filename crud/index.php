<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <title>Form Pendaftaran</title>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <span class="navbar-brand mb-0 h1">FORM PENDAFTARAN</span>
    </nav>
    <div class="container">
        <br>
        <h4><center>PENDAFTARAN PESERTA PELATIHAN</center></h4>

        <?php
            include "koneksi.php";

            // Cek apakah ada kiriman form dari method post
            if (isset($_GET['id_peserta'])) {
                $id_peserta = htmlspecialchars($_GET["id_peserta"]);

                $sql = "delete from peserta where id_peserta='$id_peserta' ";
                $hasil = mysqli_query($kon, $sql);

                // Kondisi apakah berhasil atau tidak
                if ($hasil) {
                    header("Location:index.php");
                } else {
                    echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";
                }
            }
        ?>

        <table class="my-3 table table-bordered">
            <thead class="table-primary">
                <tr>
                    <th><center>No</center></th>
                    <th><center>Nama</center></th>
                    <th><center>Universitas</center></th>
                    <th><center>Jurusan</center></th>
                    <th><center>No Hp</center></th>
                    <th><center>Email</center></th>
                    <th><center>Alamat</center></th>
                    <th colspan='2'><center>Aksi</center></th>
                </tr>
            </thead>

            <?php
                include "koneksi.php";
                $sql = "select * from peserta order by id_peserta desc";
                $hasil = mysqli_query($kon, $sql);
                $no = 0;

                while ($data = mysqli_fetch_array($hasil)) {
                    $no++;
            ?>
                <tbody>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $data["nama"]; ?></td>
                        <td><?php echo $data["universitas"]; ?></td>
                        <td><?php echo $data["jurusan"]; ?></td>
                        <td><?php echo $data["no_hp"]; ?></td>
                        <td><?php echo $data["email"]; ?></td>
                        <td><?php echo $data["alamat"]; ?></td>
                        <td>
                            <a href="update.php?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>" class="btn btn-warning" role="button">Update</a>
                            <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>?id_peserta=<?php echo $data['id_peserta']; ?>" class="btn btn-danger" role="button">Delete</a>
                        </td>
                    </tr>
                </tbody>
            <?php
                }
            ?>
        </table>
        <a href="create.php" class="btn btn-primary" role="button">Tambah Data</a>
    </div>
</body>
</html>