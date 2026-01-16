<?php
session_start();
include '../config/database.php';

if (isset($_GET['id'])) {
    $id_mahasiswa = $_GET['id'];

    // 1. Cari dulu user_id milik mahasiswa ini
    $cari_user = mysqli_query($db_connect, "SELECT user_id FROM mahasiswa WHERE id = '$id_mahasiswa'");
    $data = mysqli_fetch_assoc($cari_user);
    $user_id = $data['user_id'];

    // 2. Hapus data di tabel USERS
    // (Karena ON DELETE CASCADE, data di tabel mahasiswa akan ikut hilang otomatis)
    $query = "DELETE FROM users WHERE id = '$user_id'";

    if (mysqli_query($db_connect, $query)) {
        echo "<script>
                alert('Data Berhasil Dihapus!');
                document.location.href = '../data_mahasiswa.php';
              </script>";
    } else {
        echo "Gagal Hapus: " . mysqli_error($db_connect);
    }
}
?>