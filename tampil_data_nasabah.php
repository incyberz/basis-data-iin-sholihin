<?php
$conn = mysqli_connect("localhost", "root", "", "db_kampus");
$sql = "SELECT 
a.*,
(
  SELECT nama FROM tb_mhs 
  WHERE id=a.id_mhs) nama_nasabah,
(
  SELECT COUNT(id) FROM tb_trx 
  WHERE id_nasabah=a.id) count_trx,
(
  SELECT SUM(debet) FROM tb_trx 
  WHERE id_nasabah=a.id) sum_debet,
(
  SELECT SUM(kredit) FROM tb_trx 
  WHERE id_nasabah=a.id) sum_kredit


FROM tb_nasabah a 

";
$q = mysqli_query($conn, $sql) or die(mysqli_error($conn));

$tr = '';
$i = 0;
while ($d = mysqli_fetch_assoc($q)) {
  $i++;
  $nama_nasabah = ucwords(strtolower($d['nama_nasabah']));

  $saldo = $d['sum_kredit'] - $d['sum_debet'];

  $sum_debet = 'Rp ' . number_format($d['sum_debet']);
  $sum_kredit = 'Rp ' . number_format($d['sum_kredit']);
  $saldo = 'Rp ' . number_format($saldo);

  $tr .= "
    <tr>
      <td>$i</td>
      <td>$nama_nasabah</td>
      <td>$d[count_trx]</td>
      <td>
        <div style='text-align:right'>$sum_debet</div>
      </td>
      <td>
        <div style='text-align:right'>$sum_kredit</div>
      </td>
      <td>
        <div style='text-align:right'>$saldo</div>
      </td>
    </tr>
  ";
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Data Nasabah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <h2 class="mb-4">Tabel Data Nasabah</h2>
    <div class="table-responsive">
      <table class="table table-bordered table-striped">
        <thead class="table-dark">
          <tr>
            <th>No</th>
            <th>Nama Nasabah</th>
            <th>Count Transaksi</th>
            <th>Jumlah Debet</th>
            <th>Jumlah Kredit</th>
            <th>Saldo</th>
          </tr>
        </thead>
        <tbody>
          <?= $tr ?>
          <!-- Tambahkan data lainnya di sini -->
        </tbody>
      </table>

      <a href="tambah_nasabah.php">Tambah Nasabah</a>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>