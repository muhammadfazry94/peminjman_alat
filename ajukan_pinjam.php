<?php
session_start();
$conn = mysqli_connect("localhost","root","","peminjaman_alat");

// cek login
if(!isset($_SESSION['id_user'])){
    header("location: login.php");
}

// simpan data
if(isset($_POST['pinjam'])){
    $user = $_SESSION['id_user'];
    $alat = $_POST['alat'];
    $tgl1 = $_POST['tgl_pinjam'];
    $tgl2 = $_POST['tgl_kembali'];

    mysqli_query($conn,"INSERT INTO peminjaman VALUES(
        '',
        '$user',
        '$alat',
        '$tgl1',
        '$tgl2',
        'menunggu',
        0
    )");

    echo "<div class='alert alert-success'>Pengajuan berhasil dikirim!</div>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajukan Peminjaman</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h3 class="mb-4">📋 Ajukan Peminjaman</h3>

    <!-- FORM -->
    <form method="POST" class="card p-4 shadow">

        <!-- PILIH ALAT -->
        <label>Nama Alat</label>
        <select name="alat" class="form-control mb-3" required>
            <option value="">-- Pilih Alat --</option>
            <?php
            $alat = mysqli_query($conn,"SELECT * FROM alat WHERE jumlah > 0");
            while($a=mysqli_fetch_array($alat)){
                echo "<option value='$a[id]'>$a[nama_alat] (Stok: $a[jumlah])</option>";
            }
            ?>
        </select>

        <!-- TANGGAL -->
        <label>Tanggal Pinjam</label>
        <input type="date" name="tgl_pinjam" class="form-control mb-3" required>

        <label>Tanggal Kembali</label>
        <input type="date" name="tgl_kembali" class="form-control mb-3" required>

        <!-- BUTTON -->
        <button class="btn btn-success" name="pinjam">📤 Ajukan</button>

    </form>

    <a href="dashboard.php" class="btn btn-secondary mt-3">⬅ Kembali</a>

</div>

</body>
</html>