<?php
session_start();
include '../config/database.php';

if (isset($_POST['btn_simpan'])) {
    // 1. Tangkap Data
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    
    $semester = $_POST['semester']; // <--- BARU: Tangkap Semester
    
    $email = $_POST['email'];
    $password = $_POST['password']; 

    // 2. Insert ke Tabel USERS (Tetap Sama)
    $query_user = "INSERT INTO users (username, password, role) VALUES ('$nim', '$password', 'mahasiswa')";
    
    if (mysqli_query($db_connect, $query_user)) {
        
        $user_id = mysqli_insert_id($db_connect);

        // 3. Insert ke Tabel MAHASISWA (DITAMBAH SEMESTER)
        // Perhatikan urutan kolom dan variabelnya!
        $query_mhs = "INSERT INTO mahasiswa (user_id, nim, nama, jurusan, semester, email) 
                      VALUES ('$user_id', '$nim', '$nama', '$jurusan', '$semester', '$email')";

        if (mysqli_query($db_connect, $query_mhs)) {
            echo "<script>
                    alert('Data Berhasil Ditambahkan!');
                    document.location.href = '../data_mahasiswa.php';
                  </script>";
        } else {
            echo "Gagal Insert Mahasiswa: " . mysqli_error($db_connect);
        }

    } else {
        echo "Gagal Insert User: " . mysqli_error($db_connect);
    }
}
?>