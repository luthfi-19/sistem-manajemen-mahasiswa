<?php
session_start();
include '../config/database.php';

if (isset($_POST['btn_simpan'])) {
    // 1. Tangkap Data Teks
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $semester = $_POST['semester'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // 2. LOGIKA UPLOAD FOTO
    $nama_foto_baru = "default.jpg"; // Nama default kalau user tidak upload

    // Cek apakah ada file gambar yang dikirim?
    if (isset($_FILES['foto']['name']) && $_FILES['foto']['name'] != "") {
        
        $nama_file_asli = $_FILES['foto']['name'];
        $tmp_file = $_FILES['foto']['tmp_name'];
        
        // Buat nama unik pakai waktu (time) agar tidak bentrok
        // Contoh: 1708992_profile.jpg
        $nama_foto_baru = time() . "_" . $nama_file_asli;
        
        // Tentukan folder tujuan
        $path_tujuan = "../assets/img/" . $nama_foto_baru;

        // Pindahkan file dari folder sementara ke folder assets/img
        if(!move_uploaded_file($tmp_file, $path_tujuan)) {
            echo "<script>alert('Gagal upload gambar!'); window.location.href='../tambah_data.php';</script>";
            exit();
        }
    }

    // 3. Insert ke Tabel USERS
    $query_user = "INSERT INTO users (username, password, role) VALUES ('$nim', '$password', 'mahasiswa')";
    
    if (mysqli_query($db_connect, $query_user)) {
        
        $user_id = mysqli_insert_id($db_connect);

        // 4. Insert ke Tabel MAHASISWA (Termasuk nama foto)
        $query_mhs = "INSERT INTO mahasiswa (user_id, nim, nama, jurusan, semester, email, foto) 
                      VALUES ('$user_id', '$nim', '$nama', '$jurusan', '$semester', '$email', '$nama_foto_baru')";

        if (mysqli_query($db_connect, $query_mhs)) {
           $_SESSION['notifikasi'] = "Data Mahasiswa Berhasil Ditambahkan!";
            header("Location: ../data_mahasiswa.php"); // Langsung pindah
            exit();
        } else {
            echo "Gagal Insert Mahasiswa: " . mysqli_error($db_connect);
        }

    } else {
        echo "Gagal Insert User: " . mysqli_error($db_connect);
    }
}
?>