<?php
include "koneksi.php";
$nim = $_GET['nim'];
mysqli_query($conn, "DELETE FROM mahasiswa WHERE nim=$nim");
header("Location: home.php");
?>