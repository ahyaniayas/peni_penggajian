<?php

if($_SESSION['level']!="spv"){
  echo "<script>location='index.php'</script>";
}
include_once '_part/koneksi.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'list';
switch ($page) {
case 'list':
?>
<h1>Data Gaji</h1>
<div class="row" style="margin: 20px auto;">
  <a href="index.php?p=gaji&page=entri" class="btn btn-success"><span class="glyphicon glyphicon-plus"> Tambah</span></a>
</div>
<table id="example" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Tanggal</th>
      <th>NIP</th>
      <th>Nama</th>
      <th>Gaji Pokok</th>
      <th>Lembur</th>
      <th>Uang Makan</th>
      <th>Transport</th>
      <th>BPJS</th>
      <th>PPH 21</th>
      <th>Total Gaji</th>
      <th>Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php
    $sql = "SELECT a.*, b.nip, b.nama FROM gaji a JOIN pegawai b ON a.nip=b.nip";
    $row = $koneksi->prepare($sql);
    $row->execute();
    $hasil = $row->fetchAll(PDO::FETCH_OBJ);
    
    foreach($hasil as $isi){
  ?>
    <tr>
      <td>
        <span style="display: none;"><?= date("Ymd", strtotime($isi->tgl_gaji)) ?>?></span>
        <?= date("d-m-Y", strtotime($isi->tgl_gaji));?>
      </td>
      <td><?= $isi->nip;?></td>
      <td><?= $isi->nama;?></td>
      <td><?= number_format($isi->gaji);?></td>
      <td><?= number_format($isi->lembur);?></td>
      <td><?= number_format($isi->uang_makan);?></td>
      <td><?= number_format($isi->transport);?></td>
      <td><?= number_format($isi->bpjs);?></td>
      <td><?= number_format($isi->pph21);?></td>
      <td>
        <?php 
        $total = ($isi->gaji + $isi->lembur + $isi->uang_makan + $isi->transport) - ($isi->bpjs + $isi->pph21);
        echo number_format($total);
        ?>
      </td>
      <td align="center">
          <a href="index.php?p=gaji&page=edit&id=<?= $isi->id_gaji ?>"><i class="glyphicon glyphicon-edit"> Edit</i></a>
          &nbsp;&nbsp;|&nbsp;&nbsp;
          <a href="gaji/aksi_gaji.php?id=<?= $isi->id_gaji ?>" onclick="return confirm('Yakin Hapus ?')"><i class="glyphicon glyphicon-floppy-remove"> Hapus</i></a>
        </td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<?php
break;

case 'entri':
?>
<h1>Form Gaji</h1>
<form id="form1" name="form1" method="post" action="gaji/aksi_gaji.php">
  <div class="row">
    <div class="col-lg-4">
      <div class="form-group">
        <label>Pilih Pegawai</label>
        <select class="form-control" name="nip" required="">
          <option value="">--- Pilih Pegawai ---</option>
          <?php
            $sqlPegawai = "SELECT * FROM pegawai ORDER BY nama ASC";
            $rowPegawai = $koneksi->prepare($sqlPegawai);
            $rowPegawai->execute();
            $hasilPegawai = $rowPegawai->fetchAll(PDO::FETCH_OBJ);
            
            foreach($hasilPegawai as $isiPegawai){
          ?>
          <option value="<?= $isiPegawai->nip ?>"><?= $isiPegawai->nip." - ".$isiPegawai->nama ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label>Gaji Pokok</label>
        <input type="number" class="form-control" name="gaji" placeholder="Masukkan Gaji Pokok">
      </div>
      <div class="form-group">
        <label>Lembur</label>
        <input type="number" class="form-control" name="lembur" placeholder="Masukkan Lembur">
      </div>
      <div class="form-group">
        <label>Uang Makan</label>
        <input type="number" class="form-control" name="uang_makan" placeholder="Masukkan Uang Makan">
      </div>
      <div class="form-group">
        <label>Transport</label>
        <input type="number" class="form-control" name="transport" placeholder="Masukkan Transport">
      </div>
    </div>
    <div class="col-lg-4">
      <div class="form-group">
        <label>BPJS</label>
        <input type="number" class="form-control" name="bpjs" placeholder="Masukkan BPJS">
      </div>
      <div class="form-group">
        <label>PPH 21</label>
        <input type="number" class="form-control" name="pph21" placeholder="Masukkan PPH 21">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4">
      <div class="form-group">
        <button name="proses" type="submit" value="simpan" class="btn btn-primary">
          <i class="glyphicon glyphicon-floppy-disk"></i> Simpan
        </button>
      </div>
      <div class="form-group">
        <a href="index.php?p=gaji">Tampilkan Tabel Gaji</a>
      </div>
    </div>
  </div>
</form>
<?php
break;

case 'edit':
$id_gaji = $_GET['id'];
$sql = "SELECT * FROM gaji WHERE id_gaji='$id_gaji'";
$row = $koneksi->prepare($sql);
$row->execute();
$isi = $row->fetch(PDO::FETCH_OBJ);

$nip = $isi->nip;
$gaji = $isi->gaji;
$lembur = $isi->lembur;
$uang_makan = $isi->uang_makan;
$transport = $isi->transport;
$bpjs = $isi->bpjs;
$pph21 = $isi->pph21;
?>
<h1>Edit Gaji</h1>
<form id="form1" name="form1" method="post" action="gaji/aksi_gaji.php">
  <div class="row">
    <div class="col-lg-4">
      <div class="form-group">
        <label>Pilih Pegawai</label>
        <select class="form-control" name="nip" disabled="">
          <option value="">--- Pilih Pegawai ---</option>
          <?php
            $sqlPegawai = "SELECT * FROM pegawai ORDER BY nama ASC";
            $rowPegawai = $koneksi->prepare($sqlPegawai);
            $rowPegawai->execute();
            $hasilPegawai = $rowPegawai->fetchAll(PDO::FETCH_OBJ);
            
            foreach($hasilPegawai as $isiPegawai){
          ?>
          <option value="<?= $isiPegawai->nip ?>" <?= ($nip==$isiPegawai->nip)? "selected": ""; ?>><?= $isiPegawai->nip." - ".$isiPegawai->nama ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <label>Gaji Pokok</label>
        <input type="number" class="form-control" name="gaji" placeholder="Masukkan Gaji Pokok" value="<?= $gaji ?>">
      </div>
      <div class="form-group">
        <label>Lembur</label>
        <input type="number" class="form-control" name="lembur" placeholder="Masukkan Lembur" value="<?= $lembur ?>">
      </div>
      <div class="form-group">
        <label>Uang Makan</label>
        <input type="number" class="form-control" name="uang_makan" placeholder="Masukkan Uang Makan" value="<?= $uang_makan ?>">
      </div>
      <div class="form-group">
        <label>Transport</label>
        <input type="number" class="form-control" name="transport" placeholder="Masukkan Transport" value="<?= $transport ?>">
      </div>
    </div>
    <div class="col-lg-4">
      <div class="form-group">
        <label>BPJS</label>
        <input type="number" class="form-control" name="bpjs" placeholder="Masukkan BPJS" value="<?= $bpjs ?>">
      </div>
      <div class="form-group">
        <label>PPH 21</label>
        <input type="number" class="form-control" name="pph21" placeholder="Masukkan PPH 21" value="<?= $pph21 ?>">
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4">
      <div class="form-group">
        <input type="hidden" name="id_gaji" value="<?= $id_gaji ?>">
        <button name="proses" type="submit" value="edit" class="btn btn-primary">
          <i class="glyphicon glyphicon-floppy-disk"></i> Simpan
        </button>
      </div>
      <div class="form-group">
        <a href="index.php?p=gaji">Tampilkan Tabel Gaji</a>
      </div>
    </div>
  </div>
</form>
<?php
break;
}
?>
