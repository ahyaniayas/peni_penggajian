<?php
$page = isset($_GET['p']) ? $_GET['p'] : 'home';
if ($page=='home') {
  include 'home.php';
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
}
?>