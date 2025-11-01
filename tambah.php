<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
  $nim = $_POST['nim'];
  $nama = $_POST['nama'];
  $jenis_kelamin = $_POST['Jenis_kelamin'];


  $query = "INSERT INTO mahasiswa (nim, Nama, Jenis_kelamin, created_at)
            VALUES ('$nim', '$nama', '$jenis_kelamin', NOW())";
  
  $result = mysqli_query($conn, $query);


  if ($result) {
    header("Location: home.php");
    exit();
  } else {
    echo "❌ Gagal menambahkan data: " . mysqli_error($conn);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Mahasiswa</title>
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
  <h3 style="font-weight: bold;">Tambah Mahasiswa</h3>
  <form method="POST" action="">
    <div class="mb-3">
      <label class="form-label">NIM</label>
      <input type="text" name="nim" class="form-control" placeholder="Masukkan NIM" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Nama</label>
      <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama" required>
    </div>
    <div class="mb-3">
      <label class="form-label">Jenis Kelamin</label><br>
      <input type="radio" name="Jenis_kelamin" value="Laki-Laki" required> Laki-Laki
      <input type="radio" name="Jenis_kelamin" value="Perempuan" required> Perempuan
    </div>
    <button type="submit" name="simpan" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>
