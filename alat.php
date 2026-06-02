<?php
include 'koneksi.php';

// tambah data
if(isset($_POST['tambah'])){

    $nama_alat = $_POST['nama_alat'];
    $jumlah = $_POST['jumlah'];

    mysqli_query($conn,"
        INSERT INTO alat(nama_alat, jumlah)
        VALUES('$nama_alat','$jumlah')
    ");

    header("Location: alat.php");
}

// hapus data
if(isset($_GET['hapus'])){

    $id = $_GET['hapus'];

    mysqli_query($conn,"DELETE FROM alat WHERE id='$id'");

    header("Location: alat.php");
}

// tampil data
$query = mysqli_query($conn,"SELECT * FROM alat ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Alat</title>

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

        .form-control{
            border-radius:12px;
            height:50px;
        }

        .btn-custom{
            border-radius:12px;
            height:50px;
        }

        .table thead{
            background:#212529;
            color:white;
        }

        .badge-jumlah{
            font-size:14px;
            padding:8px 14px;
            border-radius:10px;
        }

        .judul{
            font-weight:bold;
        }

    </style>
</head>

<body>

<div class="container mt-5">

    <div class="card p-4">

        <h2 class="judul mb-4">
            <i class="bi bi-box-seam"></i>
            Data Alat
        </h2>

        <!-- FORM -->
        <form method="POST">

            <div class="row">

                <div class="col-md-5 mb-3">
                    <input type="text"
                           name="nama_alat"
                           class="form-control"
                           placeholder="Nama alat"
                           required>
                </div>

                <div class="col-md-5 mb-3">
                    <input type="number"
                           name="jumlah"
                           class="form-control"
                           placeholder="Jumlah"
                           required>
                </div>

                <div class="col-md-2 mb-3">
                    <button type="submit"
                            name="tambah"
                            class="btn btn-success w-100 btn-custom">

                        <i class="bi bi-plus-circle"></i>
                        Tambah

                    </button>
                </div>

            </div>

        </form>

        <!-- TABEL -->
        <div class="table-responsive">

            <table class="table table-bordered table-hover align-middle">

                <thead>
                    <tr>
                        <th width="60">No</th>
                        <th>Nama Alat</th>
                        <th width="150">Jumlah</th>
                        <th width="120">Aksi</th>
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
                            <b><?= $data['nama_alat']; ?></b>
                        </td>

                        <td>

                            <span class="badge bg-primary badge-jumlah">
                                <?= $data['jumlah']; ?>
                            </span>

                        </td>

                        <td>

                            <a href="?hapus=<?= $data['id']; ?>"
                               onclick="return confirm('Yakin hapus data?')"
                               class="btn btn-danger btn-sm">

                                <i class="bi bi-trash"></i>
                                Hapus

                            </a>

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