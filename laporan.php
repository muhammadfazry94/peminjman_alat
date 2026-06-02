<?php
include 'koneksi.php';

$data = mysqli_query($conn,"
SELECT p.*, a.nama_alat
FROM peminjaman p
LEFT JOIN alat a ON p.alat_id = a.id
ORDER BY p.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            padding:20px;
        }

        h3{
            text-align:center;
            margin-bottom:20px;
        }

    </style>
</head>

<body onload="window.print()">

<h3>LAPORAN PEMINJAMAN ALAT</h3>

<table class="table table-bordered">

    <tr class="table-dark">

        <th>No</th>
        <th>User</th>
        <th>Nama Alat</th>
        <th>Jumlah</th>
        <th>Status</th>

    </tr>

    <?php
    $no = 1;

    while($row = mysqli_fetch_assoc($data)){
    ?>

    <tr>

        <td><?= $no++ ?></td>

        <td><?= $row['user'] ?></td>

        <td><?= $row['nama_alat'] ?></td>

        <td><?= $row['jumlah'] ?></td>

        <td><?= $row['status'] ?></td>

    </tr>

    <?php } ?>

</table>

</body>
</html>