<?php
// Menyertakan file koneksi
$conn = include('koneksi.php');

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM books WHERE id='$id'";

if ($conn->query($sql) === TRUE) {
    echo "Buku berhasil dihapus";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
