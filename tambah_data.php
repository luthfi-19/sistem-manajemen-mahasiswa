<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['role'] != 'admin') {
    header("location:index.php");
    exit();
}
include 'layout/header.php';
?>

<div class="content-body">
    <h2>Tambah Data Mahasiswa</h2>
    
    <div class="form-container">
        <form action="php_logic/create.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>NIM (Nomor Induk Mahasiswa)</label>
                <input type="text" name="nim" required placeholder="Contoh: 10123005">
            </div>

            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" required placeholder="Masukkan Nama Lengkap">
            </div>

            <div class="form-group">
                <label>Jurusan</label>
                <select name="jurusan" required>
                    <option value="">-- Pilih Jurusan --</option>
                    <option value="Teknik Informatika">Teknik Informatika</option>
                    <option value="Sistem Informasi">Sistem Informasi</option>
                    <option value="Manajemen Informatika">Manajemen Informatika</option>
                </select>
            </div>

            <div class="form-group">
                <label>Semester</label>
                <input type="number" name="semester" min="1" max="14" value="1" required placeholder="1-14">
            </div>

            <div class="form-group">
                <label>Upload Foto Profil</label>
                <input type="file" name="foto" accept=".jpg, .jpeg, .png" style="width: 100%; padding: 10px; background: #333; border: 1px solid #444; border-radius: 6px; color: #fff;">
                <small style="color: #aaa; font-style: italic;">*Format: JPG/PNG, Maksimal 2MB</small>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="email@kampus.id">
            </div>

            <div class="form-group">
                <label>Password Akun (Default)</label>
                <input type="text" name="password" value="12345" readonly style="background: #333; color: #888;">
                <small style="color: #aaa;">*Password default user baru adalah 12345</small>
            </div>

            <div class="form-actions">
                <button type="submit" name="btn_simpan" class="btn-primary">Simpan Data</button>
                <a href="data_mahasiswa.php" style="color: #aaa; margin-left: 15px;">Batal</a>
            </div>

        </form>
    </div>
</div>

<style>
.form-container {
    background-color: var(--bg-card);
    padding: 30px;
    border-radius: var(--border-radius);
    margin-top: 20px;
    max-width: 600px;
}
select, input {
    width: 100%; padding: 12px; background: var(--bg-body); 
    border: 1px solid #444; color: white; border-radius: 6px;
    outline: none;
}
input:focus, select:focus { border-color: var(--accent-color); }
</style>

<?php include 'layout/footer.php'; ?>