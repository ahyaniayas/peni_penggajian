<?php

if($_SESSION['level']!="spv" && $_SESSION['level']!="super"){
  echo "<script>location='index.php'</script>";
}else{

  include_once '_part/koneksi.php';

  $page = isset($_GET['page']) ? $_GET['page'] : 'list';
  switch ($page) {
  case 'list':
  ?>
  <h1>Data Perusahaan</h1>
  <div class="row" style="margin: 20px auto;">
    <a href="index.php?p=perusahaan&page=entri" class="btn btn-success"><span class="glyphicon glyphicon-plus"> Tambah</span></a>
  </div>
  <table id="example" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Nama Perusahaan</th>
        <th>Alamat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
  	<?php
  		$sql = "SELECT * FROM perusahaan";
      $row = $koneksi->prepare($sql);
      $row->execute();
      $hasil = $row->fetchAll(PDO::FETCH_OBJ);
  		
  		foreach($hasil as $isi){
  	?>
      <tr>
        <td><?= $isi->nama;?></td>
        <td><?= $isi->alamat;?></td>
        <td align="center">
          <a href="index.php?p=perusahaan&page=edit&id=<?= $isi->id_perusahaan ?>"><i class="glyphicon glyphicon-edit"> Edit</i></a>
          &nbsp;&nbsp;|&nbsp;&nbsp;
          <a href="perusahaan/aksi_perusahaan.php?id=<?= $isi->id_perusahaan ?>" onclick="return confirm('Yakin Hapus ?')"><i class="glyphicon glyphicon-floppy-remove"> Hapus</i></a>
        </td>
      </tr>
  	<?php } ?>
    </tbody>
  </table>
  <?php
  break;

  case 'entri':
  ?>
  <h1>Form Perusahaan</h1>
  <form id="form1" name="form1" method="post" action="perusahaan/aksi_perusahaan.php">
    <div class="col-lg-4">
      <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama">
      </div>
      <div class="form-group">
        <label>Alamat</label>
        <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat"></textarea>
      </div>
      <div class="form-group">
        <button name="proses" type="submit" value="simpan" class="btn btn-primary">
          <i class="glyphicon glyphicon-floppy-disk"></i>	Simpan
        </button>
      </div>
      <div class="form-group">
        <a href="index.php?p=perusahaan">Tampilkan Tabel Perusahaan</a>
      </div>
    </div>
  </form>
  <?php
  break;

  case 'edit':
  $id_perusahaan = $_GET['id'];
  $sql = "SELECT * FROM perusahaan WHERE id_perusahaan='$id_perusahaan'";
  $row = $koneksi->prepare($sql);
  $row->execute();
  $isi = $row->fetch(PDO::FETCH_OBJ);

  $id_perusahaan = $isi->id_perusahaan;
  $nama = $isi->nama;
  $alamat = $isi->alamat;
  ?>
  <h1>Edit Perusahaan</h1>
  <form id="form1" name="form1" method="post" action="perusahaan/aksi_perusahaan.php">
    <div class="col-lg-4">
      <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" value="<?= $nama ?>">
      </div>
      <div class="form-group">
        <label>Alamat</label>
        <textarea class="form-control" name="alamat" placeholder="Masukkan Alamat"><?= $alamat ?></textarea>
      </div>
      <div class="form-group">
        <input type="hidden" name="id_perusahaan" value="<?= $id_perusahaan ?>">
        <button name="proses" type="submit" value="edit" class="btn btn-primary">
          <i class="glyphicon glyphicon-floppy-disk"></i> Simpan
        </button>
      </div>
      <div class="form-group">
        <a href="index.php?p=perusahaan">Tampilkan Tabel Perusahaan</a>
      </div>
    </div>
  </form>
  <?php
  break;
  }
  ?>
<?php } ?>
