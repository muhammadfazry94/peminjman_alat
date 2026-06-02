<?php
session_start();
include 'koneksi.php';

$data = mysqli_query($conn,"
SELECT p.*, u.username, a.nama_alat 
FROM peminjaman p
JOIN users u ON p.user_id=u.id
JOIN alat a ON p.alat_id=a.id
ORDER BY p.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3>📦 Data Peminjaman</h3>

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>User</th>
            <th>Alat</th>
            <th>Jumlah</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php $no=1; while($d=mysqli_fetch_assoc($data)){ ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $d['username'] ?></td>
            <td><?= $d['nama_alat'] ?></td>
            <td><?= $d['jumlah'] ?></td>
            <td>
    <?php if($d['status'] == 'Menunggu'){ ?>
        <a href="acc.php?id=<?= $d['id'] ?>" class="btn btn-success btn-sm">ACC</a>
        <a href="tolak.php?id=<?= $d['id'] ?>" class="btn btn-danger btn-sm">Tolak</a>
    <?php } ?>
</td>
            <td>
                <?php
                if($d['status']=='Menunggu'){
                    echo "<span class='badge bg-warning'>Menunggu</span>";
                } elseif($d['status']=='Disetujui'){
                    echo "<span class='badge bg-success'>Disetujui</span>";
                } else {
                    echo "<span class='badge bg-danger'>Ditolak</span>";
                }
                ?>
            </td>

            <td>
                <?php if($d['status']=='Menunggu'){ ?>
                    <a href="acc.php?id=<?= $d['id'] ?>" class="btn btn-success btn-sm">ACC</a>
                    <a href="tolak.php?id=<?= $d['id'] ?>" class="btn btn-danger btn-sm">Tolak</a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>