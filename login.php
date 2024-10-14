<?php
require 'koneksi.php';

if(isset($_GET["id_peserta"])) {
    $id_peserta = $_GET["id_peserta"];

    $query_sql = "DELETE FROM peserta WHERE id_peserta = ?";

    $stmt = $conn->prepare($query_sql);

    if ($stmt) {
        $stmt->bind_param("i", $id_peserta);

        if ($stmt->execute()) {
            $stmt->close();
            header("Location: login.php");
            exit();
        } else {
            echo "Penghapusan Gagal : " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<title>Projek php & mysql</title>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">DAFTAR PEMINJAM BUKU</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold text-white" href="index.php">keluar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold text-white" href="create.php">Tambah Data</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link font-weight-bold text-white" href="daftarbuku.php">Daftar Buku</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <br>
        <h4><center>DAFTAR PEMINJAM </center></h4>
        <div class="table-responsive">
            <table class="my-3 table table-bordered">
                <thead>
                    <tr class="table-primary">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nama Buku</th>
                        <th>Jurusan</th>
                        <th>No Hp</th>
                        <th>Lama Meminjam</th>
                        <th colspan='2'>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM peserta ORDER BY id_peserta DESC";
                    $hasil = mysqli_query($conn, $sql);
                    $no = 0;
                    while ($data = mysqli_fetch_array($hasil)) {
                        $no++;
                    ?>
                    <tr>
                        <td><?php echo $no;?></td>
                        <td><?php echo $data["nama"]; ?></td>
                        <td><?php echo $data["nama_buku"];   ?></td>
                        <td><?php echo $data["jurusan"];   ?></td>
                        <td><?php echo $data["no_hp"];   ?></td>
                        <td><?php echo $data["lama_meminjam"];   ?></td>
                        <td>
                            <a href="update.php?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>" class="btn btn-warning" role="button">Update</a>
                            <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>?id_peserta=<?php echo $data['id_peserta']; ?>" class="btn btn-danger" role="button">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-3Xhd02un7F6rjG8bNP5tEVRUjKNlHHfjKrhwvMFwHYB3A+yw7l07yRTlFt3+8x8/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-JIh3vkkCEf8O6Wztp9d/T2nI9c/TJGWihS25j49LcFBvM2H0en8+aY1ftAmMzg1eH" crossorigin="anonymous"></script>
</body>
</html>
