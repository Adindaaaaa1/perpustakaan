<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Buku</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="edit.css">
    <link rel="stylesheet" href="kembali.css">
</head>
<body>
    <h2>Edit Buku</h2>
    <?php
    // Menyertakan file koneksi
    $conn = include('koneksi.php');
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE id='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    ?>
    <form method="post" action="update.php" enctype="multipart/form-data">
        <input type="hidden" name="id_old" value="<?php echo $id; ?>">
        ID: <input type="text" name="id" value="<?php echo $row['id']; ?>"><br>
        Nomor Induk: <input type="text" name="general_number" value="<?php echo $row['general_number']; ?>"><br>
        Judul: <input type="text" name="title" value="<?php echo $row['title']; ?>"><br>
        Koleksi: <input type="text" name="koleksi" value="<?php echo $row['koleksi']; ?>"><br>
        Jenis Bahan Pustaka: <input type="text" name="material_type" value="<?php echo $row['material_type']; ?>"><br>
        Nomor Urut Buku: <input type="text" name="book_number" value="<?php echo $row['book_number']; ?>"><br>
        Pengarang: <input type="text" name="author" value="<?php echo $row['author']; ?>"><br>
        Jilid: <input type="text" name="jilid" value="<?php echo $row['jilid']; ?>"><br>
        Edisi: <input type="text" name="edition" value="<?php echo $row['edition']; ?>"><br>
        Cetakan: <input type="text" name="print" value="<?php echo $row['cetakan']; ?>"><br>
        ISBN: <input type="text" name="lssn" value="<?php echo $row['lssn']; ?>"><br>
        Nomor Peraturan: <input type="text" name="regulation_number" value="<?php echo $row['regulation_number']; ?>"><br>
        Jenis Peraturan: <input type="text" name="regulation_type" value="<?php echo $row['regulation_type']; ?>"><br>
        Nomor & Tahun Peraturan: <input type="text" name="regulation_year" value="<?php echo $row['regulation_year']; ?>"><br>
        Tempat & Nomor: <input type="text" name="regulation_place" value="<?php echo $row['regulation_place']; ?>"><br>
        Nomor Majalah: <input type="text" name="magazine_number" value="<?php echo $row['magazine_number']; ?>"><br>
        Volume: <input type="text" name="volume_number" value="<?php echo $row['volume_number']; ?>"><br>
        Kala Terbit: <input type="text" name="publication_period" value="<?php echo $row['publication_period']; ?>"><br>
        Tempat Terbit: <input type="text" name="publication_place" value="<?php echo $row['publication_place']; ?>"><br>
        Penerbit: <input type="text" name="publisher" value="<?php echo $row['publisher']; ?>"><br>
        Tahun Terbit: <input type="text" name="publication_year" value="<?php echo $row['publication_year']; ?>"><br>
        Nomor Klasifikasi: <input type="text" name="classification_number" value="<?php echo $row['classification_number']; ?>"><br>
        Berasal Dari: <input type="text" name="source" value="<?php echo $row['source']; ?>"><br>
        Deskripsi: <textarea name="description"><?php echo $row['description']; ?></textarea><br>
        Lemari: <input type="text" name="lemari" value="<?php echo $row['lemari']; ?>"><br>
        Rak: <input type="text" name="rak" value="<?php echo $row['rak']; ?>"><br>
        Sampul Buku: <input type="file" name="cover_image"><br>
        <input type="submit" value="Update Buku">
    </form>
    <div class="back-container">
        <button onclick="window.location.href='index.php'">Kembali</button>
    </div>
    <?php
    } else {
        echo "Buku tidak ditemukan.";
    }
    $conn->close();
    ?>
</body>
</html>
