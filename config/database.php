<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_kampus";

$db_connect = mysqli_connect($host, $user, $pass, $db);

if (!$db_connect) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}
?>