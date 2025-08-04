<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cari Buku</title>
    <link rel="stylesheet" href="search.css">
    <link rel="stylesheet" href="hover.css">
</head>
<body>
    <h2>Cari Buku</h2>
    <form method="get" action="search.php">
        <input type="text" name="search" placeholder="Cari...">
        <input type="submit" value="Cari">
        <button type="button" onclick="window.history.back()">Kembali</button>
    </form>

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
            <th>Edisi</th>
            <th>ISBN</th>
            <th>Nomor Peraturan</th>
            <th>Jenis Peraturan</th>
            <th>Tahun Peraturan</th>
            <th>Tempat Peraturan</th>
            <th>Nomor Majalah</th>
            <th>Nomor Volume</th>
            <th>Periode Terbit</th>
            <th>Tempat Terbit</th>
            <th>Penerbit</th>
            <th>Tahun Terbit</th>
            <th>Nomor Klasifikasi</th>
            <th>Sumber</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        <?php
        session_start();
        
        // Menyertakan file koneksi
        include('koneksi.php');
        
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Ambil parameter 'type' dan 'search' dari URL
        $type = isset($_GET['type']) ? $_GET['type'] : '';
        $search = isset($_GET['search']) ? $_GET['search'] : '';

        // Buat query dasar
        $query = "SELECT * FROM books WHERE 1=1";

        // Menambahkan filter berdasarkan jenis koleksi jika ada
        if ($type) {
            $type = $conn->real_escape_string($type); // Escape input untuk keamanan
            $query .= " AND koleksi = '$type'";
        }

        // Menambahkan filter pencarian jika ada
        if ($search) {
            $search = $conn->real_escape_string($search); // Escape input untuk keamanan
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
                isbn LIKE '%$search%' OR
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
                description LIKE '%$search%'
            )";
        }

        $result = $conn->query($query);

        // Cek apakah pengguna adalah admin (role = 1) atau user (role = 0)
        $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] == 1;

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $coverImage = $row['cover_image'] ? 'uploads/' . $row['cover_image'] : 'uploads/default.jpg'; // URL gambar default
                $actionLinks = "<a href='detail.php?id={$row['id']}'>Detail</a>";

                // Periksa role pengguna dari session
                if ($isAdmin) {
                    $actionLinks .= " | <a href='edit.php?id={$row['id']}'>Edit</a> | <a href='delete.php?id={$row['id']}'>Hapus</a>";
                }
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
                                <label>ISBN:</label><input type='text' value='{$row['isbn']}' readonly><br>
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
                    <td>{$row['edition']}</td>
                    <td>{$row['isbn']}</td>
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
                    <td>{$actionLinks}</td>
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
