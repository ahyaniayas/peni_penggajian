<?php
session_start();
if($_SESSION['level']!="spv"){
  echo "<script>location='../index.php'</script>";
}

include ('../_part/koneksi.php');
$proses = empty($_POST['proses'])? "": $_POST['proses']; 
if($proses=='simpan'){

	$nama=$_POST['nama'];
	$alamat=$_POST['alamat'];

	$sql = "INSERT INTO perusahaan(nama, alamat) values ('$nama', '$alamat')";
	$row = $koneksi->prepare($sql);
	$row->execute();
	echo "<script>alert('Tambah Berhasil'); location='../index.php?p=perusahaan&page=entri'</script>";

}else if($proses=='edit'){
	$id_perusahaan=$_POST['id_perusahaan'];
	$nama=$_POST['nama'];
	$alamat=$_POST['alamat'];

	$sql = "UPDATE perusahaan SET 
			nama='$nama',
			alamat='$alamat'
			where id_perusahaan='$id_perusahaan'";
	$row = $koneksi->prepare($sql);
	$row->execute();
	echo "<script>alert('Edit Berhasil'); location='../index.php?p=perusahaan&page=edit&id=$id_perusahaan'</script>";

}

if(isset($_GET['id'])){
	$id_perusahaan = $_GET['id'];
	$sql = "DELETE FROM perusahaan where id_perusahaan = '$id_perusahaan'";
	$row = $koneksi->prepare($sql);
	$row->execute();
	echo "<script>alert('Hapus Berhasil'); location='../index.php?p=perusahaan'</script>";

}
?>