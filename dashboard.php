<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| PROSES KEMBALIKAN ALAT
|--------------------------------------------------------------------------
*/

if(isset($_GET['kembalikan'])){

    $id = $_GET['kembalikan'];

    // ambil data peminjaman
    $ambil = mysqli_query($conn,"
        SELECT * FROM peminjaman
        WHERE id='$id'
    ");

    $pinjam = mysqli_fetch_assoc($ambil);

    // kembalikan stok alat
    mysqli_query($conn,"
        UPDATE alat
        SET jumlah = jumlah + $pinjam[jumlah]
        WHERE id='$pinjam[alat_id]'
    ");

    // ubah status
    mysqli_query($conn,"
        UPDATE peminjaman
        SET status='Dikembalikan'
        WHERE id='$id'
    ");

    header("Location: dashboard.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| STATISTIK
|--------------------------------------------------------------------------
*/

$total_alat   = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM alat"));

$total_pinjam = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM peminjaman"));

$menunggu     = mysqli_num_rows(mysqli_query($conn, "
SELECT * FROM peminjaman
WHERE status='Menunggu'
"));

/*
|--------------------------------------------------------------------------
| DATA PEMINJAMAN
|--------------------------------------------------------------------------
*/

$data = mysqli_query($conn, "
    SELECT p.*, a.nama_alat
    FROM peminjaman p
    LEFT JOIN alat a ON p.alat_id = a.id
    ORDER BY p.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            background:#f4f6f9;
        }

        .sidebar{
            width:240px;
            height:100vh;
            position:fixed;
            background:#111827;
            color:white;
        }

        .sidebar h4{
            padding:20px;
            border-bottom:1px solid #374151;
        }

        .sidebar a{
            display:block;
            padding:12px 20px;
            color:#9ca3af;
            text-decoration:none;
        }

        .sidebar a:hover{
            background:#1f2937;
            color:white;
        }

        .content{
            margin-left:250px;
            padding:20px;
        }

        .card-box{
            border-radius:12px;
            padding:20px;
            color:white;
        }

        .c1{
            background:#3b82f6;
        }

        .c2{
            background:#10b981;
        }

        .c3{
            background:#f59e0b;
        }

        .table-box{
            background:white;
            padding:15px;
            border-radius:10px;
        }

    </style>
</head>

<body>

<!-- SIDEBAR -->
<div class="sidebar">

    <h4>ADMIN CEO</h4>

    <a href="dashboard.php">Dashboard</a>
    <a href="alat.php">Data Alat</a>
    <a href="pinjam.php">Peminjaman</a>
    <a href="log.php">Log Aktivitas</a>
    <a href="pengembalian.php">
    monitoring pengembalian </a>   
    <a href="logout.php">Logout</a>

</div>

<!-- CONTENT -->
<div class="content">

    <h4>Halo, <?= $_SESSION['user']; ?> 👋</h4>

    <!-- STATISTIK -->
    <div class="row mt-3">

        <div class="col-md-4">
            <div class="card-box c1 shadow">

                <h6>Total Alat</h6>
                <h2><?= $total_alat ?></h2>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box c2 shadow">

                <h6>Total Peminjaman</h6>
                <h2><?= $total_pinjam ?></h2>

            </div>
        </div>

        <div class="col-md-4">
            <div class="card-box c3 shadow">

                <h6>Menunggu</h6>
                <h2><?= $menunggu ?></h2>

            </div>
        </div>

    </div>

    <!-- TABEL -->
    <div class="table-box mt-4 shadow">

        <h5>Data Peminjaman</h5>
        <a href="laporan.php"
class="btn btn-primary mb-3">

Cetak Laporan

</a>

        <table class="table table-bordered mt-3">

            <tr class="table-dark">

                <th>No</th>
                <th>User</th>
                <th>Alat</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Aksi</th>

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

                    <?php if($row['status']=='Disetujui'){ ?>

                        <span class="badge bg-success">
                            Disetujui
                        </span>

                    <?php } elseif($row['status']=='Ditolak'){ ?>

                        <span class="badge bg-danger">
                            Ditolak
                        </span>

                    <?php } elseif($row['status']=='Dikembalikan'){ ?>

                        <span class="badge bg-secondary">
                            Dikembalikan
                        </span>

                    <?php } else { ?>

                        <span class="badge bg-warning text-dark">
                            Menunggu
                        </span>

                    <?php } ?>

                </td>

                <td>

                    <?php if($row['status']=='Menunggu'){ ?>

                        <a href="acc.php?id=<?= $row['id'] ?>"
                        class="btn btn-success btn-sm">
                        ACC
                        </a>

                        <a href="tolak.php?id=<?= $row['id'] ?>"
                        class="btn btn-danger btn-sm">
                        Tolak
                        </a>

                    <?php } elseif($row['status']=='Disetujui'){ ?>

                        <a href="dashboard.php?kembalikan=<?= $row['id'] ?>"
                        class="btn btn-warning btn-sm">
                        Kembalikan
                        </a>

                    <?php } elseif($row['status']=='Dikembalikan'){ ?>

                        <button class="btn btn-secondary btn-sm" disabled>
                            Sudah Kembali
                        </button>

                    <?php } else { ?>

                        -

                    <?php } ?>

                </td>

            </tr>

            <?php } ?>

        </table>

    </div>

</div>

</body>
</html>