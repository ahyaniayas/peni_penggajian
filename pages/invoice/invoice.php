<?php

if($_SESSION['level']!="keu" && $_SESSION['level']!="super"){
  echo "<script>location='index.php'</script>";
}else{

  include_once '_part/koneksi.php';

  $p = $_GET['p'];
  $page = isset($_GET['page']) ? $_GET['page'] : 'list';
  switch ($page) {
  case 'list':

  if($p=="invoice"){
    $judul = "Data Invoice";
  }elseif($p=="cetak_invoice"){
    $judul = "Cetak Invoice";
  }elseif($p=="pembayaran"){
    $judul = "Data pembayaran";
  }
  ?>
  <h1><?= $judul ?></h1>
  <div class="row" style="margin: 20px auto;">
    <?php if($p=="invoice"){ ?>
    <a href="index.php?p=invoice&page=entri" class="btn btn-success"><span class="glyphicon glyphicon-plus"> Tambah</span></a>
    <?php } ?>
  </div>
  <table id="example" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>No. Invoice</th>
        <th>Tanggal</th>
        <th>Perusahaan</th>
        <?php if($p=="invoice"){ ?>
        <th>Total Gaji</th>
        <th>M Fee</th>
        <th>PPN</th>
        <th>PPH 23</th>
        <?php } ?>
        <th>Total</th>
        <?php if($p=="pembayaran"){ ?>
        <th>Bayar</th>
        <th>Tgl. Bayar</th>
        <th>Saldo</th>
        <?php } ?>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
  	<?php
  		$sql = "SELECT a.*, b.nama nama_perusahaan FROM invoice a JOIN perusahaan b ON a.id_perusahaan=b.id_perusahaan";
      $row = $koneksi->prepare($sql);
      $row->execute();
      $hasil = $row->fetchAll(PDO::FETCH_OBJ);
  		
  		foreach($hasil as $isi){
  	?>
      <tr>
        <td><?= $isi->nomor;?></td>
        <td><span style='display: none;'><?= date('Ymd', strtotime($isi->tgl_invoice)) ?></span><?= date("d-m-Y", strtotime($isi->tgl_invoice));?></td>
        <td><?= $isi->nama_perusahaan;?></td>
        <?php if($p=="invoice"){ ?>
        <td><?= number_format($isi->total_gaji);?></td>
        <td><?= number_format($isi->mfee);?></td>
        <td><?= number_format($isi->mfee * 10 / 100);?></td>
        <td><?= number_format($isi->mfee * 2 /100);?></td>
        <?php } ?>
        <td><?= number_format(($isi->total_gaji + $isi->mfee + ($isi->mfee*10/100)) - ($isi->mfee*2/100));?></td>
        <?php if($p=="pembayaran"){ ?>
        <td><?= $isi->bayar>0? number_format($isi->bayar): ""; ?></td>
        <td><?= $isi->bayar>0? "<span style='display: none;'><?= date('Ymd', strtotime($isi->tgl_bayar)) ?></span>".date("d-m-Y", strtotime($isi->tgl_bayar)): ""; ?></td>
        <td><?= number_format((($isi->total_gaji + $isi->mfee + ($isi->mfee*10/100)) - ($isi->mfee*2/100)) - $isi->bayar);?></td>
        <?php } ?>
        <td><?= $isi->bayar>0? "Dibayar": "Belum Dibayar"; ?></td>
        <td align="center">
          <?php if($p=="invoice"){ ?>
          <a href="index.php?p=invoice&page=edit&id=<?= $isi->id_invoice ?>"><i class="glyphicon glyphicon-edit"> Edit</i></a>
          &nbsp;&nbsp;|&nbsp;&nbsp;
          <a href="invoice/aksi_invoice.php?id=<?= $isi->id_invoice ?>" onclick="return confirm('Yakin Hapus ?')"><i class="glyphicon glyphicon-floppy-remove"> Hapus</i></a>
          <?php }elseif($p=="pembayaran"){ ?>
          <a href="index.php?p=pembayaran&page=edit&id=<?= $isi->id_invoice ?>"><i class="glyphicon glyphicon-pencil"> Bayar</i></a>
          <?php }elseif($p=="cetak_invoice"){ ?>
          <a href="invoice/cetak_invoice.php?id=<?= $isi->id_invoice ?>" target="_blank"><i class="glyphicon glyphicon-file"> Cetak</i></a>
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
  <?php if($p=="invoice"){ ?>
  <h1>Form Invoice</h1>
  <form id="form1" name="form1" method="post" action="invoice/aksi_invoice.php">
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
        <label>Tanggal</label>
        <input type="text" class="form-control" name="tgl_invoice" placeholder="0000-00-00" required="">
      </div>
      <div class="form-group">
        <label>Total Gaji</label>
        <input type="text" class="form-control number" name="total_gaji" placeholder="Masukkan Total Gaji" onkeyup="setData(this.value)">
      </div>
      <div class="form-group">
        <label>Management Fee</label>
        <input type="text" class="form-control number" name="mfee" id="mfee" placeholder="Masukkan Management Fee" readonly="">
      </div>
      <div class="form-group">
        <label>PPN</label>
        <input type="text" class="form-control number" id="ppn" placeholder="Masukkan PPN" readonly="">
      </div>
      <div class="form-group">
        <label>PPH 23</label>
        <input type="text" class="form-control number" id="pph23" placeholder="Masukkan PPH 23" readonly="">
      </div>
      <div class="form-group">
        <button name="proses" type="submit" value="simpan" class="btn btn-primary">
          <i class="glyphicon glyphicon-floppy-disk"></i>	Simpan
        </button>
      </div>
      <div class="form-group">
        <a href="index.php?p=invoice">Tampilkan Tabel Invoice</a>
      </div>
    </div>
  </form>
  <?php } ?>
  <?php
  break;

  case 'edit':
  if($p=="invoice"){
  $id_invoice = $_GET['id'];
  $sql = "SELECT * FROM invoice WHERE id_invoice='$id_invoice'";
  $row = $koneksi->prepare($sql);
  $row->execute();
  $isi = $row->fetch(PDO::FETCH_OBJ);

  $tgl_invoice = $isi->tgl_invoice;
  $total_gaji = $isi->total_gaji;
  $mfee = $isi->mfee;
  $ppn = $isi->mfee*10/100;
  $pph23 = $isi->mfee*2/100;
  $id_perusahaan = $isi->id_perusahaan;
  ?>
  <h1>Edit Invoice</h1>
  <form id="form1" name="form1" method="post" action="invoice/aksi_invoice.php">
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
        <label>Tanggal</label>
        <input type="text" class="form-control" name="tgl_invoice" placeholder="0000-00-00" value="<?= $tgl_invoice ?>" required="">
      </div>
      <div class="form-group">
        <label>Total Gaji</label>
        <input type="text" class="form-control number" name="total_gaji" placeholder="Masukkan Total Gaji" value="<?= number_format($total_gaji) ?>" onkeyup="setData(this.value)">
      </div>
      <div class="form-group">
        <label>Management Fee</label>
        <input type="text" class="form-control number" name="mfee" id="mfee" placeholder="Masukkan Management Fee" value="<?= number_format($mfee) ?>" readonly="">
      </div>
      <div class="form-group">
        <label>PPN</label>
        <input type="text" class="form-control number" id="ppn" placeholder="Masukkan PPN" value="<?= number_format($ppn) ?>" readonly="">
      </div>
      <div class="form-group">
        <label>PPH 23</label>
        <input type="text" class="form-control number" id="pph23" placeholder="Masukkan PPH 23" value="<?= number_format($pph23) ?>" readonly="">
      </div>
      <div class="form-group">
        <input type="hidden" name="id_invoice" value="<?= $id_invoice ?>">
        <button name="proses" type="submit" value="edit" class="btn btn-primary">
          <i class="glyphicon glyphicon-floppy-disk"></i> Simpan
        </button>
      </div>
      <div class="form-group">
        <a href="index.php?p=invoice">Tampilkan Tabel Invoice</a>
      </div>
    </div>
  </form>

  <?php
  }elseif($p=="pembayaran"){

  $id_invoice = $_GET['id'];
  $sql = "SELECT a.*, b.nama nama_perusahaan FROM invoice a 
          JOIN perusahaan b ON a.id_perusahaan=b.id_perusahaan
          WHERE id_invoice='$id_invoice'";
  $row = $koneksi->prepare($sql);
  $row->execute();
  $isi = $row->fetch(PDO::FETCH_OBJ);

  $nomor = $isi->nomor;
  $tgl_invoice = $isi->tgl_invoice;
  $nama_perusahaan = $isi->nama_perusahaan;
  $total = number_format(($isi->total_gaji + $isi->mfee + ($isi->mfee*10/100)) - ($isi->mfee*2/100));
  $tgl_bayar = $isi-> tgl_bayar;
  $bayar = $isi->bayar;
  ?>
  <h1>Bayar Invoice</h1>
  <form id="form1" name="form1" method="post" action="invoice/aksi_invoice.php">
    <div class="col-lg-4">
      <div class="form-group">
        <label>No. Invoice</label>
        <input type="text" class="form-control" value="<?= $nomor ?>" readonly="">
      </div>
      <div class="form-group">
        <label>Tanggal</label>
        <input type="text" class="form-control" value="<?= date('d-m-Y', strtotime($tgl_invoice)) ?>" readonly="">
      </div>
      <div class="form-group">
        <label>Perusahaan</label>
        <input type="text" class="form-control" value="<?= $nama_perusahaan ?>" readonly="">
      </div>
      <div class="form-group">
        <label>Total</label>
        <input type="text" class="form-control" value="<?= $total ?>" readonly="">
      </div>
  	<div class="form-group">
        <label>Tanggal Bayar</label>
        <input type="text" class="form-control" name="tgl_bayar" placeholder="0000-00-00" value="<?= $tgl_bayar ?>" required="">
      </div>
      <div class="form-group">
        <label>Bayar</label>
        <input type="text" class="form-control number" name="bayar" placeholder="Masukkan Jumlah Bayar" value="<?= number_format($bayar) ?>" required="">
      </div>
      <div class="form-group">
        <input type="hidden" name="id_invoice" value="<?= $id_invoice ?>">
        <button name="proses" type="submit" value="bayar" class="btn btn-primary">
          <i class="glyphicon glyphicon-floppy-disk"></i> Simpan
        </button>
      </div>
      <div class="form-group">
        <a href="index.php?p=pembayaran">Tampilkan Tabel Pembayaran</a>
      </div>
    </div>
  </form>
  <?php } ?>
  <?php
  break;

  case 'laporan':
  if($p=="invoice"){
  ?>
  <h1>Laporan Invoice</h1>
  <form id="form1" name="form1" method="post" action="invoice/laporan_invoice.php" target="_blank">
    <div class="row">
      <div class="col-lg-4">
        <div class="form-group">
          <label>Periode</label>
          <select name="periode">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
            <option>6</option>
          </select>
          <span>Bulan Terakhir</span>
        </div>
        <div class="form-group">
          <select class="form-control" name="status">
            <option value="all">Semua</option>
            <option value="1">Dibayar</option>
            <option value="0">Belum Dibayar</option>
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4">
        <div class="form-group">
          <button name="proses" type="submit" value="bayar" class="btn btn-primary">
            <i class="glyphicon glyphicon-file"></i> Cetak Laporan
          </button>
        </div>
        <div class="form-group">
          <a href="index.php?p=invoice">Tampilkan Tabel Invoice</a>
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
    function setData(val){
      var mfee = val.replace(/,/g, "") * 10 /100;
      var ppn = mfee.toString().replace(/,/g, "") * 10 /100;
      var pph23 = mfee.toString().replace(/,/g, "") * 2 /100;

      $("#mfee").val(numberWithCommas(mfee.toString().replace(/,/g, "")));
      $("#ppn").val(numberWithCommas(ppn.toString().replace(/,/g, "")));
      $("#pph23").val(numberWithCommas(pph23.toString().replace(/,/g, "")));
    }
  </script>
<?php } ?>
