<?php
include 'koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .exit-button {
            background-color: #dc3545;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            margin-top: 20px;
            margin-left: 20px;
            transition: background-color 0.3s ease;
        }
        
        .exit-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<?php
session_start();

include 'koneksi.php';

$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>ID</th><th>Judul</th><th>Penulis</th><th>Status</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["title"]. "</td><td>" . $row["author"]. "</td><td>";
        
        if ($row["borrowed"]) {
            echo "Dipinjam";
        } else {
            echo "Tersedia";
        }

        echo "</td></tr>";
    }
    echo "</table>";

    echo "<br><br>";

    echo "<form action='login.php'><button type='submit' class='exit-button'>Exit</button></form>";
} else {
    echo "0 hasil";
}
$conn->close();
?>
</body>
</html>
