<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">

<div class="text-center">
  <p>halo php, saya iin sholihin, sedang belajar Basis Data, DataTables, dan Bootstrap</p>
  <h1>Data Pengguna Gamified LMS</h1>
</div>
<div class="container">
  <?php
  $conn = mysqli_connect("localhost", "root", "", "db_kampus");
  $sql = "SELECT 
    a.*,
    b.nama as nama_prodi, 
    c.nama as nama_fakultas, 
    d.nama as nama_kampus  
    FROM tb_mhs a
    JOIN tb_prodi b ON a.id_prodi = b.id 
    JOIN tb_fakultas c ON b.id_fakultas = c.id
    JOIN tb_kampus d ON c.id_kampus = d.id
  
  ";
  $q = mysqli_query($conn, $sql) or die(mysqli_error($conn));

  $tr = '';
  $i = 0;
  while ($d = mysqli_fetch_assoc($q)) {
    $i++;
    $tr .= "
      <tr>
        <td>$i</td>
        <td>$d[nim]</td>
        <td>$d[nama]</td>
        <td>$d[gender]</td>
        <td>$d[nama_prodi]</td>
        <td>$d[nama_fakultas]</td>
        <td>$d[nama_kampus]</td>
      </tr>
    ";
  }

  echo "
    <table class='table table-striped table-hover' id=myTable>
      <thead>
        <th>No</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Gender</th>
        <th>Prodi</th>
        <th>Fakultas</th>
        <th>Kampus</th>
      </thead>
      $tr
    </table>
  ";
  ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
<script>
  let table = new DataTable('#myTable');
</script>