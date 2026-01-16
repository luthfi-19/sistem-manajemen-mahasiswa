<?php
session_start();
include 'config/database.php';

// Cek apakah user sudah login? Kalau sudah, lempar ke dashboard
if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
    header("location:dashboard.php");
    exit();
}

$message = "";

// LOGIKA LOGIN
if (isset($_POST['login_btn'])) {
    $username = mysqli_real_escape_string($db_connect, $_POST['username']);
    $password = $_POST['password']; // Password inputan user

    // Cari user berdasarkan username
    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($db_connect, $query);

    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);

        // Cek Password (Sederhana untuk pembelajaran)
        // Catatan Dosen: Nanti jika sudah mahir, ganti '==' dengan password_verify()
        if ($password == $data['password']) {
            
            // SET SESSION
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = $data['role'];
            $_SESSION['status'] = "login";

            // --- TAMBAHAN BARU: AMBIL NAMA ASLI ---
            // Default nama tampilan adalah username (untuk Admin)
            $_SESSION['nama_lengkap'] = $data['username'];

            // Jika yang login Mahasiswa, kita cari nama aslinya
            if($data['role'] == 'mahasiswa'){
                $id_user = $data['id'];
                $cari_mhs = mysqli_query($db_connect, "SELECT nama FROM mahasiswa WHERE user_id = '$id_user'");
                
                // Jika datanya ketemu, timpa session nama_lengkap
                if($data_mhs = mysqli_fetch_assoc($cari_mhs)){
                    $_SESSION['nama_lengkap'] = $data_mhs['nama'];
                }
            }
            
            // Redirect ke Dashboard
            header("location:dashboard.php");
            exit();

        } else {
            $message = "Password salah!";
        }
    } else {
        $message = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Mahasiswa</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="login-body">

    <div class="login-container">
        <div class="login-header">
            <h2>SISTEM KAMPUS</h2>
            <p>Silakan login untuk masuk</p>
        </div>

        <?php if($message != ""): ?>
            <div class="alert-error">
                <?= $message; ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required autocomplete="off">
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>
            </div>

            <button type="submit" name="login_btn" class="btn-login">LOGIN</button>
        </form>

        <div class="login-footer">
            <p>Project UAS Kelompok &copy; 2026</p>
        </div>
    </div>

</body>
</html>