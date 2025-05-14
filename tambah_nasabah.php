<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Tambah Nasabah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <h3 class="mb-4">Form Tambah Nasabah</h3>

    <form action="proses_tambah_nasabah.php" method="POST">
      <!-- Dropdown Mahasiswa -->
      <div class="mb-3">
        <label for="id_mhs" class="form-label">Pilih Mahasiswa</label>
        <select class="form-select" id="id_mhs" name="id_mhs" required>
          <option value="">-- Pilih Mahasiswa --</option>
          <!-- Berikut contoh opsi statis. Nantinya ini diganti dinamis dari PHP -->
          <?php
          // step1 - posisikan kode php pada tag <option>, hapus tag option statis
          // step2 - koneksi ke database
          $conn = mysqli_connect(
            'localhost',
            'root',
            '',
            'db_kampus'
          );

          // step3 perintah SQL ambil semua data mhs
          $s = "SELECT * FROM tb_mhs ORDER BY nama";

          // step4 eksekusi perintah SQL
          $q = mysqli_query($conn, $s) or die(mysqli_error($conn));

          // step5 looping sebanyak data mhs
          while ($row = mysqli_fetch_assoc($q)) {
            // step6 tampilkan tiap row dalam bentuk tag option
            echo "<option value=$row[id]>$row[nama]</option>";
          }
          ?>
        </select>
      </div>

      <!-- Tanggal Penugasan (assign_at) -->
      <div class="mb-3">
        <label for="assign_at" class="form-label">Tanggal Daftar</label>
        <input type="date" class="form-control" id="assign_at" name="assign_at"
          value="<?php echo date('Y-m-d'); ?>" required>
      </div>

      <!-- assign_by hidden, diasumsikan ID petugas yang login = 1 -->
      <input type="hidden" name="assign_by" value="1">

      <button type="submit" class="btn btn-success">Simpan Nasabah</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>