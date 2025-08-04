<?php
// Menyertakan file koneksi
$conn = include('koneksi.php');

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id_old = isset($_POST['id_old']) ? $_POST['id_old'] : null; // ID yang lama
$id_new = isset($_POST['id']) ? $_POST['id'] : null; // ID yang baru
$general_number = isset($_POST['general_number']) ? $_POST['general_number'] : '';
$title = isset($_POST['title']) ? $_POST['title'] : '';
$koleksi = isset($_POST['koleksi']) ? $_POST['koleksi'] : '';
$material_type = isset($_POST['material_type']) ? $_POST['material_type'] : '';
$book_number = isset($_POST['book_number']) ? $_POST['book_number'] : '';
$author = isset($_POST['author']) ? $_POST['author'] : '';
$edition = isset($_POST['edition']) ? $_POST['edition'] : '';
$isbn = isset($_POST['lssn']) ? $_POST['lssn'] : '';
$regulation_number = isset($_POST['regulation_number']) ? $_POST['regulation_number'] : '';
$regulation_type = isset($_POST['regulation_type']) ? $_POST['regulation_type'] : '';
$regulation_year = isset($_POST['regulation_year']) ? $_POST['regulation_year'] : '';
$regulation_place = isset($_POST['regulation_place']) ? $_POST['regulation_place'] : '';
$magazine_number = isset($_POST['magazine_number']) ? $_POST['magazine_number'] : '';
$volume_number = isset($_POST['volume_number']) ? $_POST['volume_number'] : '';
$publication_period = isset($_POST['publication_period']) ? $_POST['publication_period'] : '';
$publication_place = isset($_POST['publication_place']) ? $_POST['publication_place'] : '';
$publisher = isset($_POST['publisher']) ? $_POST['publisher'] : '';
$publication_year = isset($_POST['publication_year']) ? $_POST['publication_year'] : '';
$classification_number = isset($_POST['classification_number']) ? $_POST['classification_number'] : '';
$source = isset($_POST['source']) ? $_POST['source'] : '';
$description = isset($_POST['description']) ? $_POST['description'] : '';

$cover_image = $_FILES['cover_image']['name'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($cover_image);

// Cek apakah ID baru sudah ada di database
$sql = "SELECT * FROM books WHERE id = '$id_new'";
$result = $conn->query($sql);

if ($result->num_rows > 0 && $id_old != $id_new) {
    // Jika ID baru sudah ada, tampilkan pesan kesalahan
    echo "Error: ID baru sudah ada. Silakan gunakan ID yang berbeda.";
} else {
    if ($cover_image) {
        $sql = "SELECT cover_image FROM books WHERE id='$id_old'";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $old_image = $row['cover_image'];
            if ($old_image && file_exists("uploads/" . $old_image)) {
                unlink("uploads/" . $old_image);
            }
        }

        if (move_uploaded_file($_FILES['cover_image']['tmp_name'], $target_file)) {
            $sql = "UPDATE books SET
                id='$id_new',
                general_number='$general_number',
                title='$title',
                koleksi='$koleksi',
                material_type='$material_type',
                book_number='$book_number',
                author='$author',
                edition='$edition',
                lssn='$isbn',
                regulation_number='$regulation_number',
                regulation_type='$regulation_type',
                regulation_year='$regulation_year',
                regulation_place='$regulation_place',
                magazine_number='$magazine_number',
                volume_number='$volume_number',
                publication_period='$publication_period',
                publication_place='$publication_place',
                publisher='$publisher',
                publication_year='$publication_year',
                classification_number='$classification_number',
                source='$source',
                description='$description',
                cover_image='$cover_image'
                WHERE id='$id_old'";
        }
    } else {
        $sql = "UPDATE books SET
            id='$id_new',
            general_number='$general_number',
            title='$title',
            koleksi='$koleksi',
            material_type='$material_type',
            book_number='$book_number',
            author='$author',
            edition='$edition',
            lssn='$isbn',
            regulation_number='$regulation_number',
            regulation_type='$regulation_type',
            regulation_year='$regulation_year',
            regulation_place='$regulation_place',
            magazine_number='$magazine_number',
            volume_number='$volume_number',
            publication_period='$publication_period',
            publication_place='$publication_place',
            publisher='$publisher',
            publication_year='$publication_year',
            classification_number='$classification_number',
            source='$source',
            description='$description'
            WHERE id='$id_old'";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Buku berhasil diperbarui";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
