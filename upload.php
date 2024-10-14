<!DOCTYPE html>
<html>
<head>
    <title>Sinopsis Film</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        textarea {
            height: 100px;
        }
        .btn {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Sinopsis Film</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Judul Film:</label>
            <input type="text" name="judul_film" required>
        </div>
        <div class="form-group">
            <label>Sinopsis:</label>
            <textarea name="sinopsis" required></textarea>
        </div>
        <div class="form-group">
            <label>Gambar Poster:</label>
            <input type="file" name="gambar" accept="image/*" required>
        </div>
        <div class="form-group">
            <button type="submit" name="submit" class="btn">Submit</button>
        </div>
    </form>
</div>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul_film = $_POST['judul_film'];
    $sinopsis = $_POST['sinopsis'];
    $gambar = $_FILES['gambar']['name'];
    $gambar_tmp = $_FILES['gambar']['tmp_name'];

    // Pindahkan gambar ke direktori yang diinginkan
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($gambar);
    move_uploaded_file($gambar_tmp, $target_file);

    // Tampilkan hasil
    echo "<h2>Detail Film:</h2>";
    echo "<p><strong>Judul Film:</strong> $judul_film</p>";
    echo "<p><strong>Sinopsis:</strong> $sinopsis</p>";
    echo "<p><strong>Gambar Poster:</strong> <img src='$target_file' alt='Poster Film'></p>";
}
?>
