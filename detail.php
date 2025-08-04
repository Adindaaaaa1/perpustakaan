<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Buku</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="detail.css">
</head>
<body>
    <div class="container">
        <h2>Data Detail Buku</h2>
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
        <div class="form-group image-container">
            <img src="uploads/<?php echo htmlspecialchars($row['cover_image']); ?>" alt="Sampul Buku">
        </div>
        <div class="form-group">
            <label for="title">Judul Buku:</label>
            <textarea id="title" name="title" readonly><?php echo htmlspecialchars($row['title']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="title">Koleksi:</label>
            <textarea id="koleksi" name="koleksi" readonly><?php echo htmlspecialchars($row['koleksi']); ?></textarea>
        </div>
        <div class="form-group">
            <label for="lssn">ISBN:</label>
            <input type="text" id="lssn" name="lssn" value="<?php echo htmlspecialchars($row['lssn']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="material_type">Jenis Bahan Pustaka:</label>
            <input type="text" id="material_type" name="material_type" value="<?php echo htmlspecialchars($row['material_type']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="publisher">Penerbit:</label>
            <input type="text" id="publisher" name="publisher" value="<?php echo htmlspecialchars($row['publisher']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="author">Pengarang:</label>
            <input type="text" id="author" name="author" value="<?php echo htmlspecialchars($row['author']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="publication_year">Tahun Terbit:</label>
            <input type="text" id="publication_year" name="publication_year" value="<?php echo htmlspecialchars($row['publication_year']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="general_number">Nomor Urut Buku:</label>
            <input type="text" id="general_number" name="general_number" value="<?php echo htmlspecialchars($row['general_number']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="classification_number">Nomor Klasifikasi:</label>
            <input type="text" id="classification_number" name="classification_number" value="<?php echo htmlspecialchars($row['classification_number']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="edition">Edisi:</label>
            <input type="text" id="edition" name="edition" value="<?php echo htmlspecialchars($row['edition']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="regulation_type">Jenis Peraturan:</label>
            <input type="text" id="regulation_type" name="regulation_type" value="<?php echo htmlspecialchars($row['regulation_type']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="lemari">Lemari:</label>
            <input type="text" id="lemari" name="lemari" value="<?php echo htmlspecialchars($row['lemari']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="rak">Rak:</label>
            <input type="text" id="rak" name="rak" value="<?php echo htmlspecialchars($row['rak']); ?>" readonly>
        </div>
        <div class="back-container">
        <button onclick="window.history.back()">Kembali</button>
        </div>
        <?php
        } else {
            echo "<p>Buku tidak ditemukan.</p>";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>
