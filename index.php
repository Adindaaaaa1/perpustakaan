<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Perpustakaan</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="logout.css">
    <link rel="stylesheet" href="hover.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- ✅ Tambahan CSS tabel & popup rapi -->
    <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: center;
        }

        .cover-container {
            position: relative;
            display: inline-block;
        }

        .book-popup {
            display: none;
            position: absolute;
            z-index: 999;
            top: 0;
            left: 60px;
            width: 300px;
            background: white;
            border: 1px solid #ccc;
            padding: 15px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.3);
            text-align: center;
        }

        .cover-container:hover .book-popup {
            display: block;
        }

        .book-popup img {
            width: 120px;
            margin-bottom: 10px;
        }

        .book-popup input {
            width: 100%;
            margin: 4px 0;
            padding: 5px;
            text-align: center;
            border: 1px solid #aaa;
            border-radius: 4px;
        }

        .book-popup label {
            display: block;
            font-weight: bold;
            margin-top: 6px;
            text-align: left;
        }
    </style>
</head>
<body>
<div class="logout-container">
    <form action="logout.php" method="post">
        <input type="submit" value="Logout">
    </form>
</div>

<h2 style="text-align: center;">
    Sistem Manajemen Perpustakaan<br>
    Kejaksaan Negeri Binjai
</h2>
<h3 style="text-align: center;">Daftar Buku</h3>

<?php
include 'koneksi.php';
$query = mysqli_query($conn, "SELECT COUNT(*) as total FROM books");
$data = mysqli_fetch_assoc($query);
echo "<p style='text-align:left; font-weight:bold;'>Jumlah Data Buku = " . $data['total'] . "</p>";
?>

<nav class="nav-container">
    <button onclick="location.href='daftar_data_pengguna.php'">Tambah Pengguna</button>
    <button type="button" onClick="window.location.href='add.php'">Tambah Buku Baru</button>
    <button type="button" onClick="window.location.href='koleksi.php'">Cari Buku & Koleksi Buku</button>
</nav>

<table>
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
        <th>Lemari</th>
        <th>Rak</th>
        <th>Aksi</th>
    </tr>

    <?php
    $conn = include('koneksi.php');
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM books ORDER BY id ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $coverImage = $row['cover_image'] ? 'uploads/' . $row['cover_image'] : 'uploads/default.jpg';

            echo "<tr>
                <td>{$row['id']}</td>
                <td>
                    <div class='cover-container'>
                        <img src='{$coverImage}' alt='Sampul Buku' width='50'>
                        <div class='book-popup'>
                            <img src='{$coverImage}' alt='Sampul Buku'>
                            <label>Judul Buku:</label>
                            <input type='text' value='{$row['title']}' readonly>
                            
                            <label>Koleksi:</label>
                            <input type='text' value='{$row['koleksi']}' readonly>
                            
                            <label>ISBN:</label>
                            <input type='text' value='{$row['lssn']}' readonly>
                            
                            <label>Jenis Bahan Pustaka:</label>
                            <input type='text' value='{$row['material_type']}' readonly>
                            
                            <label>Penerbit:</label>
                            <input type='text' value='{$row['publisher']}' readonly>
                            
                            <label>Pengarang:</label>
                            <input type='text' value='{$row['author']}' readonly>
                            
                            <label>Tahun Terbit:</label>
                            <input type='text' value='{$row['publication_year']}' readonly>
                            
                            <label>Nomor Urut Buku:</label>
                            <input type='text' value='{$row['book_number']}' readonly>
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
                <td>{$row['lemari']}</td>
                <td>{$row['rak']}</td>
                <td><a href='detail.php?id={$row['id']}'>Detail</a> | <a href='edit.php?id={$row['id']}'>Edit</a> | <a href='delete.php?id={$row['id']}'>Hapus</a></td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='28'>Tidak ada buku yang ditemukan</td></tr>";
    }

    $conn->close();
    ?>
</table>

<!-- Tombol scroll -->
<button onclick="scrollToTop()" id="scrollUpBtn" title="Go to top">
    <i class="fas fa-arrow-up"></i>
</button>
<button onclick="scrollToBottom()" id="scrollDownBtn" title="Go to bottom">
    <i class="fas fa-arrow-down"></i>
</button>

<script src="script.js"></script>
</body>
</html>