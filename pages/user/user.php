<?php

if($_SESSION['level']!="super"){
  echo "<script>location='index.php'</script>";
}else{

  include_once '_part/koneksi.php';

  $page = isset($_GET['page']) ? $_GET['page'] : 'list';
  switch ($page) {
  case 'list':
  ?>
  <h1>Data User</h1>
  <div class="row" style="margin: 20px auto;">
    <a href="index.php?p=user&page=entri" class="btn btn-success"><span class="glyphicon glyphicon-plus"> Tambah</span></a>
  </div>
  <table id="example" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>Username</th>
        <th>Nama</th>
        <th>Password</th>
        <th>Akses</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
  	<?php
  		$sql = "SELECT user.*, perusahaan.nama nama_perusahaan FROM user 
              LEFT JOIN perusahaan on user.id_perusahaan=perusahaan.id_perusahaan
              WHERE level!='super'";
      $row = $koneksi->prepare($sql);
      $row->execute();
      $hasil = $row->fetchAll(PDO::FETCH_OBJ);
  		
  		foreach($hasil as $isi){
        if($isi->level=="keu"){$level="Keuangan";}else if($isi->level=="spv"){$level="Supervisor ".$isi->nama_perusahaan;}
  	?>
      <tr>
        <td><?= $isi->username;?></td>
        <td><?= $isi->nama;?></td>
        <td><?= $isi->password;?></td>
        <td><?= $level;?></td>
        <td align="center">
          <a href="index.php?p=user&page=edit&id=<?= $isi->username ?>"><i class="glyphicon glyphicon-edit"> Edit</i></a>
          &nbsp;&nbsp;|&nbsp;&nbsp;
          <a href="user/aksi_user.php?id=<?= $isi->username ?>" onclick="return confirm('Yakin Hapus ?')"><i class="glyphicon glyphicon-floppy-remove"> Hapus</i></a>
        </td>
      </tr>
  	<?php } ?>
    </tbody>
  </table>
  <?php
  break;

  case 'entri':
  ?>
  <h1>Form User</h1>
  <form id="form1" name="form1" method="post" action="user/aksi_user.php">
    <div class="col-lg-4">
      <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="username" placeholder="Masukkan Username">
      </div>
      <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password" placeholder="Masukkan Password">
      </div>
      <div class="form-group">
        <label>Akses</label>
        <select class="form-control" name="level" id="level" onchange="getPerusahaan(this.value)">
          <option value="">--- Pilih Akses ---</option>
          <option value="keu">Keuangan</option>
          <option value="spv">Supervisor</option>
        </select>
      </div>
      <div class="form-group" id="form-group-id-perusahaan" style="display: none">
        <label>Perusahaan</label>
        <select class="form-control" name="id_perusahaan">
          <option value="">--- Pilih Perusahaan ---</option>
          <?php
            $sqlPerusahaan = "SELECT * FROM perusahaan ORDER BY nama";
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
        <button name="proses" type="submit" value="simpan" class="btn btn-primary">
          <i class="glyphicon glyphicon-floppy-disk"></i>	Simpan
        </button>
      </div>
      <div class="form-group">
        <a href="index.php?p=user">Tampilkan Tabel User</a>
      </div>
    </div>
  </form>
  <?php
  break;

  case 'edit':
  $username = $_GET['id'];
  $sql = "SELECT * FROM user WHERE username='$username'";
  $row = $koneksi->prepare($sql);
  $row->execute();
  $isi = $row->fetch(PDO::FETCH_OBJ);

  $username = $isi->username;
  $nama = $isi->nama;
  $password = $isi->password;
  $level = $isi->level;
  $id_perusahaan = $isi->id_perusahaan;
  ?>
  <h1>Edit User</h1>
  <form id="form1" name="form1" method="post" action="user/aksi_user.php">
    <div class="col-lg-4">
      <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="username" placeholder="Masukkan Username" value="<?= $username ?>" readonly="">
      </div>
      <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama" value="<?= $nama ?>">
      </div>
      <div class="form-group">
        <label>Password</label>
        <input type="password" class="form-control" name="password" placeholder="Masukkan Password" value="<?= $password ?>">
      </div>
      <div class="form-group">
        <label>Akses</label>
        <select class="form-control" name="level" id="level" onchange="getPerusahaan(this.value)">
          <option value="">--- Pilih Akses ---</option>
          <option value="keu" <?= $level=="keu"? "selected": "" ?>>Keuangan</option>
          <option value="spv" <?= $level=="spv"? "selected": "" ?>>Supervisor</option>
        </select>
      </div>
      <div class="form-group" id="form-group-id-perusahaan" style="<?= $level=="spv"? 'display: block': 'display: none'; ?>">
        <label>Perusahaan</label>
        <select class="form-control" name="id_perusahaan">
          <option value="">--- Pilih Perusahaan ---</option>
          <?php
            $sqlPerusahaan = "SELECT * FROM perusahaan ORDER BY nama";
            $rowPerusahaan = $koneksi->prepare($sqlPerusahaan);
            $rowPerusahaan->execute();
            $hasilPerusahaan = $rowPerusahaan->fetchAll(PDO::FETCH_OBJ);
            
            foreach($hasilPerusahaan as $isiPerusahaan){
          ?>
          <option value="<?= $isiPerusahaan->id_perusahaan ?>" <?= $id_perusahaan==$isiPerusahaan->id_perusahaan? "selected": "" ?> ><?= $isiPerusahaan->nama ?></option>
          <?php } ?>
        </select>
      </div>
      <div class="form-group">
        <input type="hidden" name="username" value="<?= $username ?>">
        <button name="proses" type="submit" value="edit" class="btn btn-primary">
          <i class="glyphicon glyphicon-floppy-disk"></i> Simpan
        </button>
      </div>
      <div class="form-group">
        <a href="index.php?p=user">Tampilkan Tabel User</a>
      </div>
    </div>
  </form>
  <?php
  break;
  }
  ?>
<?php } ?>
<script>
  function getPerusahaan(val){
    if(val=="spv"){
      $("#form-group-id-perusahaan").show();
    }else{
      $("#form-group-id-perusahaan").hide();
    }
  }
</script>
