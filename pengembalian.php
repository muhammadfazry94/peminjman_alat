<?php
include 'koneksi.php';
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

$data = mysqli_query($conn,"
SELECT p.*, a.nama_alat
FROM peminjaman p
LEFT JOIN alat a ON p.alat_id = a.id
WHERE p.status='Dikembalikan'
ORDER BY p.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Monitoring Pengembalian</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f4f6f9;
        }

        .container-box{
            background:white;
            padding:20px;
            margin-top:30px;
            border-radius:10px;
        }

    </style>
</head>

<body>

<div class="container mt-4">

    <div class="container-box shadow">

        <h3>Monitoring Pengembalian Alat</h3>

        <table class="table table-bordered mt-4">

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

                <td>
                    <span class="badge bg-success">
                        <?= $row['status'] ?>
                    </span>
                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>
