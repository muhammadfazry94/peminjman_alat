<?php
include 'koneksi.php';

// ambil data log
$query = mysqli_query($conn, "SELECT * FROM log_aktivitas ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log Aktivitas</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        body{
            background:#f4f6f9;
        }

        .card{
            border:none;
            border-radius:20px;
            box-shadow:0 4px 15px rgba(0,0,0,0.1);
        }

        .table thead{
            background:#212529;
            color:white;
        }

        .judul{
            font-weight:bold;
            color:#212529;
        }

        .badge-user{
            background:#0d6efd;
            font-size:14px;
            padding:8px 12px;
            border-radius:10px;
        }

        .badge-aktivitas{
            background:#198754;
            font-size:14px;
            padding:8px 12px;
            border-radius:10px;
        }

    </style>

</head>

<body>

<div class="container mt-5">

    <div class="card p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h2 class="judul">
                <i class="bi bi-clipboard-data"></i>
                Log Aktivitas
            </h2>

        </div>

        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>User</th>
                        <th>Aktivitas</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                $no = 1;

                while($data = mysqli_fetch_assoc($query)) :
                ?>

                    <tr>

                        <td><?= $no++; ?></td>

                        <td>
                            <span class="badge-user text-white">
                                <?= $data['user'] ?? 'admin'; ?>
                            </span>
                        </td>

                        <td>
                            <span class="badge-aktivitas text-white">
                                <?= $data['aktivitas'] ?? '-'; ?>
                            </span>
                        </td>

                        <td>
                            <?= $data['tanggal'] ?? date('Y-m-d H:i:s'); ?>
                        </td>

                    </tr>

                <?php endwhile; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>