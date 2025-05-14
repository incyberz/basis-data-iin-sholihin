<?php
// debugging apa isi dari data POST (dari tag form)
echo '<pre>';
print_r($_POST);
echo '</pre>';

// koneksi ke database
$conn = mysqli_connect(
  'localhost',
  'root',
  '',
  'db_kampus'
);

// perintah sql
$s = "INSERT INTO tb_nasabah (
  id_mhs,
  assign_by
) VALUES (
  $_POST[id_mhs],
  $_POST[assign_by]
)";
$q = mysqli_query($conn, $s) or die(mysqli_error($conn));

echo '
  Proses INSERT DATA berhasil. |  
  <a href=tampil_data_nasabah.php>Kembali ke Data Nasabah</a>  
';
