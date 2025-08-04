<?php
// Menyertakan file koneksi
$conn = include('koneksi.php');

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mendapatkan data dari form
$general_number = $_POST['general_number'];
$title = $_POST['title'];
$material_type = $_POST['material_type'];
$book_number = $_POST['book_number'];
$author = $_POST['author'];
$jilid = $_POST['jilid'];
$edition = $_POST['edition'];
$cetakan = $_POST['cetakan'];
$lssn = $_POST['lssn'];
$regulation_number = $_POST['regulation_number'];
$regulation_type = $_POST['regulation_type'];
$regulation_year = $_POST['regulation_year'];
$regulation_place = $_POST['regulation_place'];
$magazine_number = $_POST['magazine_number'];
$volume_number = $_POST['volume_number'];
$publication_period = $_POST['publication_period'];
$publication_place = $_POST['publication_place'];
$publisher = $_POST['publisher'];
$publication_year = $_POST['publication_year'];
$classification_number = $_POST['classification_number'];
$source = $_POST['source'];
$description = $_POST['description'];
$lemari = $_POST['lemari'];
$rak = $_POST['rak'];

// Menangani upload file gambar
$cover_image = $_FILES['cover_image']['name'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($cover_image);

// Memindahkan file gambar
if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $target_file)) {
    // Menyiapkan query SQL
    $sql = "INSERT INTO books (general_number, title, material_type, book_number, author, jilid, edition, cetakan, lssn, regulation_number, regulation_type, regulation_year, regulation_place, magazine_number, volume_number, publication_period, publication_place, publisher, publication_year, classification_number, source, description, cover_image, lemari, rak) 
            VALUES ('$general_number', '$title', '$material_type', '$book_number', '$author', '$jilid', '$edition', '$cetakan', '$lssn', '$regulation_number', '$regulation_type', '$regulation_year', '$regulation_place', '$magazine_number', '$volume_number', '$publication_period', '$publication_place', '$publisher', '$publication_year', '$classification_number', '$source', '$description', '$cover_image', '$lemari', '$rak')";

    // Menjalankan query
    if ($conn->query($sql) === TRUE) {
        echo "Buku berhasil ditambahkan";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Maaf, terjadi kesalahan saat meng-upload file.";
}

$conn->close();
?>
