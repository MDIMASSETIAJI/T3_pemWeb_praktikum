<?php
include "koneksi.php";


if (isset($_GET['nim'])) {
    $nim = $_GET['nim'];


    $query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim'");
    $data = mysqli_fetch_assoc($query);
} else {

    header("Location: home.php");
    exit();
}


if (isset($_POST['update'])) {
    $nim_baru = $_POST['nim'];
    $nama = $_POST['nama'];
    $jenis_kelamin = $_POST['Jenis_kelamin'];

    $update = mysqli_query($conn, "UPDATE mahasiswa 
                                   SET nim='$nim_baru', 
                                       Nama='$nama', 
                                       Jenis_kelamin='$jenis_kelamin' 
                                   WHERE nim='$nim'");

    if ($update) {
        header("Location: home.php");
        exit();
    } else {
        echo "❌ Gagal update data: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Mahasiswa</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body style="background-color: white; color: black;">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
  <a class="navbar-brand fw-bold me-4" href="#" style="margin-left: 70px;">Speda</a>
  <div class="navbar-nav">
    <a class="nav-link active" href="home.php">Home</a>
    <a class="nav-link text-secondary" href="tambah.php">Tambah Mahasiswa</a>
  </div>
</nav>

<div class="container mt-5">
  <h3 style="font-weight: bold;">Update Mahasiswa</h3>
  <form method="POST">
    <div class="mb-3">
      <label class="form-label">NIM</label>
      <input type="text" name="nim" class="form-control" value="<?= $data['nim'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" value="<?= $data['Nama'] ?>" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Jenis Kelamin</label><br>
      <input type="radio" name="Jenis_kelamin" value="Laki-Laki" <?= ($data['Jenis_kelamin'] == 'Laki-Laki') ? 'checked' : '' ?>> Laki-Laki
      <input type="radio" name="Jenis_kelamin" value="Perempuan" <?= ($data['Jenis_kelamin'] == 'Perempuan') ? 'checked' : '' ?>> Perempuan
    </div>
    <button type="submit" name="update" class="btn btn-primary">Update</button>
  </form>
</div>

</body>
</html>
