<?php
session_start();

// 1. CEK KEAMANAN: Harus Login & Harus Role Mahasiswa
if (!isset($_SESSION['status']) || $_SESSION['role'] != 'mahasiswa') {
    // Jika admin iseng coba masuk sini, tendang ke dashboard admin
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
        header("location:dashboard.php");
    } else {
        header("location:index.php");
    }
    exit();
}

include 'layout/header.php';
include 'config/database.php';

// 2. AMBIL DATA USER YANG SEDANG LOGIN
$id_user_login = $_SESSION['user_id'];

// 3. QUERY KE DATABASE
// "Tolong ambilkan data mahasiswa yang user_id nya sama dengan user yang sedang login ini"
$query = "SELECT * FROM mahasiswa WHERE user_id = '$id_user_login'";
$result = mysqli_query($db_connect, $query);
$data = mysqli_fetch_assoc($result);
?>

<div class="content-body">
    <h2 style="margin-bottom: 30px; border-bottom: 1px solid #333; padding-bottom: 10px;">Biodata Saya</h2>

    <div class="profile-card">
        <div class="profile-img-container">
            <img src="https://ui-avatars.com/api/?name=<?= $data['nama']; ?>&background=random&size=200" alt="Foto Profil" class="profile-img">
        </div>

        <div class="profile-info">
            <h3><?= $data['nama']; ?></h3>
            <span class="jurusan"><?= $data['jurusan']; ?></span>

            <div class="data-row">
                <span class="data-label">NIM</span>
                <span class="data-value">: <?= $data['nim']; ?></span>
            </div>
            
            <div class="data-row">
                <span class="data-label">Email</span>
                <span class="data-value">: <?= $data['email']; ?></span>
            </div>

            <div class="data-row">
                <span class="data-label">Status</span>
                <span class="data-value" style="color: var(--success-color);">: Mahasiswa Aktif</span>
            </div>
        </div>
    </div>
</div>

<?php include 'layout/footer.php'; ?>