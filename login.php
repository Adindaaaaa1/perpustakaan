<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Informasi database
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $dbname = "perpus";

    // Buat koneksi
    $conn = new mysqli($servername, $username_db, $password_db, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ambil input dari form
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    // Prepare and bind SQL statement
    $sql = "SELECT id, password, role FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Prepare failed: " . $conn->error);
    }
    $stmt->bind_param("s", $input_username);

    // Execute statement
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }
    $result = $stmt->get_result();

    // Check result
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($input_password, $row['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $input_username;
            $_SESSION['role'] = $row['role'];

            // Redirect based on role
        if ($row['role'] == 1) {
            header("Location: index.php");
        } else {
            header("Location: user.php");
        }
            exit();

        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" type="image/png" href="images/logo.png">
    <link rel="stylesheet" href="login.css">
    <style>
        .error {
            color: red;
        }
        .error-margin {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <input type="submit" value="Login">
        </form>
        
        <?php
        if (isset($error)) {
            echo "<div class='error error-margin'>$error</div>";
        }
        ?>
    </div>
</body>
</html>
