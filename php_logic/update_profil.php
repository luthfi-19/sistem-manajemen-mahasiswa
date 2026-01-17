<?php
session_start();
include '../config/database.php';

if (isset($_POST['btn_update'])) {
    $id_mhs = $_POST['id_mhs'];
    $nama = $_POST['nama'];
    $password_baru = $_POST['password'];
    
    // 1. UPDATE DATA MAHASISWA (Nama)
    $query_update_mhs = "UPDATE mahasiswa SET nama = '$nama' WHERE id = '$id_mhs'";
    mysqli_query($db_connect, $query_update_mhs);

    // 2. CEK UPDATE FOTO
    if(isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != "") {
        $foto_name = time() . "_" . $_FILES['foto']['name'];
        $tmp_name = $_FILES['foto']['tmp_name'];
        
        // Upload file baru
        move_uploaded_file($tmp_name, "../assets/img/" . $foto_name);
        
        // Update database foto
        mysqli_query($db_connect, "UPDATE mahasiswa SET foto = '$foto_name' WHERE id = '$id_mhs'");
    }

    // 3. CEK UPDATE PASSWORD
    // Kita perlu tahu user_id dari tabel mahasiswa dulu
    $cek_user = mysqli_query($db_connect, "SELECT user_id FROM mahasiswa WHERE id = '$id_mhs'");
    $data_user = mysqli_fetch_assoc($cek_user);
    $user_id_asli = $data_user['user_id'];

    if($password_baru != "") {
        // Kalau password diisi, update tabel users
        // (Di sini kita pakai plain text sesuai request awal, bisa diganti md5)
        $query_pass = "UPDATE users SET password = '$password_baru' WHERE id = '$user_id_asli'";
        mysqli_query($db_connect, $query_pass);
    }

    // 4. UPDATE SESSION (Biar nama di pojok kanan langsung berubah)
    $_SESSION['nama_lengkap'] = $nama;
    $_SESSION['notifikasi'] = "Profil Berhasil Diupdate!"; // SweetAlert

    header("location:../profile.php");
}
?>