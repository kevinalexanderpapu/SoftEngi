<?php
include "koneksi.php";

function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = input($_POST["nama"]);
    $nama_buku = input($_POST["nama_buku"]);
    $jurusan = input($_POST["jurusan"]);
    $no_hp = input($_POST["no_hp"]);
    $lama_meminjam = input($_POST["lama_meminjam"]);

    $sql_check_book = "SELECT id FROM books WHERE title = '$nama_buku' AND borrowed = 0";
    $result_check_book = $conn->query($sql_check_book);
    if ($result_check_book->num_rows > 0) {
        $row_check_book = $result_check_book->fetch_assoc();
        $book_id = $row_check_book['id'];

        $sql = "INSERT INTO peserta (nama, nama_buku, jurusan, no_hp, lama_meminjam, book_id) VALUES ('$nama', '$nama_buku', '$jurusan', '$no_hp', '$lama_meminjam', '$book_id')";
        $hasil = mysqli_query($conn, $sql);
        
        if ($hasil) {
            $sql_update_book_status = "UPDATE books SET borrowed = 1 WHERE id = '$book_id'";
            $conn->query($sql_update_book_status);

            header("Location: login.php");
            exit();
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'> Buku tidak tersedia untuk dipinjam.</div>";
    }
}

$sql_daftar_buku = "SELECT title FROM books WHERE borrowed = 0";
$result_daftar_buku = $conn->query($sql_daftar_buku);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Form Peminjaman Buku</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="stylea.css">
</head>
<body>
<div class="background-animation"></div>
<div class="container">
    <h2>Input Data</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" required />
        </div>
        <div class="form-group">
            <label>Nama Buku:</label>
            <select name="nama_buku" class="form-control" required>
                <option value="">Pilih Buku</option>
                <?php
                while($row = $result_daftar_buku->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row['title']) . "'>" . htmlspecialchars($row['title']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Jurusan:</label>
            <input type="text" name="jurusan" class="form-control" placeholder="Masukan Jurusan" required/>
        </div>
        <div class="form-group">
            <label>No HP:</label>
            <input type="tel" pattern="[0-9]*" name="no_hp" class="form-control" placeholder="Masukan No HP" required/>
        </div>
        <div class="form-group">
            <label>Lama Meminjam:</label>
            <select name="lama_meminjam" class="form-control" required>
                <option value="">Pilih Lama Peminjaman</option>
                <option value="1">1 Hari</option>
                <option value="2">2 Hari</option>
                <option value="3">3 Hari</option>
                <option value="4">4 Hari</option>
                <option value="5">5 Hari</option>
                <option value="6">6 Hari</option>
                <option value="7">7 Hari</option>
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button><br></br>
        <button type="button" class="btn btn-danger" onclick="cancel()">Cancel</button>
    </form>
</div>

<script>
    function cancel() {
        window.location.href = "login.php";
    }
</script>

</body>
</html>