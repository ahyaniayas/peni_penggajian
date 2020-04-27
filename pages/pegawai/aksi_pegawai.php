<?php
session_start();
if($_SESSION['level']!="spv"){
  echo "<script>location='../index.php'</script>";
}

include ('../_part/koneksi.php');
$proses = empty($_POST['proses'])? "": $_POST['proses']; 
if($proses=='simpan'){

	$nip=$_POST['nip'];
	$nama=$_POST['nama'];
	$alamat=$_POST['alamat'];
	$jabatan=$_POST['jabatan'];
	$nohp=$_POST['nohp'];

	$sql = "INSERT INTO pegawai(nip, nama, alamat, jabatan, nohp) values ('$nip', '$nama', '$alamat', '$jabatan', '$nohp')";
	$row = $koneksi->prepare($sql);
	$row->execute();
	echo "<script>alert('Tambah Berhasil'); location='../index.php?p=pegawai&page=entri'</script>";

}else if($proses=='edit'){
	$nip=$_POST['nip'];
	$nama=$_POST['nama'];
	$alamat=$_POST['alamat'];
	$jabatan=$_POST['jabatan'];
	$nohp=$_POST['nohp'];

	$sql = "UPDATE pegawai SET 
			nama='$nama',
			alamat='$alamat',
			jabatan='$jabatan',
			nohp='$nohp'
			where nip='$nip'";
	$row = $koneksi->prepare($sql);
	$row->execute();
	echo "<script>alert('Edit Berhasil'); location='../index.php?p=pegawai&page=edit&nip=$nip'</script>";

}

if(isset($_GET['nip'])){
	$nip = $_GET['nip'];
	$sql = "DELETE FROM pegawai where nip = '$nip'";
	$row = $koneksi->prepare($sql);
	$row->execute();
	echo "<script>alert('Hapus Berhasil'); location='../index.php?p=pegawai'</script>";

}
?>