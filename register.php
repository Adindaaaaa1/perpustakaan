<?php
// Informasi database
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "perpus";

// Buat koneksi
$conn = new mysqli($servername, $username_db, $password_db, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil input dari form
$input_username = $_POST['username'];
$input_password = $_POST['password'];
$input_role = $_POST['role']; // Nilai dari dropdown atau input form

// Hash password
$hashed_password = password_hash($input_password, PASSWORD_DEFAULT);

// Prepare and bind SQL statement
$sql = "INSERT INTO users (username, password, role) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}
$stmt->bind_param("ssi", $input_username, $hashed_password, $input_role);

// Execute statement
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

echo "User registered successfully.";

$stmt->close();
$conn->close();
?>
