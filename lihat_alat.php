<?php
session_start();
$conn = mysqli_connect("localhost","root","","peminjaman_alat");

// ambil data alat
$data = mysqli_query($conn,"SELECT * FROM alat");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Alat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h3 class="mb-4">📦 Daftar Alat</h3>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Alat</th>
                <th>Jumlah</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>
        <?php $no=1; while($d=mysqli_fetch_array($data)){ ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $d['nama_alat'] ?></td>
                <td><?= $d['jumlah'] ?></td>

                <!-- STATUS -->
                <td>
                    <?php
                    if($d['jumlah'] > 0){
                        echo "<span class='badge bg-success'>Tersedia</span>";
                    } else {
                        echo "<span class='badge bg-danger'>Habis</span>";
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="btn btn-secondary">⬅ Kembali</a>

</div>

</body>
</html>