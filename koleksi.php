<?php
session_start();
include('koneksi.php');

// Ambil filter dari URL
$type = isset($_GET['type']) ? $_GET['type'] : '';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query dasar
$query = "SELECT * FROM books WHERE 1=1";

// Filter jenis koleksi
if ($type) {
    $type = $conn->real_escape_string($type);
    $query .= " AND koleksi = '$type'";
}

// Filter pencarian
if ($search) {
    $search = $conn->real_escape_string($search);
    $query .= " AND (
        id LIKE '%$search%' OR
        cover_image LIKE '%$search%' OR
        general_number LIKE '%$search%' OR
        title LIKE '%$search%' OR
        koleksi LIKE '%$search%' OR
        material_type LIKE '%$search%' OR
        book_number LIKE '%$search%' OR
        author LIKE '%$search%' OR
        jilid LIKE '%$search%' OR
        edition LIKE '%$search%' OR
        cetakan LIKE '%$search%' OR
        lssn LIKE '%$search%' OR
        regulation_number LIKE '%$search%' OR
        regulation_type LIKE '%$search%' OR
        regulation_year LIKE '%$search%' OR
        regulation_place LIKE '%$search%' OR
        magazine_number LIKE '%$search%' OR
        volume_number LIKE '%$search%' OR
        publication_period LIKE '%$search%' OR
        publication_place LIKE '%$search%' OR
        publisher LIKE '%$search%' OR
        publication_year LIKE '%$search%' OR
        classification_number LIKE '%$search%' OR
        source LIKE '%$search%' OR
        description LIKE '%$search%' OR
        lemari LIKE '%$search%' OR
        rak LIKE '%$search%'
    )";
}

$query .= " ORDER BY id ASC";
$result = $conn->query($query);
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] == 1;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Koleksi Buku</title>
    <link rel="stylesheet" href="koleksi2.css">
    <link rel="stylesheet" href="hover.css">
</head>
<body>

<h2>Koleksi Buku Perpustakaan</h2>

<form method="get" action="koleksi.php">
    <nav class="nav-container">
        <button type="submit" name="type" value="Koleksi Inti">Koleksi Inti</button>
        <button type="submit" name="type" value="Koleksi Dasar">Koleksi Dasar</button>
        <button type="submit" name="type" value="Koleksi Pendukung">Koleksi Pendukung</button>
        <button type="submit" name="type" value="Koleksi Spesifik">Koleksi Spesifik</button>
    </nav>
    <input type="text" name="search" placeholder="Cari...">
    <input type="submit" value="Cari">
    <button type="button" onclick="window.history.back()">Kembali</button>
</form>

<?php
if ($result) {
    $totalBooks = $result->num_rows;
    echo "<p>Jumlah Buku: <strong>$totalBooks</strong></p>";
}
?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Sampul</th>
        <th>Nomor Induk</th>
        <th>Judul</th>
        <th>Koleksi</th>
        <th>Jenis Bahan</th>
        <th>No Buku</th>
        <th>Pengarang</th>
        <th>Jilid</th>
        <th>Edisi</th>
        <th>Cetakan</th>
        <th>ISBN</th>
        <th>No Peraturan</th>
        <th>Jenis Peraturan</th>
        <th>Tahun Peraturan</th>
        <th>Tempat</th>
        <th>No Majalah</th>
        <th>Volume</th>
        <th>Kala Terbit</th>
        <th>Tempat Terbit</th>
        <th>Penerbit</th>
        <th>Tahun Terbit</th>
        <th>Klasifikasi</th>
        <th>Sumber</th>
        <th>Lemari</th>
        <th>Rak</th>
        <th>Deskripsi</th>
        <th>Aksi</th>
    </tr>

<?php
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $coverImage = $row['cover_image'] ? 'uploads/' . $row['cover_image'] : 'uploads/default.jpg';
        $actionLinks = "<a href='detail.php?id={$row['id']}'>Detail</a>";
        if ($isAdmin) {
            $actionLinks .= " | <a href='edit.php?id={$row['id']}'>Edit</a> | <a href='delete.php?id={$row['id']}'>Hapus</a>";
        }

        echo "<tr>
            <td>{$row['id']}</td>
            <td>
                <a href='detail.php?id={$row['id']}'><img src='{$coverImage}' width='50' alt='Sampul'></a>
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
            <td>{$row['lemari']}</td>
            <td>{$row['rak']}</td>
            <td>{$row['description']}</td>
            <td>{$actionLinks}</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='28'>Tidak ada buku yang ditemukan.</td></tr>";
}
$conn->close();
?>
</table>
</body>
</html>