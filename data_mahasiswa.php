<?php
session_start();
// Keamanan: Hanya Admin yang boleh akses
if (!isset($_SESSION['status']) || $_SESSION['role'] != 'admin') {
    header("location:index.php");
    exit();
}

include 'layout/header.php';
include 'config/database.php';

if (isset($_SESSION['notifikasi'])) {
    // Kita taruh pesan di elemen tersembunyi biar dibaca JS
    echo '<div class="flash-data" data-pesan="'.$_SESSION['notifikasi'].'"></div>';
    
    // Hapus session biar pesannya gak muncul terus saat di-refresh
    unset($_SESSION['notifikasi']); 
}
?>

<div class="content-body">
    <div class="header-content" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Data Mahasiswa</h2>
        <a href="tambah_data.php" class="btn-primary"> + Tambah Data</a>
    </div>

    <div class="table-container">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Lengkap</th>
                    <th>Jurusan</th>
                    <th>Email</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                // Join tabel mahasiswa dengan users agar kita bisa dapat data lengkap jika perlu
                $query = "SELECT * FROM mahasiswa ORDER BY id DESC";
                $result = mysqli_query($db_connect, $query);

                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $row['nim']; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <td><?= $row['jurusan']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td>
                        <a href="edit_data.php?id=<?= $row['id']; ?>" class="btn-small btn-edit">Edit</a>
                        <a href="php_logic/delete.php?id=<?= $row['id']; ?>" class="btn-small btn-delete" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
                    </td>
                </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='6' align='center'>Data masih kosong</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'layout/footer.php'; ?>