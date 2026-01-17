<?php
session_start();
include 'config/database.php';

// Cek Login & Role
if (!isset($_SESSION['status']) || $_SESSION['role'] != 'mahasiswa') {
    header("location:index.php");
    exit();
}

include 'layout/header.php';

// Ambil data mahasiswa yang sedang login
$id_user = $_SESSION['user_id'];
$query = mysqli_query($db_connect, "SELECT * FROM mahasiswa WHERE user_id = '$id_user'");
$data = mysqli_fetch_assoc($query);
?>

<div class="content-body">
    <h2>Edit Profil Saya</h2>
    
    <div style="background: var(--bg-card); padding: 30px; border-radius: 10px; max-width: 600px; margin-top: 20px;">
        <form action="php_logic/update_profil.php" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="id_mhs" value="<?= $data['id']; ?>">

            <div class="form-group" style="margin-bottom: 15px;">
                <label>NIM (Tidak bisa diubah)</label>
                <input type="text" value="<?= $data['nim']; ?>" readonly 
                       style="width: 100%; padding: 10px; background: #222; border: 1px solid #444; color: #888;">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="<?= $data['nama']; ?>" required
                       style="width: 100%; padding: 10px; background: #333; border: 1px solid #444; color: white;">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label>Ganti Foto (Kosongkan jika tidak ingin mengganti)</label>
                <input type="file" name="foto" accept=".jpg, .jpeg, .png" 
                       style="width: 100%; padding: 10px; background: #333; border: 1px solid #444; color: white;">
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label>Ganti Password (Kosongkan jika tidak ingin mengganti)</label>
                <input type="password" name="password" placeholder="Password Baru..." 
                       style="width: 100%; padding: 10px; background: #333; border: 1px solid #444; color: white;">
            </div>

            <button type="submit" name="btn_update" 
                    style="background: var(--accent-color); color: white; padding: 10px 20px; border: none; cursor: pointer; border-radius: 5px;">
                Simpan Perubahan
            </button>
            <a href="profile.php" style="color: #aaa; margin-left: 15px; text-decoration: none;">Batal</a>

        </form>
    </div>
</div>

<?php include 'layout/footer.php'; ?>