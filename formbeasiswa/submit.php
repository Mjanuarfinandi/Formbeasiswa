<?php
if (isset($_POST['submit'])) {
    // Simpan data ke database atau lakukan tindakan lainnya
    // ...

    // Set status ajuan
    $status_ajuan = "Belum di verifikasi";

    // Redirect ke halaman hasil
    header("Location: hasil.php?status=$status_ajuan");
    exit();
}
?>
