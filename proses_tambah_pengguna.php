<?php
// proses_tambah_pengguna.php

include 'koneksi.php'; // File koneksi database

$nama = $_POST['nama'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password
$email = $_POST['email'];
$role = $_POST['role'];

// Query untuk menambahkan pengguna baru
$sql = "INSERT INTO users (nama, username, password, email, role) VALUES ('$nama', '$username', '$password', '$email', '$role')";

if (mysqli_query($conn, $sql)) {
    echo "Pengguna baru berhasil ditambahkan!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
