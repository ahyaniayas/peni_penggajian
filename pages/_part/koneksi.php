<?php
	date_default_timezone_set("Asia/Jakarta");
	
    $user = 'root';
    $password = '';
    
    $koneksi = NEW PDO('mysql:host=localhost;dbname=peni_penggajian',$user,$password);
    // echo 'sukses';
?>
