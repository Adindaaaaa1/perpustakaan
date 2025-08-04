<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Data Pengguna</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="data_pengguna.css">
</head>
<body>
    <h1>Daftar Data Pengguna</h1>
    <div class="container">
    <button onclick="location.href='tambah_pengguna.php'">Tambah User</button>
    <button type="button" class="back-button" onclick="window.history.back()">Kembali</button>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
        <?php
        include 'koneksi.php'; // File koneksi database

        $sql = "SELECT id, nama, username, email, role FROM users";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["nama"] . "</td>";
                echo "<td>" . $row["username"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . ($row["role"] == 1 ? 'Admin' : 'User') . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Tidak ada data pengguna</td></tr>";
        }

        mysqli_close($conn);
        ?>
    </table>
</body>
</html>
