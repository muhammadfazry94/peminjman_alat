<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'koneksi.php';

// Ambil ID
$id = $_GET['id'] ?? '';

if($id == ''){
    die("ID tidak ditemukan");
}

// Ambil data peminjaman
$q = mysqli_query($conn, "SELECT * FROM peminjaman WHERE id='$id'");
$data = mysqli_fetch_assoc($q);

// Cek data ada
if(!$data){
    die("Data peminjaman tidak ditemukan");
}

$alat_id = $data['alat_id'];
$jumlah  = $data['jumlah'];

// Ambil stok alat
$q2 = mysqli_query($conn, "SELECT * FROM alat WHERE id='$alat_id'");
$alat = mysqli_fetch_assoc($q2);

if(!$alat){
    die("Data alat tidak ditemukan");
}

// Cek stok cukup
if($alat['stok'] < $jumlah){
    die("Stok tidak cukup untuk ACC!");
}

// Kurangi stok
mysqli_query($conn, "
    UPDATE alat SET stok = stok - $jumlah WHERE id='$alat_id'
");

// Update status
mysqli_query($conn, "
    UPDATE peminjaman SET status='Disetujui' WHERE id='$id'
");

// Kembali ke dashboard
header("Location: dashboard.php");
exit;
?>