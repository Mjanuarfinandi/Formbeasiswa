<?php
$conn = new mysqli("localhost", "username", "password", "beasiswa"); // Ganti username dan password

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $nomor_hp = $_POST['nomor_hp'];
    $semester = $_POST['semester'];
    $ipk = 3.4; // Asumsi IPK
    $berkas_path = "uploads/" . basename($_FILES['berkas']['name']);
    $status_ajuan = "Belum di verifikasi";

    if ($ipk >= 3) {
        $beasiswa = $_POST['beasiswa'];
    } else {
        $beasiswa = null;
    }

    if (move_uploaded_file($_FILES['berkas']['tmp_name'], $berkas_path)) {
        $sql = "INSERT INTO pendaftaran (nama, email, nomor_hp, semester, beasiswa, berkas_path, status_ajuan)
                VALUES ('$nama', '$email', '$nomor_hp', $semester, '$beasiswa', '$berkas_path', '$status_ajuan')";

        if ($conn->query($sql) === TRUE) {
            header("Location: hasil.php?status=$status_ajuan");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Error uploading file.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Beasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Formulir Pendaftaran Beasiswa</h2>
    <form action="index.php" method="POST" enctype="multipart/form-data">
        <!-- Form fields here (similar to the previous example) -->
        <!-- ... -->
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="nomor_hp">Nomor HP:</label>
        <input type="tel" id="nomor_hp" name="nomor_hp" pattern="[0-9]+" required>

        <label for="semester">Semester:</label>
        <select id="semester" name="semester" required>
            <?php
            for ($i = 1; $i <= 8; $i++) {
                echo "<option value='$i'>$i</option>";
            }
            ?>
        </select>

        <?php
        $ipk = 3.4; // Asumsi IPK
        if ($ipk > 3) {
            echo "<label for='beasiswa'>Pilihan Beasiswa:</label>";
            echo "<select id='beasiswa' name='beasiswa' required>";
            echo "<option value='beasiswa1'>Beasiswa 1</option>";
            echo "<option value='beasiswa2'>Beasiswa 2</option>";
            echo "</select>";
        }
        ?>

        <label for="berkas">Upload Berkas:</label>
        <input type="file" id="berkas" name="berkas" accept=".pdf, .jpg, .jpeg, .png, .zip" required>

        <button type="submit" name="submit">Daftar Beasiswa</button>
    </form>
</body>
</html>
