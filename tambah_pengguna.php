<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="data_pengguna.css">
</head>
<body>
    <h1>Tambah Pengguna</h1>
    <form action="proses_tambah_pengguna.php" method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>
        
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="role">Role:</label>
        <select id="role" name="role">
            <option value="0">User</option>
            <option value="1">Admin</option>
        </select>
        
        <button type="submit">Tambah Pengguna</button>
        <button type="button" class="back-button" onclick="window.history.back()">Kembali</button>
    </form>
</body>
</html>
