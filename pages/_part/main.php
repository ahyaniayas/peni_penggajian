<?php
$page = isset($_GET['p']) ? $_GET['p'] : 'beranda';
if ($page=='beranda') {
  include 'beranda.php';
}else if ($page=='perusahaan'){
  include 'perusahaan/perusahaan.php';
}else if ($page=='pegawai'){
  include 'pegawai/pegawai.php';
}else if ($page=='gaji'){
  include 'gaji/gaji.php';
}else if ($page=='cetak_slipgaji'){
  include 'gaji/gaji.php';
}else if ($page=='invoice'){
  include 'invoice/invoice.php';
}else if ($page=='pembayaran'){
  include 'invoice/invoice.php';
}else if ($page=='cetak_invoice'){
  include 'invoice/invoice.php';
}else if ($page=='user'){
  include 'user/user.php';
}else if ($page=='ubahpassword'){
  include 'ubahpassword/ubahpassword.php';
}
?>