<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Perpustakaan Kejari Binjai</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="logout.css">
    <link rel="stylesheet" href="hover.css">
</head>
<body>
<?php
session_start();

?>
<div class="logout-container">
    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
</div>
<h2 style="text-align: center;">
    Perpustakaan<br>
    Kejaksaan Negeri Binjai
</h2>
<h3 style="text-align: center;">Daftar Buku</h3>
<nav class="nav-container">
    <button type="button" onClick="window.location.href='koleksi.php'">Cari Buku & Kolesi Buku</button>
</nav>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Sampul Buku</th>
        <th>Nomor Induk</th>
        <th>Judul</th>
        <th>Koleksi</th>
        <th>Jenis Bahan Pustaka</th>
        <th>Nomor Urut Buku</th>
        <th>Pengarang</th>
        <th>Jilid</th>
        <th>Edisi</th>
        <th>Cetakan</th>
        <th>ISBN</th>
        <th>Nomor Peraturan</th>
        <th>Jenis Peraturan</th>
        <th>Nomor & Tahun Peraturan</th>
        <th>Tempat & Nomor</th>
        <th>Nomor Majalah</th>
        <th>Volume</th>
        <th>Kala Terbit</th>
        <th>Tempat Terbit</th>
        <th>Penerbit</th>
        <th>Tahun Terbit</th>
        <th>Nomor Klasifikasi</th>
        <th>Berasal Dari</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </tr>
    <?php
    // Menyertakan file koneksi
    $conn = include('koneksi.php');
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM books";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $coverImage = $row['cover_image'] ? 'uploads/' . $row['cover_image'] : 'uploads/default.jpg'; // URL gambar default
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>
                        <div class='cover-container'>
                            <a href='detail.php?id={$row['id']}'>
                                <img class='cover-image' src='{$coverImage}' alt='Sampul Buku' width='50'>
                            </a>
                            <div class='detail-form'>
                                <img src='{$coverImage}' alt='Sampul Buku' width='100'><br>
                                <label>Judul Buku:</label><input type='text' value='{$row['title']}' readonly><br>
                                <label>Koleksi:</label><input type='text' value='{$row['koleksi']}' readonly><br>
                                <label>ISBN:</label><input type='text' value='{$row['lssn']}' readonly><br>
                                <label>Jenis Bahan Pustaka:</label><input type='text' value='{$row['material_type']}' readonly><br>
                                <label>Penerbit:</label><input type='text' value='{$row['publisher']}' readonly><br>
                                <label>Pengarang:</label><input type='text' value='{$row['author']}' readonly><br>
                                <label>Tahun Terbit:</label><input type='text' value='{$row['publication_year']}' readonly><br>
                                <label>Nomor Urut Buku:</label><input type='text' value='{$row['book_number']}' readonly><br>
                                <label>Nomor Klasifikasi:</label><input type='text' value='{$row['classification_number']}' readonly><br>
                            </div>
                        </div>
                    </td>
                <td>{$row['general_number']}</td>
                <td>{$row['title']}</td>
                <td>{$row['koleksi']}</td>
                <td>{$row['material_type']}</td>
                <td>{$row['book_number']}</td>
                <td>{$row['author']}</td>
                <td>{$row['jilid']}</td>
                <td>{$row['edition']}</td>
                <td>{$row['cetakan']}</td>
                <td>{$row['lssn']}</td>
                <td>{$row['regulation_number']}</td>
                <td>{$row['regulation_type']}</td>
                <td>{$row['regulation_year']}</td>
                <td>{$row['regulation_place']}</td>
                <td>{$row['magazine_number']}</td>
                <td>{$row['volume_number']}</td>
                <td>{$row['publication_period']}</td>
                <td>{$row['publication_place']}</td>
                <td>{$row['publisher']}</td>
                <td>{$row['publication_year']}</td>
                <td>{$row['classification_number']}</td>
                <td>{$row['source']}</td>
                <td>{$row['description']}</td>
                <td><a href='detail.php?id={$row['id']}'>Detail</a></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='23'>Tidak ada hasil</td></tr>";
    }
    $conn->close();
    ?>
</table>
</body>
</html>
