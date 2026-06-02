<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = "UPDATE peminjaman SET status='ditolak' WHERE id='$id'";
mysqli_query($koneksi, $query) or die(mysqli_error($koneksi));

header("location: approval.php");
?>