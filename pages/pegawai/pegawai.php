<?php

if($_SESSION['level']!="spv"){
  echo "<script>location='index.php'</script>";
}

include_once '_part/koneksi.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'list';
switch ($page) {
case 'list':
?>
<h1>Data Pegawai</h1>
<div class="row" style="margin: 20px auto;">
  <a href="index.php?p=pegawai&page=entri" class="btn btn-success"><span class="glyphicon glyphicon-plus"> Tambah</span></a>
</div>
<table id="example" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Perusahaan</th>
      <th>NIK</th>
      <th>Nama</th>
      <th>Alamat</th>
      <th>Jabatan</th>
      <th>No. Hp</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
	<?php
		$sql = "SELECT a.*, b.nama nama_perusahaan FROM pegawai a JOIN perusahaan b ON a.id_perusahaan=b.id_perusahaan";
    $row = $koneksi->prepare($sql);
    $row->execute();
    $hasil = $row->fetchAll(PDO::FETCH_OBJ);
		
		foreach($hasil as $isi){
	?>
    <tr>
      <td><?= $isi->nama_perusahaan;?></td>
      <td><?= $isi->nip;?></td>
      <td><?= $isi->nama;?></td>
      <td><?= $isi->alamat;?></td>
      <td><?= $isi->jabatan;?></td>
      <td><?= $isi->nohp;?></td>
      <td align="center">
        <a href="index.php?p=pegawai&page=edit&nip=<?= $isi->nip ?>"><i class="glyphicon glyphicon-edit"> Edit</i></a>
        &nbsp;&nbsp;|&nbsp;&nbsp;
        <a href="pegawai/aksi_pegawai.php?nip=<?= $isi->nip ?>" onclick="return confirm('Yakin Hapus ?')"><i class="glyphicon glyphicon-floppy-remove"> Hapus</i></a>
      </td>
    </tr>
	<?php } ?>
  </tbody>
</table>
<?php
break;

case 'entri':
?>
<h1>Form Pegawai</h1>
<form id="form1" name="form1" method="post" action="pegawai/aksi_pegawai.php">
  <div class="col-lg-4">
    <div class="form-group">
      <label>Pilih Perusahaan</label>
      <select class="form-control" name="id_perusahaan" required="">
        <option value="">--- Pilih Perusahaan ---</option>
        <?php
          $sqlPerusahaan = "SELECT * FROM perusahaan ORDER BY nama ASC";
          $rowPerusahaan = $koneksi->prepare($sqlPerusahaan);
          $rowPerusahaan->execute();
          $hasilPerusahaan = $rowPerusahaan->fetchAll(PDO::FETCH_OBJ);
          
          foreach($hasilPerusahaan as $isiPerusahaan){
        ?>
        <option value="<?= $isiPerusahaan->id_perusahaan ?>"><?= $isiPerusahaan->nama ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label>NIK</label>
      <input type="number" class="form-control" name="nip" placeholder="Masukkan NIK" required="">
    </div>
    <div class="form-group">
      <label>Nama</label>
      <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama">
    </div>
    <div class="form-group">
      <label>Alamat</label>
      <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat"></textarea>
    </div>
    <div class="form-group">
      <label>Jabatan</label>
      <input type="text" class="form-control" name="jabatan" placeholder="Masukkan Jabatan">
    </div>
    <div class="form-group">
      <label>No. Hp</label>
      <input type="number" class="form-control" name="nohp" placeholder="Masukkan No. Hp">
    </div>
    <div class="form-group">
      <button name="proses" type="submit" value="simpan" class="btn btn-primary">
        <i class="glyphicon glyphicon-floppy-disk"></i>	Simpan
      </button>
    </div>
    <div class="form-group">
      <a href="index.php?p=pegawai">Tampilkan Tabel Pegawai</a>
    </div>
  </div>
</form>
<?php
break;

case 'edit':
$nip = $_GET['nip'];
$sql = "SELECT * FROM pegawai WHERE nip='$nip'";
$row = $koneksi->prepare($sql);
$row->execute();
$isi = $row->fetch(PDO::FETCH_OBJ);

$nama = $isi->nama;
$alamat = $isi->alamat;
$jabatan = $isi->jabatan;
$nohp = $isi->nohp;
$id_perusahaan = $isi->id_perusahaan;
?>
<h1>Edit Pegawai</h1>
<form id="form1" name="form1" method="post" action="pegawai/aksi_pegawai.php">
  <div class="col-lg-4">
    <div class="form-group">
      <label>Pilih Perusahaan</label>
      <select class="form-control" name="id_perusahaan" disabled="">
        <option value="">--- Pilih Perusahaan ---</option>
        <?php
          $sqlPerusahaan = "SELECT * FROM perusahaan ORDER BY nama ASC";
          $rowPerusahaan = $koneksi->prepare($sqlPerusahaan);
          $rowPerusahaan->execute();
          $hasilPerusahaan = $rowPerusahaan->fetchAll(PDO::FETCH_OBJ);
          
          foreach($hasilPerusahaan as $isiPerusahaan){
        ?>
        <option value="<?= $isiPerusahaan->id_perusahaan ?>" <?= $id_perusahaan==$isiPerusahaan->id_perusahaan? "selected": ""; ?>><?= $isiPerusahaan->nama ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="form-group">
      <label>NIK</label>
      <input type="number" class="form-control" name="nip" placeholder="Masukkan NIK" value="<?= $nip ?>" readonly="">
    </div>
    <div class="form-group">
      <label>Nama</label>
      <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" value="<?= $nama ?>">
    </div>
    <div class="form-group">
      <label>Alamat</label>
      <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat"><?= $alamat ?></textarea>
    </div>
    <div class="form-group">
      <label>Jabatan</label>
      <input type="text" class="form-control" name="jabatan" placeholder="Masukkan Jabatan" value="<?= $jabatan ?>">
    </div>
    <div class="form-group">
      <label>No. Hp</label>
      <input type="number" class="form-control" name="nohp" placeholder="Masukkan No. Hp" value="<?= $nohp ?>">
    </div>
    <div class="form-group">
      <button name="proses" type="submit" value="edit" class="btn btn-primary">
        <i class="glyphicon glyphicon-floppy-disk"></i> Simpan
      </button>
    </div>
    <div class="form-group">
      <a href="index.php?p=pegawai">Tampilkan Tabel Pegawai</a>
    </div>
  </div>
</form>
<?php
break;
}
?>
