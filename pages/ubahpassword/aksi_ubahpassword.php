<?php
session_start();

include ('../_part/koneksi.php');
$proses = empty($_POST['proses'])? "": $_POST['proses']; 
if($proses=='simpan'){

}else if($proses=='edit'){
	$username=$_SESSION['username'];
	$password=$_SESSION['password'];

	$password_lama=$_POST['password_lama'];
	$password_baru=$_POST['password_baru'];

	if($password_lama == $password){
		$sql = "UPDATE user SET
				password='$password_baru'
				where username='$username'";
		$row = $koneksi->prepare($sql);
		$row->execute();
		echo "<script>alert('Ubah Password Berhasil, Silahkan Login kembali'); location='../logout.php'</script>";
	}else{
		echo "<script>alert('Ubah Password Gagal, Password Lama tidak sesuai'); location='../index.php?p=ubahpassword&page=edit'</script>";	
	}

}

if(isset($_GET['id'])){

}
?>