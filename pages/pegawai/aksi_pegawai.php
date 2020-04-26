<?php

include ('../koneksi.php');
if ($_GET['proses']=='entri')
{
$NIK=$_POST['NIK'];
$nama=$_POST['nama'];
$cabang=$_POST['cabang'];
$jabatan=$_POST['jabatan'];

$simpan=mysql_query("insert into pegawai(NIK,nama,cabang,jabatan) values ('$NIK','$nama','$cabang','$jabatan')");

$save=mysql_query("insert into user(username,password,level) values ('$NIK','$password','$level')");
	if($simpan)
	{
		echo "<script>top.location='../index.php?p=pegawai'</script>";
		}

}
if ($_GET['proses']=='edit')
{
$update=mysql_query("update pegawai set nama='$_POST[nama]',
												  cabang='$_POST[cabang]',
												  jabatan='$_POST[jabatan]',
												  where NIK='$_POST[NIK]'");
		if($update)
		{
			header("location:../index.php?p=pegawai");
		}

}
if($_GET['proses']=='hapus')
{
	$hapus=mysql_query("delete from pegawai where NIK = '$_GET[NIK]'");
	if($hapus)
	{
		header("location:../index.php?p=pegawai");
	}

}
?>