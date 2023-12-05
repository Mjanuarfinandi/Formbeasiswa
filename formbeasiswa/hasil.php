<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pendaftaran Beasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    if (isset($_GET['status'])) {
        echo "<h2>Hasil Pendaftaran Beasiswa</h2>";
        echo "<p>Status Ajuan: " . $_GET['status'] . "</p>";

        // Retrieve and display other form data from the database
        $conn = new mysqli("localhost", "username", "password", "beasiswa"); // Ganti username dan password

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM pendaftaran ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<p>Nama: " . $row['nama'] . "</p>";
            echo "<p>Email: " . $row['email'] . "</p>";
            echo "<p>Nomor HP: " . $row['nomor_hp'] . "</p>";
            echo "<p>Semester: " . $row['semester'] . "</p>";
            echo "<p>Beasiswa: " . $row['beasiswa'] . "</p>";
            echo "<p>Status Ajuan: " . $row['status_ajuan'] . "</p>";
            // Display other form data as needed
        } else {
            echo "No records found.";
        }

        $conn->close();
    } else {
        echo "<p>No status provided.</p>";
    }
    ?>
</body>
</html>
