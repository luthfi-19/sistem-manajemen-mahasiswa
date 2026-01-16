<?php
session_start();
include 'config/database.php';

// 1. CEK LOGIN
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:index.php?pesan=belum_login");
    exit();
}

// 2. LOGIC KHUSUS MAHASISWA: AMBIL SEMESTER
$semester_tampil = "-";
if ($_SESSION['role'] == 'mahasiswa') {
    $id_user_login = $_SESSION['user_id'];
    $cek_data = mysqli_query($db_connect, "SELECT semester FROM mahasiswa WHERE user_id = '$id_user_login'");
    $data_mhs = mysqli_fetch_assoc($cek_data);

    if($data_mhs){
        $semester_tampil = $data_mhs['semester'];
    }
}

// 3. PANGGIL HEADER
include 'layout/header.php';
?>

<div class="content-body">
    <h2 style="margin-bottom: 10px;">Selamat Datang di Dashboard</h2>
    <p style="color: #aaa; margin-bottom: 30px;">Anda login sebagai <strong><?= $_SESSION['role']; ?></strong></p>

    <div class="dashboard-cards">
        
        <?php if($_SESSION['role'] == 'admin'): ?>
            <div class="card">
                <h3>Total Mahasiswa</h3>
                <div class="number">
                    <?php
                        $hitung = mysqli_query($db_connect, "SELECT * FROM mahasiswa");
                        echo mysqli_num_rows($hitung);
                    ?>
                </div>
            </div>
            <div class="card">
                <h3>Data Baru</h3>
                <div class="number">
                     <span style="font-size: 1rem; color: #aaa;">Selalu Update</span>
                </div>
            </div>
        <?php endif; ?>

        <?php if($_SESSION['role'] == 'mahasiswa'): ?>
            <div class="card">
                <h3>Status Akademik</h3>
                <div class="number" style="color: var(--success-color);">Aktif</div>
            </div>
            <div class="card">
                <h3>Semester</h3>
                <div class="number"><?= $semester_tampil; ?></div>
            </div>
        <?php endif; ?>

    </div>
    <?php if($_SESSION['role'] == 'admin'): ?>
    <div style="display: flex; gap: 20px; margin-top: 30px;">
        
        <div class="card" style="flex: 2;">
            <h3 style="margin-bottom: 15px;">Mahasiswa Terbaru</h3>
            <table class="custom-table" style="font-size: 0.9rem;">
                <thead>
                    <tr>
                        <th>NIM</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query_mini = mysqli_query($db_connect, "SELECT * FROM mahasiswa ORDER BY id DESC LIMIT 3");
                    while($row_mini = mysqli_fetch_assoc($query_mini)){
                    ?>
                    <tr>
                        <td><?= $row_mini['nim']; ?></td>
                        <td><?= $row_mini['nama']; ?></td>
                        <td><?= $row_mini['jurusan']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div style="margin-top: 15px; text-align: right;">
                <a href="data_mahasiswa.php" style="color: var(--accent-color); font-size: 0.8rem;">Lihat Semua Data &rarr;</a>
            </div>
        </div>

        <div class="card" style="flex: 1;">
            <h3 style="margin-bottom: 20px;">Populasi Jurusan</h3>
            <div style="margin-bottom: 15px;">
                <div style="display: flex; justify-content: space-between; font-size: 0.8rem; margin-bottom: 5px;">
                    <span>Teknik Informatika</span>
                    <span>60%</span>
                </div>
                <div style="width: 100%; background: #333; height: 8px; border-radius: 4px;">
                    <div style="width: 60%; background: var(--accent-color); height: 100%; border-radius: 4px;"></div>
                </div>
            </div>
            <div>
                <div style="display: flex; justify-content: space-between; font-size: 0.8rem; margin-bottom: 5px;">
                    <span>Sistem Informasi</span>
                    <span>0%</span>
                </div>
                <div style="width: 100%; background: #333; height: 8px; border-radius: 4px;">
                    <div style="width: 0%; background: var(--success-color); height: 100%; border-radius: 4px;"></div>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>


    <?php if($_SESSION['role'] == 'mahasiswa'): ?>
    <div style="margin-top: 30px;">
        <div class="card">
            <h3 style="border-bottom: 1px solid #444; padding-bottom: 10px; margin-bottom: 20px;">📢 Pengumuman Akademik</h3>
            
            <div style="display: flex; gap: 20px; align-items: flex-start; margin-bottom: 20px;">
                <div style="background: var(--accent-color); color: white; padding: 10px; border-radius: 8px; text-align: center; min-width: 60px;">
                    <div style="font-size: 0.8rem;">JAN</div>
                    <div style="font-size: 1.5rem; font-weight: bold;">20</div>
                </div>
                <div>
                    <h4 style="color: white; margin-bottom: 5px;">Pelaksanaan UAS Semester Ganjil</h4>
                    <p style="color: #aaa; font-size: 0.9rem;">Ujian Akhir Semester dilaksanakan tanggal 20-30 Januari 2026.</p>
                </div>
            </div>

            <div style="display: flex; gap: 20px; align-items: flex-start;">
                <div style="background: #333; color: white; padding: 10px; border-radius: 8px; text-align: center; min-width: 60px;">
                    <div style="font-size: 0.8rem;">FEB</div>
                    <div style="font-size: 1.5rem; font-weight: bold;">05</div>
                </div>
                <div>
                    <h4 style="color: white; margin-bottom: 5px;">Pengisian KRS Semester Genap</h4>
                    <p style="color: #aaa; font-size: 0.9rem;">Wajib melakukan perwalian sebelum tanggal 5 Februari 2026.</p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

</div>

<?php include 'layout/footer.php'; ?>