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
	$nama=$_POST['nomor_rekening'];
	$alamat=$_POST['alamat'];
	$jabatan=$_POST['jabatan'];
	$nohp=$_POST['nohp'];
	$id_perusahaan=$_POST['id_perusahaan'];

	$sql = "INSERT INTO pegawai(nip, nama, nomor_rekening, alamat, jabatan, nohp, id_perusahaan) values ('$nip', '$nama', '$nomor_rekening', '$alamat', '$jabatan', '$nohp', '$id_perusahaan')";
	$row = $koneksi->prepare($sql);
	$row->execute();
	echo "<script>alert('Tambah Berhasil'); location='../index.php?p=pegawai&page=entri'</script>";

}else if($proses=='edit'){
	$nip=$_POST['nip'];
	$nama=$_POST['nama'];
	$nomor_rekening=$_POST['nomor_rekening'];
	$alamat=$_POST['alamat'];
	$jabatan=$_POST['jabatan'];
	$nohp=$_POST['nohp'];

	$sql = "UPDATE pegawai SET 
			nama='$nama',
			nomor_rekening='$nomor_rekening',
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