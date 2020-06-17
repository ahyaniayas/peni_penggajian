<?php
session_start();
include '_part/koneksi.php';

$username=$_POST['username'];
$password=$_POST['password'];

$data[] = $username;
$data[] = $password;

$sql = "SELECT user.*, perusahaan.id_perusahaan, perusahaan.nama nama_perusahaan FROM user
		LEFT JOIN perusahaan on perusahaan.id_perusahaan=user.id_perusahaan
		WHERE username=? and password=?";
$row = $koneksi -> prepare($sql);
$row -> execute($data);

$jml = $row -> rowcount();

if($jml > 0){
    // Jika Berhasil
    $isi = $row->fetch(PDO::FETCH_OBJ);      
    $_SESSION['username']=$isi->username;
    $_SESSION['nama']=$isi->nama;
    $_SESSION['password']=$isi->password;
    $_SESSION['level']=$isi->level;
    if($isi->level=="spv"){
	    $_SESSION['id_perusahaan']=$isi->id_perusahaan;
	    $_SESSION['nama_perusahaan']=$isi->nama_perusahaan;
    }

    echo "<script>location='index.php';</script>";
}else{
    // Jika Gagal
    echo "<script>alert ('username atau password salah'); location='../index.php';</script>";
}

?>