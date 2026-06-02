<?php
session_start();
$conn = mysqli_connect("localhost","root","","peminjaman_alat");

$data = mysqli_query($conn,"
SELECT p.*, u.username, a.nama_alat
FROM peminjaman p
JOIN users u ON p.user_id = u.id
JOIN alat a ON p.alat_id = a.id
WHERE p.status='diambil' OR p.status='dikembalikan'
ORDER BY p.tanggal_kembali ASC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Monitoring Pengembalian</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">
    <h3>📊 Monitoring Pengembalian</h3>

    <table class="table table-bordered table-striped">
        <tr>
            <th>User</th>
            <th>Alat</th>
            <th>Tgl Pinjam</th>
            <th>Tgl Kembali</th>
            <th>Status</th>
            <th>Keterangan</th>
        </tr>

        <?php while($d=mysqli_fetch_array($data)){ 
        
        $hari_ini = date('Y-m-d');
        ?>
        $hari_ini = date('Y-m-d');

        <tr>
            <td><?= $d['username'] ?></td>
            <td><?= $d['nama_alat'] ?></td>
            <td><?= $d['tanggal_pinjam'] ?></td>
            <td><?= $d['tanggal_kembali'] ?></td>

            <!-- STATUS -->
            <td>
                <?php
                if($d['status']=='diambil'){
                    echo "<span class='badge bg-primary'>Dipinjam</span>";
                } else {
                    echo "<span class='badge bg-success'>Dikembalikan</span>";
                }
                ?>
            </td>

            <!-- KETERANGAN -->
            <td>
                <?php
                if($d['status']=='diambil' && $hari_ini > $d['tanggal_kembali']){
                    echo "<span class='badge bg-danger'>Telat</span>";
                } elseif($d['status']=='dikembalikan'){
                    if($d['tanggal_kembali'] >= $hari_ini){
                        echo "<span class='badge bg-success'>Tepat Waktu</span>";
                    } else {
                        echo "<span class='badge bg-warning'>Telat Dikembalikan</span>";
                    }
                } else {
                    echo "<span class='badge bg-secondary'>Menunggu</span>";
                }
                ?>
            </td>

        </tr>

        <?php } ?>
    </table>

    <a href="dashboard.php" class="btn btn-secondary">⬅ Kembali</a>
</div>

</body>
</html>