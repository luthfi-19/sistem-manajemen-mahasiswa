<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Data Mahasiswa</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <link rel="stylesheet" href="assets/css/profile.css">
</head>
<body>

<div class="app-container">
    
    <aside class="sidebar">
        <div class="sidebar-header">
            SIAKAD KAMPUS
        </div>
        
        <nav class="sidebar-menu">
            <ul>
                <li>
                    <a href="dashboard.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'dashboard.php') ? 'active' : ''; ?>">Dashboard</a>
                </li>

                <?php if($_SESSION['role'] == 'admin'): ?>
                    <li>
                        <a href="data_mahasiswa.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'data_mahasiswa.php') ? 'active' : ''; ?>">Data Mahasiswa</a>
                    </li>
                <?php endif; ?>

                <?php if($_SESSION['role'] == 'mahasiswa'): ?>
                    <li>
                        <a href="profile.php" class="<?= (basename($_SERVER['PHP_SELF']) == 'profile.php') ? 'active' : ''; ?>">Biodata Saya</a>
                    </li>
                <?php endif; ?>

                <li>
                    <a href="logout.php" style="color: var(--danger-color);">Logout</a>
                </li>
            </ul>
        </nav>
    </aside>

    <main class="main-content">
        
        <header class="navbar">
            <div class="page-title">
                <h3>Sistem Manajemen Data</h3>
            </div>
            <div class="user-info">
            Halo, <b><?= $_SESSION['nama_lengkap']; ?></b>
            <span class="user-role"><?= $_SESSION['role']; ?></span>
            </div>
        </header>