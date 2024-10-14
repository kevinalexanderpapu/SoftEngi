<?php
require 'koneksi.php';

if(isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query_sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    
    $stmt = $conn->prepare($query_sql);

    if ($stmt) {
        $stmt->bind_param("ss", $username, $hashed_password);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            echo "Pendaftaran Gagal : " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Pendaftaran Gagal : " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" media="screen" title="no title">
    <title>Register Page</title>
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <form action="register.php" method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <button type="submit" name="register" class="btn-input">Register</button>
            <div class="bottom">
                <p>Sudah punya akun?
                    <a href="index.php">Login disini</a>
                </p>
            </div>
        </form>
    </div>
</body>

</html>
