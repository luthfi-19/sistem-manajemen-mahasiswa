<?php
session_start();
include '../config/database.php';

// Pastikan tombol diklik
if (isset($_POST['btn_update'])) {
    
    // 1. TANGKAP ID
    $id = $_POST['id'];

    // 2. TANGKAP DATA TEKS + PENGAMAN (mysqli_real_escape_string)
    // Fungsi ini membungkus tanda kutip (') supaya tidak dianggap perintah SQL
    $nim      = mysqli_real_escape_string($db_connect, $_POST['nim']);
    $nama     = mysqli_real_escape_string($db_connect, $_POST['nama']);
    $jurusan  = mysqli_real_escape_string($db_connect, $_POST['jurusan']);
    $semester = mysqli_real_escape_string($db_connect, $_POST['semester']);
    $email    = mysqli_real_escape_string($db_connect, $_POST['email']);

    // 3. LOGIKA UPDATE FOTO
    // Cek dulu, apakah admin upload foto baru?
    if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != "") {
        
        // --- JIKA GANTI FOTO ---
        $nama_file_baru = time() . "_" . $_FILES['foto']['name'];
        $tmp_file = $_FILES['foto']['tmp_name'];
        
        // Upload ke folder
        move_uploaded_file($tmp_file, "../assets/img/" . $nama_file_baru);

        // Query Update LENGKAP (Termasuk Foto)
        $query = "UPDATE mahasiswa SET 
                    nim = '$nim',
                    nama = '$nama',
                    jurusan = '$jurusan',
                    semester = '$semester',
                    email = '$email',
                    foto = '$nama_file_baru'
                  WHERE id = '$id'";
                  
    } else {
        
        // --- JIKA TIDAK GANTI FOTO ---
        // Query Update TANPA mengubah kolom foto
        $query = "UPDATE mahasiswa SET 
                    nim = '$nim',
                    nama = '$nama',
                    jurusan = '$jurusan',
                    semester = '$semester',
                    email = '$email'
                  WHERE id = '$id'";
    }

    // 4. EKSEKUSI QUERY
    if (mysqli_query($db_connect, $query)) {
        
        // Jika berhasil, update session notifikasi untuk SweetAlert (Opsional)
        $_SESSION['notifikasi'] = "Data Mahasiswa Berhasil Diupdate!";
        
        // Redirect
        echo "<script>
                document.location.href = '../data_mahasiswa.php';
              </script>";
              
    } else {
        // Tampilkan pesan error jika query gagal
        echo "Gagal Update: " . mysqli_error($db_connect);
    }
}
?>