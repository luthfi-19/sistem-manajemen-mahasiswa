<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] != 'admin') {
    header("location:index.php");
    exit();
}

include 'layout/header.php';
include 'config/database.php';

// Ambil ID dari URL (edit_data.php?id=1)
$id_mahasiswa = $_GET['id'];

// Ambil data lama dari database
$query = "SELECT * FROM mahasiswa WHERE id = '$id_mahasiswa'";
$result = mysqli_query($db_connect, $query);
$data = mysqli_fetch_assoc($result);

// Jika data tidak ditemukan
if(mysqli_num_rows($result) < 1) {
    echo "Data tidak ditemukan!";
    exit();
}
?>

<div class="content-body">
    <h2>Edit Data Mahasiswa</h2>
    
    <div class="form-container" style="background-color: var(--bg-card); padding: 30px; border-radius: 10px; margin-top: 20px; max-width: 600px;">
        <form action="php_logic/update.php" method="POST">
            
            <input type="hidden" name="id" value="<?= $data['id']; ?>">

            <div class="form-group">
                <label>NIM</label>
                <input type="text" name="nim" value="<?= $data['nim']; ?>" readonly style="background: #333; color: #888;">
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="<?= $data['nama']; ?>" required>
            </div>

            <div class="form-group">
                <label>Jurusan</label>
                <select name="jurusan" required style="width: 100%; padding: 12px; background: var(--bg-body); border: 1px solid #444; color: white; border-radius: 6px;">
                    <option value="<?= $data['jurusan']; ?>" selected><?= $data['jurusan']; ?> (Saat Ini)</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Manajemen Informatika">Manajemen Informatika</option>
                </select>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?= $data['email']; ?>" required>
            </div>

            <div class="form-actions" style="margin-top: 20px;">
                <button type="submit" name="btn_update" class="btn-primary">Update Data</button>
                <a href="data_mahasiswa.php" style="color: #aaa; margin-left: 15px;">Batal</a>
            </div>

        </form>
    </div>
</div>

<?php include 'layout/footer.php'; ?>