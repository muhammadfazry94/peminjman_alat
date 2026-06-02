<?php
session_start();
$conn = mysqli_connect("localhost","root","","peminjaman_alat");

$pesan = "";

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $data = mysqli_query($conn,"SELECT * FROM users WHERE username='$user' AND password='$pass'");
    $cek = mysqli_num_rows($data);

    if($cek > 0){
        $d = mysqli_fetch_array($data);
        $_SESSION['user'] = $d['username'];
        $_SESSION['id'] = $d['id'];
        $_SESSION['role'] = $d['role'];

        header("location: dashboard.php");
    }else{
        $pesan = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background: linear-gradient(135deg, #6c5ce7, #0984e3);
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    font-family:Segoe UI;
}

/* CARD LOGIN */
.login-box{
    background:white;
    padding:30px;
    border-radius:15px;
    width:350px;
    box-shadow:0 10px 25px rgba(0,0,0,0.2);
}

/* TITLE */
.login-box h3{
    text-align:center;
    margin-bottom:20px;
}

/* BUTTON */
.btn-login{
    background:#6c5ce7;
    color:white;
}

.btn-login:hover{
    background:#5a4bd6;
}
</style>

</head>

<body>

<div class="login-box">

<h3>🔐 LOGIN PEMINJAMAN ALAT</h3>

<?php if($pesan != ""){ ?>
<div class="alert alert-danger"><?= $pesan ?></div>
<?php } ?>

<form method="POST">

<div class="mb-3">
<input type="text" name="username" class="form-control" placeholder="Username" required>
</div>

<div class="mb-3">
<input type="password" name="password" class="form-control" placeholder="Password" required>
</div>

<button name="login" class="btn btn-login w-100">Login</button>

</form>

</div>

</body>
</html>