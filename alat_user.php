<?php
$conn = mysqli_connect("localhost","root","","peminjaman_alat");
$data = mysqli_query($conn,"SELECT * FROM alat");
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h3>Daftar Alat</h3>

    <table class="table table-striped">
        <tr>
            <th>No</th>
            <th>Nama Alat</th>
            <th>Jumlah</th>
        </tr>

        <?php $no=1; while($d=mysqli_fetch_array($data)){ ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $d['nama_alat'] ?></td>
            <td><?= $d['jumlah'] ?></td>
        </tr>
        <?php } ?>
    </table>

    <a href="dashboard.php" class="btn btn-secondary">Kembali</a>
</div>