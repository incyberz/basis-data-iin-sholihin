<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Form Tambah Transaksi Nasabah</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
  <div class="container mt-5">
    <h3 class="mb-4">Form Tambah Transaksi Nasabah</h3>

    <form action="proses_tambah_transaksi.php" method="POST">
      <!-- Pilih Nasabah -->
      <div class="mb-3">
        <label for="id_nasabah" class="form-label">Pilih Nasabah</label>
        <select class="form-select" id="id_nasabah" name="id_nasabah" required>
          <option value="">-- Pilih Nasabah --</option>
          <!-- Contoh statis, ganti dengan data dinamis dari PHP -->
          <option value="1">Ahmad Fauzi</option>
          <option value="2">Siti Aminah</option>
        </select>
      </div>

      <!-- Tanggal Transaksi -->
      <div class="mb-3">
        <label for="tanggal" class="form-label">Tanggal Transaksi</label>
        <input type="date" class="form-control" id="tanggal" name="tanggal"
          value="<?php echo date('Y-m-d'); ?>" required>
      </div>

      <!-- Jenis Transaksi: Setoran atau Penarikan -->
      <div class="mb-3">
        <label class="form-label">Jenis Transaksi</label>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="jenis" id="setoran" value="setoran" checked>
          <label class="form-check-label" for="setoran">Setoran</label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="jenis" id="penarikan" value="penarikan">
          <label class="form-check-label" for="penarikan">Penarikan</label>
        </div>
      </div>

      <!-- Jumlah Uang -->
      <div class="mb-3">
        <label for="jumlah" class="form-label">Jumlah (Rp)</label>
        <input type="number" class="form-control" id="jumlah" name="jumlah" min="1" required>
      </div>

      <!-- Catatan -->
      <div class="mb-3">
        <label for="catatan" class="form-label">Catatan</label>
        <textarea class="form-control" id="catatan" name="catatan" rows="2"></textarea>
      </div>

      <!-- ID Petugas (hidden) -->
      <input type="hidden" name="id_petugas" value="1"> <!-- Simulasi: ID petugas login -->

      <button type="submit" class="btn btn-primary">Simpan Transaksi</button>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Script untuk mengisi debet/kredit otomatis -->
  <script>
    const jenisInputs = document.querySelectorAll('input[name="jenis"]');
    const jumlahInput = document.getElementById('jumlah');

    // Tambahkan hidden input untuk debet dan kredit
    const form = document.querySelector('form');
    const debetInput = document.createElement('input');
    const kreditInput = document.createElement('input');
    debetInput.type = kreditInput.type = "hidden";
    debetInput.name = "debet";
    kreditInput.name = "kredit";
    form.appendChild(debetInput);
    form.appendChild(kreditInput);

    form.addEventListener('submit', function(e) {
      const jumlah = parseInt(jumlahInput.value);
      const jenis = document.querySelector('input[name="jenis"]:checked').value;

      if (jenis === 'setoran') {
        debetInput.value = jumlah;
        kreditInput.value = 0;
      } else {
        debetInput.value = 0;
        kreditInput.value = jumlah;
      }
    });
  </script>
</body>

</html>