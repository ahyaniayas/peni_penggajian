<?php
	$page = isset($_GET['p']) ? $_GET['p'] : 'home';
    if ($page=='home') {
    include 'home.php';
    } else if ($page=='pegawai'){
    include 'pegawai/pegawai.php';
   }
   else if ($page=='gaji'){
    include 'gaji/gaji.php';
   }
   else if ($page=='datapegawai'){
    include 'aksespegawai/datapegawai.php';
   }
   else if ($page=='datagaji'){
    include 'aksespegawai/datagaji.php';
   }
    else if ($page=='invoice'){
    include 'invoice/invoice.php';
   }
   else if ($page=='datainvoice'){
    include 'aksespegawai/datainvoice.php';
   }
?>