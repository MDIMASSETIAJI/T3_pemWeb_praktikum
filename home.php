<?php
include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Mahasiswa</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="" style="background-color: white; color: black;">


<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
  <a class="navbar-brand fw-bold me-4" href="#" style="margin-left: 70px;">Speda</a>
  <div class="navbar-nav">
    <a class="nav-link active" href="">Home</a>
    <a class="nav-link text-secondary" href="tambah.php">Tambah Mahasiswa</a>
  </div>
</nav>


<div class="container mt-4">
  <h3 class="mb-3">Daftar Mahasiswa</h3>


  <div class="input-group mb-3">
    <input type="text" id="searchInput" onkeyup="cariMahasiswa()" class="form-control" placeholder="Cari Mahasiswa...">
    <button class="btn btn-secondary">Cari</button>
  </div>


  <table class="table table-dark table-striped table-hover text-center" id="tabelMahasiswa">
    <thead>
      <tr>
        <th>No</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $no = 1;
      $search = isset($_GET['search']) ? $_GET['search'] : '';
      $query = "SELECT * FROM mahasiswa WHERE nama LIKE '%$search%' ORDER BY id DESC";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) == 0) {
        echo "<tr><td colspan='6'>Tidak ada data.</td></tr>";
      } else {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>
            <td>$no</td>
            <td>{$row['nim']}</td>
            <td>{$row['Nama']}</td>
            <td>{$row['Jenis_kelamin']}</td>
            <td>
              <a href='update.php?nim={$row['nim']}' class='btn btn-primary btn-sm'>Update</a>
              <a href='hapus.php?nim={$row['nim']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Hapus data " . $row['Nama']."?\")'>Delete</a>
            </td>
          </tr>";
          $no++;
        }
      }
      ?>
    </tbody>

    
  </table>
</div>

<div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="" style="background-color: white;">
      <div class="modal-header">
        <h5 class="modal-title" id="hapusModalLabel" style="font-weight: bold;">Hapus Data</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus mahasiswa ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger">Hapus</button>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<script>
function cariMahasiswa() {
  let input = document.getElementById("searchInput");
  let filter = input.value.toLowerCase();
  let tabel = document.getElementById("tabelMahasiswa");
  let tr = tabel.getElementsByTagName("tr");

  for (let i = 1; i < tr.length; i++) {
    let row = tr[i];
    let td = row.getElementsByTagName("td");
    let match = false;

    for (let j = 0; j < td.length; j++) {
      if (td[j]) {
        let textValue = td[j].textContent || td[j].innerText;
        if (textValue.toLowerCase().indexOf(filter) > -1) {
          match = true;
        }
      }
    }
    row.style.display = match ? "" : "none";
  }
}
</script>



</body>
</html>
