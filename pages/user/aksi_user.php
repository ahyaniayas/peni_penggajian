<?php
session_start();
if($_SESSION['level']!="super"){
  echo "<script>location='../index.php'</script>";
}else{

	include ('../_part/koneksi.php');
	$proses = empty($_POST['proses'])? "": $_POST['proses']; 
	if($proses=='simpan'){

		$username=$_POST['username'];
		$nama=$_POST['nama'];
		$password=$_POST['password'];
		$level=$_POST['level'];

		$sqlCek = "SELECT username FROM user WHERE username='$username'";
		$rowCek = $koneksi->prepare($sqlCek);
		$rowCek->execute();
		$jmlCek = $rowCek->rowCount();

		if($jmlCek<=0){
			$sql = "INSERT INTO user(username, nama, password, level) values ('$username', '$nama', '$password', '$level')";
			$row = $koneksi->prepare($sql);
			$row->execute();
			echo "<script>alert('Tambah Berhasil'); location='../index.php?p=user&page=entri'</script>";
		}else{
			echo "<script>alert('Tambah Gagal, Username sudah dipakai'); location='../index.php?p=user&page=entri'</script>";
		}

	}else if($proses=='edit'){
		$username=$_POST['username'];
		$nama=$_POST['nama'];
		$password=$_POST['password'];
		$level=$_POST['level'];

		$sql = "UPDATE user SET 
				nama='$nama',
				password='$password',
				level='$level'
				where username='$username'";
		$row = $koneksi->prepare($sql);
		$row->execute();
		echo "<script>alert('Edit Berhasil'); location='../index.php?p=user&page=edit&id=$username'</script>";

	}

	if(isset($_GET['id'])){
		$username = $_GET['id'];
		$sql = "DELETE FROM user where username = '$username'";
		$row = $koneksi->prepare($sql);
		$row->execute();
		echo "<script>alert('Hapus Berhasil'); location='../index.php?p=user'</script>";

	}
}
?>