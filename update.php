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
<?php
include "koneksi.php";

function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_GET['id_peserta'])) {
    $id_peserta = input($_GET["id_peserta"]);
    $sql = "SELECT * FROM peserta WHERE id_peserta=$id_peserta";
    $hasil = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($hasil);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_peserta = htmlspecialchars($_POST["id_peserta"]);
    $nama = input($_POST["nama"]);
    $nama_buku = input($_POST["nama_buku"]);
    $jurusan = input($_POST["jurusan"]);
    $no_hp = input($_POST["no_hp"]);
    $lama_meminjam = input($_POST["lama_meminjam"]);

    // Update peserta data
    $sql = "UPDATE peserta SET
            nama='$nama',
            nama_buku='$nama_buku',
            jurusan='$jurusan',
            no_hp='$no_hp',
            lama_meminjam='$lama_meminjam'
            WHERE id_peserta=$id_peserta";

    $hasil = mysqli_query($conn, $sql);

    if ($hasil) {
        $update_book_sql = "UPDATE books SET borrowed = 1 WHERE title = '$nama_buku'";
        $update_book_result = $conn->query($update_book_sql);

        if ($update_book_result) {
            header("Location: login.php");
        } else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
        }
    } else {
        echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";
    }
}

$sql_daftar_buku = "SELECT title FROM books WHERE borrowed = 0";
$result_daftar_buku = $conn->query($sql_daftar_buku);
?>

    <h2>Update Data</h2>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" placeholder="Masukan Nama" value="<?php echo isset($data['nama']) ? $data['nama'] : ''; ?>" required />
        </div>
        <div class="form-group">
            <label>Nama Buku:</label>
            <select name="nama_buku" class="form-control" required>
                <option value="">Pilih Buku</option>
                <?php
                while($row = $result_daftar_buku->fetch_assoc()) {
                    echo "<option value='" . htmlspecialchars($row['title']) . "'";
                    if (isset($data['nama_buku']) && $data['nama_buku'] == $row['title']) {
                        echo " selected";
                    }
                    echo ">" . htmlspecialchars($row['title']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Jurusan:</label>
            <input type="text" name="jurusan" class="form-control" placeholder="Masukan Jurusan" value="<?php echo isset($data['jurusan']) ? $data['jurusan'] : ''; ?>" required/>
        </div>
        <div class="form-group">
            <label>No HP:</label>
            <input type="tel" pattern="[0-9]*" name="no_hp" class="form-control" placeholder="Masukan No HP" value="<?php echo isset($data['no_hp']) ? $data['no_hp'] : ''; ?>" required/>
        </div>
        <div class="form-group">
            <label>Lama Meminjam:</label>
            <select name="lama_meminjam" class="form-control" required>
                <option value="">Pilih Lama Peminjaman</option>
                <option value="1" <?php if(isset($data['lama_meminjam']) && $data['lama_meminjam'] == "1") echo "selected"; ?>>1 Hari</option>
                <option value="2" <?php if(isset($data['lama_meminjam']) && $data['lama_meminjam'] == "2") echo "selected"; ?>>2 Hari</option>
                <option value="3" <?php if(isset($data['lama_meminjam']) && $data['lama_meminjam'] == "3") echo "selected"; ?>>3 Hari</option>
                <option value="4" <?php if(isset($data['lama_meminjam']) && $data['lama_meminjam'] == "4") echo "selected"; ?>>4 Hari</option>
                <option value="5" <?php if(isset($data['lama_meminjam']) && $data['lama_meminjam'] == "5") echo "selected"; ?>>5 Hari</option>
                <option value="6" <?php if(isset($data['lama_meminjam']) && $data['lama_meminjam'] == "6") echo "selected"; ?>>6 Hari</option>
                <option value="7" <?php if(isset($data['lama_meminjam']) && $data['lama_meminjam'] == "7") echo "selected"; ?>>7 Hari</option>
            </select>
        </div>
        <input type="hidden" name="id_peserta" value="<?php echo $data['id_peserta']; ?>" />
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
