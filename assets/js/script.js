// assets/js/script.js

// 1. KONFIRMASI LOGOUT
const tombolLogout = document.querySelector(".btn-logout");

if (tombolLogout) {
  tombolLogout.addEventListener("click", function (e) {
    e.preventDefault(); // Cegah link langsung jalan
    const href = this.getAttribute("href"); // Ambil tujuan link (logout.php)

    Swal.fire({
      title: "Yakin mau keluar?",
      text: "Anda harus login lagi nanti untuk masuk.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Logout!",
      cancelButtonText: "Batal",
      background: "#1E1E1E", // Warna gelap sesuai tema
      color: "#fff", // Teks putih
    }).then((result) => {
      if (result.isConfirmed) {
        document.location.href = href; // Kalau Ya, baru pindah halaman
      }
    });
  });
}

// 2. PESAN SUKSES (FLASH MESSAGE)
const flashData = document.querySelector(".flash-data");

if (flashData) {
  const pesan = flashData.getAttribute("data-pesan");
  Swal.fire({
    icon: "success",
    title: "Berhasil!",
    text: pesan,
    background: "#1E1E1E",
    color: "#fff",
    showConfirmButton: false,
    timer: 2000, // Otomatis hilang dalam 2 detik
  });
}