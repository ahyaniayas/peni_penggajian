<?php

include_once '_part/koneksi.php';

$page = isset($_GET['page']) ? $_GET['page'] : 'list';
switch ($page) {
case 'list':
break;

case 'entri':
break;

case 'edit':
?>
<h1>Ubah Password</h1>
<form id="form1" name="form1" method="post" action="ubahpassword/aksi_ubahpassword.php">
  <div class="col-lg-4">
    <div class="form-group">
      <label>Password Lama</label>
      <input type="password" class="form-control" name="password_lama" placeholder="Masukkan Password Lama">
    </div>
    <div class="form-group">
      <label>Password Baru</label>
      <input type="password" class="form-control" name="password_baru" placeholder="Masukkan Password Baru">
    </div>
    <div class="form-group">
      <input type="hidden" name="username" value="<?= $username ?>">
      <button name="proses" type="submit" value="edit" class="btn btn-primary">
        <i class="glyphicon glyphicon-floppy-disk"></i> Simpan
      </button>
    </div>
    <div class="form-group">
      <a href="index.php">Beranda</a>
    </div>
  </div>
</form>
<?php
break;
}
?>
