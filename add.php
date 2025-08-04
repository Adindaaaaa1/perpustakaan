<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Buku</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="add.css">
    <link rel="stylesheet" href="kembali.css">
</head>
<body>
    <h2>Tambah Buku</h2>
    <form action="add.php" method="post" enctype="multipart/form-data">
        ID: <input type="text" name="id"><br>
        Nomor Induk: <input type="text" name="general_number"><br>
        Judul: <input type="text" name="title"><br>
        Koleksi: <input type="text" name="koleksi"><br>
        Jenis Bahan Pustaka: <input type="text" name="material_type"><br>
        Nomor Urut Buku: <input type="text" name="book_number"><br>
        Pengarang: <input type="text" name="author"><br>
        Jilid: <input type="text" name="jilid"><br>
        Edisi: <input type="text" name="edition"><br>
        Cetakan: <input type="text" name="cetakan"><br>
        ISBN: <input type="text" name="lssn"><br>
        Nomor Peraturan: <input type="text" name="regulation_number"><br>
        Jenis Peraturan: <input type="text" name="regulation_type"><br>
        Nomor & Tahun Peraturan: <input type="text" name="regulation_year"><br>
        Tempat & Nomor: <input type="text" name="regulation_place"><br>
        Nomor Majalah: <input type="text" name="magazine_number"><br>
        Volume: <input type="text" name="volume_number"><br>
        Periode Terbit: <input type="text" name="publication_period"><br>
        Tempat Terbit: <input type="text" name="publication_place"><br>
        Penerbit: <input type="text" name="publisher"><br>
        Tahun Terbit: <input type="text" name="publication_year"><br>
        Nomor Klasifikasi: <input type="text" name="classification_number"><br>
        Berasal Dari: <input type="text" name="source"><br>
        Deskripsi: <textarea name="description"></textarea><br>
        Lemari: <input type="text" name="lemari"><br>
        Rak: <input type="text" name="rak"><br>
        Sampul Buku: <input type="file" name="cover_image"><br>
        <input type="submit" value="Tambah Buku">
    </form>
    <div class="back-container">
    <button onclick="window.location.href='index.php'">Kembali</button>
    </div>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Menyertakan file koneksi
        $conn = include('koneksi.php');

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        $id = $_POST['id'];
        $general_number = $_POST['general_number'];
        $title = $_POST['title'];
        $koleksi = $_POST['koleksi'];
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
        $lemari =$_POST['lemari'];
        $rak =$_POST['rak'];
        $cover_image = $_FILES['cover_image']['name'];

        // Handle file upload
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($cover_image);
        move_uploaded_file($_FILES["cover_image"]["tmp_name"], $target_file);

        // Cek apakah ID sudah ada
        $sql = "SELECT * FROM books WHERE id = '$id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Jika ID sudah ada, tampilkan pesan kesalahan
            echo "Error: ID sudah ada. Silakan gunakan ID yang berbeda.";
        } else {
            // Tambahkan buku baru dengan ID yang ditentukan
            $sql = "INSERT INTO books (id, general_number, title, koleksi, material_type, book_number, author, jilid, edition, cetakan, lssn, regulation_number, regulation_type, regulation_year, regulation_place, magazine_number, volume_number, publication_period, publication_place, publisher, publication_year, classification_number, source, description, cover_image, lemari, rak) 
                    VALUES ('$id', '$general_number', '$title', '$koleksi', '$material_type', '$book_number', '$author', '$jilid', '$edition', '$cetakan', '$lssn', '$regulation_number', '$regulation_type', '$regulation_year', '$regulation_place', '$magazine_number', '$volume_number', '$publication_period', '$publication_place', '$publisher', '$publication_year', '$classification_number', '$source', '$description', '$cover_image', '$lemari', '$rak')";

            if ($conn->query($sql) === TRUE) {
                echo "Buku baru berhasil ditambahkan";
                header("Location: index.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }

        $conn->close();
    }
    ?>
</body>
</html>
