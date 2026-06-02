<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';
session_start();

// Cek login
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit;
}

// PROSES PINJAM
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $user = $_SESSION['user'];
    $alat_id = $_POST['alat_id'] ?? '';
    $jumlah = $_POST['jumlah'] ?? 0;

    // Validasi
    if($alat_id == '' || $jumlah <= 0){
        echo "<script>alert('Data tidak lengkap!');</script>";
    } else {

        $q = mysqli_query($conn, "SELECT * FROM alat WHERE id='$alat_id'");
        $alat = mysqli_fetch_assoc($q);

        if(!$alat){
            echo "<script>alert('Alat tidak ditemukan!');</script>";
        } 
        else if($jumlah > $alat['stok']){
            echo "<script>alert('Stok tidak cukup!');</script>";
        } 
        else {
            // Simpan peminjaman
            mysqli_query($conn, "INSERT INTO peminjaman (user, alat_id, jumlah, status)
                VALUES ('$user','$alat_id','$jumlah','Menunggu')");

            echo "<script>alert('Berhasil ajukan peminjaman!');window.location='dashboard.php';</script>";
            exit;
        }
    }
}

// Ambil data alat
$data = mysqli_query($conn, "SELECT * FROM alat");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajukan Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header text-white" style="background: linear-gradient(45deg, purple, blue);">
            <h5>Ajukan Peminjaman Alat</h5>
        </div>

        <div class="card-body">
            <form method="POST">

                <div class="mb-3">
                    <label>Nama User</label>
                    <input type="text" class="form-control" value="<?= $_SESSION['user']; ?>" readonly>
                </div>

                <div class="mb-3">
                    <label>Pilih Alat</label>
                    <select name="alat_id" id="alat" class="form-control" required>
                        <option value="">-- Pilih Alat --</option>
                        <?php while($row = mysqli_fetch_assoc($data)) { ?>
                            <option value="<?= $row['id']; ?>">
                                <?= $row['nama_alat']; ?> | Stok: <?= (int)$row['stok']; ?> unit
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Jumlah Pinjam</label>
                    <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
                </div>

                <button type="submit" class="btn btn-success">
                    Ajukan Peminjaman
                </button>

                <a href="dashboard.php" class="btn btn-secondary">Kembali</a>

            </form>
        </div>
    </div>
</div>

<script>
// Batasi jumlah sesuai stok
const alat = document.getElementById('alat');
const jumlah = document.getElementById('jumlah');

alat.addEventListener('change', function(){
    let text = this.options[this.selectedIndex].text;
    let match = text.match(/Stok: (\d+)/);

    if(match){
        jumlah.max = match[1];
    }
});
</script>

</body>
</html>