<?php
session_start();
include 'config/database.php';

// Cek Login
if (!isset($_SESSION['status'])) {
    header("location:index.php");
    exit();
}

// Ambil Data User yang Login
$id_user = $_SESSION['user_id'];
$query = mysqli_query($db_connect, "SELECT * FROM mahasiswa WHERE user_id = '$id_user'");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak KTM - <?= $data['nama']; ?></title>
    
    <link rel="stylesheet" href="assets/css/ktm.css">
</head>
<body>

    <div class="ktm-card">
        
        <div class="circle-bg"></div>
        
        <?php 
            $path_foto = "assets/img/" . $data['foto'];
            if ($data['foto'] != "default.jpg" && file_exists($path_foto)) {
                echo '<img src="'.$path_foto.'" class="ktm-foto">';
            } else {
                echo '<img src="https://ui-avatars.com/api/?name='.$data['nama'].'&background=random" class="ktm-foto">';
            }
        ?>

        <div class="ktm-info">
            <div class="ktm-header">Kartu Tanda Mahasiswa</div>
            <div class="ktm-nama"><?= $data['nama']; ?></div>
            <div class="ktm-nim"><?= $data['nim']; ?></div>
            <div class="ktm-prodi"><?= $data['jurusan']; ?></div>
            
            <div class="ktm-footer">
                STMIK MARDIRA INDONESIA<br>
                Kartu ini berlaku selama menjadi mahasiswa aktif.
            </div>
        </div>

    </div>

    <script>
        window.print();
    </script>

</body>
</html>