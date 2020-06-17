<?php

if($_SESSION['level']!="spv" && $_SESSION['level']!="super"){
  echo "<script>location='index.php'</script>";
}else{

  include_once '_part/koneksi.php';
  $p = $_GET['p'];
  $page = isset($_GET['page']) ? $_GET['page'] : 'list';
  switch ($page) {
  case 'list':
  ?>
  <h1><?= $p=="gaji"? "Data Gaji": "Cetak Slip Gaji" ?></h1>
  <div class="row" style="margin: 20px auto;">
    <?php if($p=="gaji"){ ?>
    <a href="index.php?p=gaji&page=entri" class="btn btn-success"><span class="glyphicon glyphicon-plus"> Tambah</span></a>
    <?php } ?>
  </div>
  <table id="example" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Tanggal</th>
        <th>Perusahaan</th>
        <th>NIK</th>
        <th>Nama</th>
        <?php if($p=="gaji"){ ?>
        <th>Gaji Pokok</th>
  	  <th>Hari Kerja</th>
        <th>Lembur</th>
        <th>Uang Makan</th>
        <th>Transport</th>
        <th>BPJS</th>
        <th>PPH 21</th>
        <?php } ?>
        <th>Total Gaji</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $where = $_SESSION['level']=="spv"? "WHERE b.id_perusahaan='".$_SESSION['id_perusahaan']."'": "";
      $sql = "SELECT a.*, b.nama, c.nama nama_perusahaan FROM gaji a 
              JOIN pegawai b ON a.nip=b.nip
              JOIN perusahaan c ON b.id_perusahaan=c.id_perusahaan $where";
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
        <td><?= $isi->nama_perusahaan;?></td>
        <td><?= $isi->nip;?></td>
        <td><?= $isi->nama;?></td>
        <?php if($p=="gaji"){ ?>
        <td><?= number_format($isi->gaji);?></td>
  	  <td><?= number_format($isi->hari_kerja);?></td>
        <td><?= number_format($isi->lembur);?></td>
        <td><?= number_format($isi->uang_makan);?></td>
        <td><?= number_format($isi->transport);?></td>
        <td><?= number_format($isi->bpjs) ;?></td>
        <td><?= number_format($isi->pph21);?></td>
        <?php } ?>
        <td>
          <?php 
          $total = ($isi->gaji + $isi->lembur + $isi->uang_makan + $isi->transport) - ($isi->bpjs + $isi->pph21);
          echo number_format($total);
          ?>
        </td>
        <td align="center">
          <?php if($p=="gaji"){ ?>
          <a href="index.php?p=gaji&page=edit&id=<?= $isi->id_gaji ?>"><i class="glyphicon glyphicon-edit"> Edit</i></a>
          &nbsp;&nbsp;|&nbsp;&nbsp;
          <a href="gaji/aksi_gaji.php?id=<?= $isi->id_gaji ?>" onclick="return confirm('Yakin Hapus ?')"><i class="glyphicon glyphicon-floppy-remove"> Hapus</i></a>
          <?php }elseif($p=="cetak_slipgaji"){ ?>
          <a href="gaji/cetak_slipgaji.php?id=<?= $isi->id_gaji ?>" target="_blank"><i class="glyphicon glyphicon-file"> Cetak</i></a>
          <?php } ?>
        </td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
  <?php
  break;

  case 'entri':
  ?>
  <?php if($p=="gaji"){ ?>
  <h1>Form Gaji</h1>
  <form id="form1" name="form1" method="post" action="gaji/aksi_gaji.php">
    <div class="row">
      <div class="col-lg-4">
        <div class="form-group">
          <label>Pilih Perusahaan</label>
          <select class="form-control" name="id_perusahaan" required="" onclick="getPegawai(this.value)">
            <option value="">--- Pilih Perusahaan ---</option>
            <?php
              $where = $_SESSION['level']=="spv"? "WHERE id_perusahaan='".$_SESSION['id_perusahaan']."'": "";
              $sqlPerusahaan = "SELECT * FROM perusahaan $where ORDER BY nama ASC";
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
          <label>Pilih Pegawai</label>
          <select class="form-control" name="nip" id="nip" required="">
            <option value="">--- Pilih Pegawai ---</option>
          </select>
        </div>
        <div class="form-group">
          <label>Gaji Pokok</label>
          <input type="number" class="form-control" name="gaji" placeholder="Masukkan Gaji Pokok">
  	  </div>
        <div class="form-group">
          <label>Hari Kerja</label>
          <input type="number" class="form-control" name="hari_kerja" placeholder="Masukkan Hari Kerja" onkeyup="getUangMakan(this.value)">
        </div>
        <div class="form-group">
          <label>Lembur</label>
          <input type="number" class="form-control" name="lembur" placeholder="Masukkan Lembur">
        </div>
        <div class="form-group">
          <label>Uang Makan</label>
          <input type="number" class="form-control" name="uang_makan" id="uang_makan" placeholder="Masukkan Uang Makan" readonly="">
        </div>
        <div class="form-group">
          <label>Transport</label>
          <input type="number" class="form-control" name="transport" id="transport" placeholder="Masukkan Transport" readonly="">
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
  <?php } ?>
  <?php
  break;

  case 'edit':
  if($p=="gaji"){

  $id_gaji = $_GET['id'];
  $sql = "SELECT a.*, b.nama, c.nama nama_perusahaan FROM gaji a 
              JOIN pegawai b ON a.nip=b.nip
              JOIN perusahaan c ON b.id_perusahaan=c.id_perusahaan
              WHERE id_gaji='$id_gaji'";
  $row = $koneksi->prepare($sql);
  $row->execute();
  $isi = $row->fetch(PDO::FETCH_OBJ);

  $nama_perusahaan = $isi->nama_perusahaan;
  $nama = $isi->nama;
  $gaji = $isi->gaji;
  $hari_kerja = $isi->hari_kerja;
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
          <label>Perusahaan</label>
          <input type="text" class="form-control" name="" value="<?= $nama_perusahaan ?>" readonly="">
        </div>
        <div class="form-group">
          <label>Pegawai</label>
          <input type="text" class="form-control" name="pegawai" value="<?= $nama ?>" readonly="">
        </div>
        <div class="form-group">
          <label>Gaji Pokok</label>
          <input type="number" class="form-control" name="gaji" placeholder="Masukkan Gaji Pokok" value="<?= $gaji ?>">
        </div>
  	   <div class="form-group">
          <label>Hari Kerja</label>
          <input type="number" class="form-control" name="hari_kerja" placeholder="Masukkan Hari Kerja" onkeyup="getUangMakan(this.value)" value="<?= $hari_kerja ?>">
        </div>
        <div class="form-group">
          <label>Lembur</label>
          <input type="number" class="form-control" name="lembur" placeholder="Masukkan Lembur" value="<?= $lembur ?>">
        </div>
        <div class="form-group">
          <label>Uang Makan</label>
          <input type="number" class="form-control" name="uang_makan" id="uang_makan" placeholder="Masukkan Uang Makan" readonly="" value="<?= $uang_makan ?>">
        </div>
        <div class="form-group">
          <label>Transport</label>
          <input type="number" class="form-control" name="transport" id="transport" placeholder="Masukkan Transport" readonly="" value="<?= $transport ?>">
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
  <?php } ?>
  <?php
  break;
  }
  ?>
  <script>
    function getPegawai(id_perusahaan){
      $("#nip").load("gaji/ajax/getPegawai.php?id_perusahaan="+id_perusahaan, function(responseTxt, statusTxt, xhr){
        if(statusTxt == "success");
          // alert("External content loaded successfully!");
        if(statusTxt == "error");
          // alert("Error: " + xhr.status + ": " + xhr.statusText);
      });
    }

    function getUangMakan(val){
      $("#uang_makan").val(parseInt(val)*20000);
      $("#transport").val(parseInt(val)*20000);
    }
  </script>
<?php } ?>
