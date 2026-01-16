<?php
session_start();
include '../config/database.php';

if (isset($_POST['btn_update'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $email = $_POST['email'];

    // Query Update
    $query = "UPDATE mahasiswa SET 
              nama = '$nama',
              jurusan = '$jurusan',
              email = '$email'
              WHERE id = '$id'";

    if (mysqli_query($db_connect, $query)) {
        echo "<script>
                alert('Data Berhasil Diupdate!');
                document.location.href = '../data_mahasiswa.php';
              </script>";
    } else {
        echo "Gagal Update: " . mysqli_error($db_connect);
    }
}
?>